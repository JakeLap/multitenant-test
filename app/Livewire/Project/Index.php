<?php

namespace App\Livewire\Project;

use App\Models\Company;
use Livewire\Component;

class Index extends Component
{
    public Company $company;

    public function mount(Company $company)
    {
        $this->authorize('viewProjects', $company);
        $this->company = $company;
    }

    public function render()
    {
        $projects = $this->company->projects;

        return view('livewire.project.index', [
            'projects' => $projects
        ]);
    }
}
