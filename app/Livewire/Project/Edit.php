<?php

namespace App\Livewire\Project;

use App\Models\Company;
use App\Models\Project;
use App\Services\ProjectService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    #[Validate]
    public $name;

    #[Validate]
    public $description;

    public Company $company;

    public Project $project;

    public function mount(Company $company, Project $project)
    {
        $this->authorize('updateProjects', $this->company);
        $this->fill($project);
    }

    public function render()
    {
        return view('livewire.project.edit');
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

        $this->authorize('updateProjects', $this->company);

        $projectService->updateProject(
            project: $this->project,
            name: $this->name,
            description: $this->description,
        );

        session()->flash('status', 'Project updated successfully.');

        $this->redirectRoute('company.project.edit', ['company' => $this->company, 'project' => $this->project], navigate: true);
    }

    public function delete(ProjectService $projectService)
    {
        $this->authorize('deleteProjects', $this->company);

        $projectService->deleteProject($this->project);

        session()->flash('status', 'Project deleted successfully.');

        $this->redirectRoute('company.project.index', ['company' => $this->company], navigate: true);
    }
}
