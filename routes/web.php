<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User;
use App\Livewire\Company;
use App\Livewire\Project;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {

    Route::name('user.')->prefix('user')->group(function () {
        Route::get('/', User\Index::class)->name('index');
        Route::get('/create', User\Create::class)->name('create')->can('create', App\Models\User::class);
        Route::get('/{user}/edit', User\Edit::class)->name('edit')->can('update', 'user');
        // Route::get('/{user}', User\View::class)->name('show');
    });

    Route::name('company.')->prefix('company')->group(function () {
        Route::get('/', Company\Index::class)->name('index');
        Route::get('/create', Company\Create::class)->name('create');
        Route::get('/{company}/edit', Company\Edit::class)->name('edit');
        Route::get('/{company}', Company\View::class)->name('show');
    });

    Route::name('project.')->prefix('project')->group(function () {
        Route::get('/', Project\Index::class)->name('index');
        Route::get('/create', Project\Create::class)->name('create');
        Route::get('/{project}/edit', Project\Edit::class)->name('edit');
        Route::get('/{project}', Project\View::class)->name('show');
    });

});

require __DIR__.'/auth.php';
