<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.company.index', [
            'companies' => Company::with(['projects', 'users'])->get()
        ]);
    }
}
