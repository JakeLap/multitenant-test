<div class="max-w-screen-lg mx-auto space-y-4 py-4">

    <a
        wire:navigate
        href="{{ route('company.create') }}"
        class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700 uppercase"
    >
    Create company
    </a>
  
    <div class="rounded-lg border border-gray-200">
      <div class="overflow-x-auto rounded-t-lg">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
          <thead>
            <tr>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Name</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Projects</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Users</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Actions</th>
            </tr>
          </thead>
  
          <tbody class="divide-y divide-gray-200">
            @foreach ($companies as $company)
            <tr>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $company->name }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $company->projects->count() }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $company->users->count() }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                    <a
                        wire:navigate
                        href="{{ route('company.edit', ['company' => $company]) }}"
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
  