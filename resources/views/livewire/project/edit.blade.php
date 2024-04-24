<div class="max-w-screen-lg mx-auto space-y-4 py-4">
    <div class="flex flex-row justify-between items-center">
        <a wire:navigate href="{{ route('company.project.index', ['company' => $company]) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg> 
            <span class="text-sm">Back to projects</span>
        </a>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 space-y-4 mb-6">
            <div>
                <label for="name" class="block text-xs font-medium text-gray-700"> Name </label>
            
                <input
                    wire:model.live="name"
                    type="text"
                    id="name"
                    placeholder="Project name"
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label for="description" class="block text-xs font-medium text-gray-700"> Description </label>
            
                <textarea
                    wire:model.live="description"
                    type="text"
                    id="description"
                    placeholder="Project description."
                    rows="4"
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
                ></textarea>

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
    
        </div>

        <button type="submit" class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700 uppercase">
        Save
        </button>

        <button wire:click="delete" type="button" class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700 uppercase">
        Delete
        </button>
    </form>
</div>
