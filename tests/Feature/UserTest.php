<?php

use App\Livewire\User\Create;
use App\Livewire\User\Edit;
use App\Livewire\User\Index;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
 
uses(RefreshDatabase::class);

test('admin can view users', function () {

    $admin = User::factory()->create(['role' => 'admin']);

    User::factory()->count(4)->create();

    Livewire::actingAs($admin)
        ->test(Index::class)
        ->assertViewHas('users', function($users) {
            return count($users) === 5;
        });
});

test('moderator can not view users', function () {
    $moderator = User::factory()->create();

    User::factory()->count(4)->create();

    Livewire::actingAs($moderator)
        ->test(Index::class)
        ->assertForbidden();
});

test('admin can create users', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);

    expect(User::count())->toBe(1);

    Livewire::actingAs($admin)
        ->test(Create::class)
        ->set('name', 'Test name')
        ->set('email', 'test@test.tes')
        ->set('role', 'moderator')
        ->set('password', '123456789')
        ->call('save')
        ->assertRedirect(Index::class);

    expect(User::count())->toBe(2);
});

test('moderator can not create users', function () {
    
    $moderator = User::factory()->create();

    expect(User::count())->toBe(1);

    Livewire::actingAs($moderator)
        ->test(Create::class)
        ->assertForbidden();

    expect(User::count())->toBe(1);
});

test('admin can update users', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);

    $moderator = User::factory()->create();

    Livewire::actingAs($admin)
        ->test(Edit::class, ['user' => $moderator])
        ->set('name', 'Test name')
        ->set('email', 'test@test.tes')
        ->set('role', 'moderator')
        ->set('password', '123456789')
        ->call('save')
        ->assertRedirect(route('user.edit', ['user' => $moderator]));

    $moderator->refresh();

    expect($moderator->name)->toBe('Test name');
});

test('admin can delete users', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);

    $moderator = User::factory()->create();

    Livewire::actingAs($admin)
        ->test(Edit::class, ['user' => $moderator])
        ->call('delete')
        ->assertRedirect(Index::class);


    expect(User::count())->toBe(1);
});
