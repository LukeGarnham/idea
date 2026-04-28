<x-layout>
    <div class="py-8 max-w-4xl mx-auto">
        <div class="flex justify-between items-center">
            <a href="{{ route('idea.index') }}" class="text-sm font-medium">
                < Back to ideas</a>
                    <div class="flex items-center gap-x-3">
                        <button class="btn btn-outline">Edit Idea</button>
                        <form method="POST" action="{{ route('idea.destroy', $idea) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline text-red-500" type="submit">Delete Idea</button>
                        </form>
                    </div>
        </div>
        <div class="mt-8 space-y-6">
            <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>

            <div class="mt-2 flex items-center gap-x-3">
                <x-idea.status-label :status="$idea->status->value">{{ $idea->status->label() }}</x-idea.status-label>

                <div class="text-muted-foreground text-sm">{{ $idea->created_at->diffForHumans() }}</div>
            </div>

            <x-card class="mt-6">
                <div class="text-foreground max-w-none cursor-point">
                    {{ $idea->description }}
                </div>
            </x-card>

            @if($idea->links)
                <div>
                    <h3 class="font-bold text-xl mt-6">Links</h3>
                    <div class="gap-y-2">
                        @foreach ($idea->links as $link)
                            <x-card :href="$link" target="_blank" class="text-primary font-medium flex items-center gap-x-3 mt-3">
                                {{ $link }}
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>