@props(['idea' => new \App\Models\Idea()])

<!-- Modal -->
<x-modal name="{{ $idea->exists ? 'edit-idea' : 'create-idea' }}" title="{{ $idea->exists ? 'Edit Idea' : 'New Idea' }}">
    <form
        x-data="{
                    status: @js(old('status', $idea->status->value)),
                    newLink: '',
                    links: @js(old('links', $idea->links ?? [])),
                    newStep: '',
                    steps: @js(old('steps', $idea->steps->map->only(['id', 'description', 'completed']))),
        }"
        method="POST"
        action="{{ $idea->exists ? route('idea.update', $idea) : route('idea.store') }}"
    >
        @csrf
        @if ($idea->exists)
            @method('PATCH')
        @endif
        <div class="space-y-6">
            <x-form.field
                label="Enter a title for your idea"
                name="title"
                value="{{ $idea->title }}"
                placeholder="Enter a title for your idea."
                autofocus
                required />

            <div class="space-y-2">
                <label for="status" class="label">Status</label>
                <div class="flex gap-x-3">
                    @foreach(App\IdeaStatus::cases() as $status)
                        <button
                            type="button"
                            @click="status = @js($status->value)"
                            data-test="button-status-{{ $status->value }}"
                            class="btn flex-1 h-10"
                            :class="{'btn-outline': status !== @js($status->value)}">
                            {{ $status->label() }}
                        </button>
                    @endforeach
                    <input class="input" type="hidden" name="status" :value="status">
                </div>
                <x-form.error name="status" />
            </div>

            <x-form.field
                label="Description"
                name="description"
                value="{{ $idea->description }}"
                type="textarea"
                placeholder="Describe your idea . . ." />

            <div class="space-y-2">
                <label for="image" class="label">Featured Image</label>

                @if ($idea->image_path)
                    <div class="space-y-2">
                        <img src="{{ asset('storage/' . $idea->image_path) }}" alt="{{ $idea->description }}" class="w-full h-auto object-cover">
                        <button type="button" class="btn btn-outline w-full h-10 rounded-lg" form="delete-image-form">Remove Image</button>
                    </div>
                @endif

                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    @change="$event.target.form.enctype = $event.target.files.length ? 'multipart/form-data' : 'application/x-www-form-urlencoded'">
                <x-form.error name="image" />
            </div>

            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Actionable Steps</legend>
                    <template x-for="(step, index) in steps" :key="step.id || index">
                        <div class="flex gap-x-2 items-center">
                            <input type="text" :name="`steps[${index}][description]`" x-model="step.description" class="input" readonly>
                            <input type="hidden" :name="`steps[${index}][completed]`" :value="step.completed ? '1' : '0'" class="input" readonly>
                            <button
                                type="button"
                                class="text-xl form-muted-icon ml-2"
                                @click="steps.splice(index,1);"
                                aria-label="Remove step">
                                ✕
                            </button>
                        </div>
                    </template>
                    <div class="flex gap-x-2 items-center">
                        <input
                            x-model="newStep"
                            type="text"
                            id="new-step"
                            data-test="new-step"
                            name="new-step"
                            placeholder="What needs to be done?"
                            class="input flex-1"
                            spellcheck="false">
                        <button
                            type="button"
                            class="text-xl form-muted-icon rotate-45 ml-2"
                            data-test="submit-new-step-button"
                            @click="
                                steps.push({description: newStep.trim(), completed: false});
                                newStep='';
                            "
                            :disabled="newStep.trim().length===0"
                            aria-label="Add a new step">
                            ✕
                        </button>
                    </div>
                </fieldset>
            </div>

            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Links</legend>
                    <template x-for="(link, index) in links" :key="link">
                        <div class="flex gap-x-2 items-center">
                            <input type="text" name="links[]" x-model="link" class="input">
                            <button
                                type="button"
                                class="text-xl form-muted-icon ml-2"
                                @click="links.splice(index,1);"
                                aria-label="Remove link">
                                ✕
                            </button>
                        </div>
                    </template>
                    <div class="flex gap-x-2 items-center">
                        <input
                            x-model="newLink"
                            type="url"
                            id="new-link"
                            data-test="new-link"
                            name="new-link"
                            placeholder="http://example.com"
                            autocomplete="null"
                            class="input flex-1"
                            spellcheck="false">
                        <button
                            type="button"
                            class="text-xl form-muted-icon rotate-45 ml-2"
                            data-test="submit-new-link-button"
                            @click="links.push(newLink.trim()); newLink='';"
                            :disabled="newLink.trim().length===0"
                            aria-label="Add a new link">
                            ✕
                        </button>
                    </div>
                </fieldset>
            </div>

            <div class="flex justify-end gap-x-5">
                <button type="button" @click="$dispatch('close-modal')">Cancel</button>
                <button type="submit" class="btn">{{ $idea->exists ? 'Update' : 'Create' }}</button>
            </div>
        </div>
    </form>

    @if ($idea->image_path)
        <form id="delete-image-form" action="{{ route('idea.image.destroy', $idea) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    @endif
</x-modal>
