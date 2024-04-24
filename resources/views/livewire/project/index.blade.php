<div class="max-w-screen-lg mx-auto space-y-4 py-4">

    <div class="flex flex-row justify-between items-center">
        <a wire:navigate href="{{ route('company.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg> 
            <span class="text-sm">Back to companies</span>
        </a>

        <a
            wire:navigate
            href="{{ route('company.project.create', ['company' => $company]) }}"
            class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700 uppercase"
        >
        Create project
        </a>
    </div>
    
    <div class="rounded-lg border border-gray-200">
      <div class="overflow-x-auto rounded-t-lg">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
          <thead>
            <tr>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Name</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Description</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Company</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Creator</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Actions</th>
            </tr>
          </thead>
  
          <tbody class="divide-y divide-gray-200">
            @foreach ($projects as $project)
            <tr>
                <td class="px-4 py-2 font-medium text-gray-900">{{ $project->name }}</td>
                <td class="px-4 py-2 text-gray-700">{{ $project->description }}</td>
                <td class="px-4 py-2 text-gray-700">{{ $company->name }}</td>
                <td class="px-4 py-2 text-gray-700">{{ $project->creator->name }}</td>
                <td class="px-4 py-2 text-gray-700">
                    <a
                        wire:navigate
                        href="{{ route('company.project.edit', ['company' => $company, 'project' => $project]) }}"
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
  