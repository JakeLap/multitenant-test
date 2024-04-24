<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $companies = Company::with(['projects', 'users'])->filterForUser(Auth::user())->get();

        return view('livewire.company.index', [
            'companies' => $companies
        ]);
    }
}
