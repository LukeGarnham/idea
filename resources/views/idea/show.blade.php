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
            @if ($idea->image_path)
                <div class="rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $idea->image_path) }}" alt="{{ $idea->description }}" class="w-full h-auto object-cover">
                </div>
            @endif

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

            @if($idea->steps->count())
                <div>
                    <h3 class="font-bold text-xl mt-6">Actionable Steps</h3>
                    <div class="gap-y-2">
                        @foreach ($idea->steps as $step)
                            <x-card class="flex items-center gap-x-3 mt-3">
                                <form method="POST" action="{{ route('step.update', $step) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center gap-x-3">
                                        <button type="submit" role="checkbox" class="size-5 flex items-center justify-center rounded-lg text-primary-foreground {{ $step->completed ? 'bg-primary' : 'border border-primary' }}">&check;</button>
                                        <span class="{{ $step->completed ? "line-through text-muted-foreground" : "" }}">{{ $step->description }}</span>
                                    </div>
                                </form>
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($idea->links->count())
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
