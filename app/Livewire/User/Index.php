<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function mount()
    {
        $this->authorize('viewAny', User::class);
    }

    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::all()
        ]);
    }
}
