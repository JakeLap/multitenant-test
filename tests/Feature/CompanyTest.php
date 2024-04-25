<?php

use App\Livewire\Company\Create;
use App\Livewire\Company\Edit;
use App\Livewire\Company\Index;
use App\Models\Company;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
 
uses(RefreshDatabase::class);

test('admin can view all companies', function () {

    $admin = User::factory()->create(['role' => 'admin']);

    Company::factory()->count(4)->create();

    Livewire::actingAs($admin)
        ->test(Index::class)
        ->assertViewHas('companies', function($companies) {
            return count($companies) === 4;
        });
});

test('moderator can view only his/hers companies', function () {
    $moderator = User::factory()->create();

    Company::factory()->count(4)->create();

    Company::factory()->hasAttached($moderator)->create();

    Livewire::actingAs($moderator)
        ->test(Index::class)
        ->assertViewHas('companies', function($companies) {
            return count($companies) === 1;
        });
});

test('admin can create companies', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);

    Livewire::actingAs($admin)
        ->test(Create::class)
        ->set('name', 'Test company')
        ->call('save')
        ->assertRedirect(Index::class);

    expect(Company::count())->toBe(1);
});

test('moderator can not create users', function () {
    
    $moderator = User::factory()->create();

    Livewire::actingAs($moderator)
        ->test(Create::class)
        ->assertForbidden();
});
