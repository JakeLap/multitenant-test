<div class="max-w-screen-lg mx-auto space-y-4 py-4">
  <div class="flex flex-row justify-between items-center">
    <div></div>

    @can('create', App\Models\User::class)
      <a
        wire:navigate
        href="{{ route('user.create') }}"
        class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700 uppercase"
      >
      Create user
      </a>
    @endcan
  </div>
  
  <div class="rounded-lg border border-gray-200">
    <div class="overflow-x-auto rounded-t-lg">
      <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <thead>
          <tr>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Name</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Email</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Role</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Actions</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
          @foreach ($users as $user)
          <tr>
              <td class="px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
              <td class="px-4 py-2 font-medium text-gray-900">{{ $user->email }}</td>
              <td class="px-4 py-2 text-gray-700">{{ $user->role }}</td>
              <td class="px-4 py-2 text-gray-700">
                  <a
                      wire:navigate
                      href="{{ route('user.edit', ['user' => $user]) }}"
                      class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700 uppercase"
                  >
                  Edit
                  </a>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
