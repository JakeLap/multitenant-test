<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Project;
use App\Models\User;

class ProjectService
{
    public function createProject(User $creator, Company $company, string $name, string $description): Project
    {
        return Project::create([
            'name' => $name,
            'description'=> $description,
            'company_id' => $company->id,
            'creator_id' => $creator->id
        ]);
    }

    public function updateProject(Project $project, string $name, string $description): bool
    {
        return $project->update([
            'name' => $name,
            'description' => $description
        ]); 
    }

    public function deleteProject(Project $project): bool|null
    {
        return $project->delete();
    }
}
