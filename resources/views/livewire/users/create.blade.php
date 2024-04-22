<div class="max-w-screen-lg mx-auto space-y-4 py-4">
    <form wire:submit="save">
        <div class="grid grid-cols-4 space-x-4 mb-6">
            <div>
                <label for="name" class="block text-xs font-medium text-gray-700"> Name </label>
            
                <input
                    wire:model.live="name"
                    type="text"
                    id="name"
                    placeholder="John Doe"
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            
            <div>
                <label for="email" class="block text-xs font-medium text-gray-700"> Email </label>
            
                <input
                    wire:model.live="email"
                    type="email"
                    id="email"
                    placeholder="email@example.tes"
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
                />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="role" class="block text-xs font-medium text-gray-900"> Role </label>
            
                <select
                    wire:model.live="role"
                    name="HeadlineAct"
                    id="role"
                    class="mt-1 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm"
                >
                    <option value="">Please select</option>
                    @foreach (config('user.roles') as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>

                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>          

            <div>
                <label for="password" class="block text-xs font-medium text-gray-700"> Password </label>
            
                <input
                    wire:model.live="password"
                    type="password"
                    id="password"
                    placeholder=""
                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <button type="submit" class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700 uppercase">
        Save
        </button>
    </form>
</div>
