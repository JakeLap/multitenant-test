<div class="max-w-screen-lg mx-auto space-y-4 py-4">
    <form wire:submit="save">
        <div class="grid grid-cols-2 space-x-4 mb-6">
            <div>
                <label for="name" class="block text-xs font-medium text-gray-700"> Name </label>
            
                <input
                    wire:model.live="name"
                    type="text"
                    id="name"
                    placeholder="Company name"
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label for="name" class="block text-xs font-medium text-gray-700"> Users </label>

                <div x-data="{ isOpen: false }" class="relative border border-gray-300 mt-1 rounded-md shadow-sm">
                  <button
                    x-on:click="isOpen = !isOpen"
                    type="button"
                    class="flex w-full cursor-pointer items-center justify-between gap-2 bg-white p-2 text-gray-900 rounded-md transition"
                  >
                    <span class="text-sm font-medium text-gray-500"> Select users </span>
              
                    <span class="transition" :class="{ '-rotate-180': isOpen }">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-4 w-4"
                      >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                      </svg>
                    </span>
                  </button>
              
                  <div
                    x-cloak
                    x-show="isOpen"
                    x-on:click.outside="isOpen = false"
                    class="z-50 absolute w-full border border-gray-200 bg-white"
                  >
              
                    <ul class="space-y-1 border-t border-gray-200 p-4">
                        @foreach ($usersInputs as $user)
                            <li>
                                <label for="FilterInStock" class="inline-flex items-center gap-2">
                                    <input wire:model="users" value="{{ $user->id }}" type="checkbox" id="FilterInStock" class="size-5 rounded border-gray-300" />
                                    <span class="text-sm font-medium text-gray-700">{{ $user->name }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>

                  </div>
                </div>                
            </div>
    
        </div>

        <button type="submit" class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700 uppercase">
        Save
        </button>
    </form>
</div>
