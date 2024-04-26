<?php

use App\Livewire\Project\Create;
use App\Livewire\Project\Edit;
use App\Livewire\Project\Index;
use App\Models\Company;
use App\Models\Project;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
 
uses(RefreshDatabase::class);

test('admin can create projects for all companies', function () {

    $admin = User::factory()->create(['role' => 'admin']);

    $company = Company::factory()->create();

    Livewire::actingAs($admin)
        ->test(Create::class, ['company' => $company])
        ->set('name', 'Project name')
        ->set('description', 'Project description')
        ->call('save')
        ->assertRedirect(route('company.project.index', ['company' => $company]));

    expect(Project::count())->toBe(1);
});

test('moderator can create projects only for his/hers companies', function () {
    $moderator = User::factory()->create();

    $companyNotBelonging = Company::factory()->create();

    $companyBelonging = Company::factory()->hasAttached($moderator)->create();

    Livewire::actingAs($moderator)
        ->test(Create::class, ['company' => $companyNotBelonging])
        ->assertForbidden();

    Livewire::actingAs($moderator)
        ->test(Create::class, ['company' => $companyBelonging])
        ->set('name', 'Project name')
        ->set('description', 'Project description')
        ->call('save')
        ->assertRedirect(route('company.project.index', ['company' => $companyBelonging]));

    expect(Project::count())->toBe(1);
});

