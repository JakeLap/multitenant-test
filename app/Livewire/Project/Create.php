<?php

namespace App\Livewire\Project;

use App\Models\Company;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public $name;

    #[Validate]
    public $description;

    public Company $company;

    public function mount(Company $company)
    {
        $this->authorize('createProjects', $this->company);
        $this->company = $company;
    }

    public function render()
    {
        $this->authorize('createProjects', $this->company);

        return view('livewire.project.create');
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }

    public function save(ProjectService $projectService)
    {
        $this->validate();

        $this->authorize('createProjects', $this->company);

        $project = $projectService->createProject(
            creator: Auth::user(),
            company: $this->company,
            name: $this->name,
            description: $this->description
        );

        session()->flash('status', 'Project created successfully.');

        $this->redirectRoute('company.project.index', ['company' => $this->company, 'project' => $project], navigate: true);
    }
}
