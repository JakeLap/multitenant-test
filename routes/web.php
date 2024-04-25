<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User;
use App\Livewire\Company;
use App\Livewire\Project;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

Route::middleware(['auth'])->group(function () {

    Route::name('user.')->prefix('user')->group(function () {
        Route::get('/', User\Index::class)->name('index');
        Route::get('/create', User\Create::class)->name('create');
        Route::get('/{user}/edit', User\Edit::class)->name('edit');
        // Route::get('/{user}', User\View::class)->name('show');
    });

    Route::name('company.')->prefix('company')->group(function () {
        Route::get('/', Company\Index::class)->name('index');
        Route::get('/create', Company\Create::class)->name('create');
        Route::get('/{company}/edit', Company\Edit::class)->name('edit');
        // Route::get('/{company}', Company\View::class)->name('show')->can('view', 'company');

        Route::get('/{company}/project', Project\Index::class)->name('project.index');
        Route::get('/{company}/project/create', Project\Create::class)->name('project.create');
        Route::get('/{company}/project/{project}/edit', Project\Edit::class)->name('project.edit');
        Route::get('/{company}/project/{project}', Project\View::class)->name('project.show');
    });

});

require __DIR__.'/auth.php';
