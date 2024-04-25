<?php

namespace App\Livewire\Company;

use App\Models\Company;
use App\Models\User;
use App\Services\CompanyService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public $name;

    public $users = [];

    public function mount()
    {
        $this->authorize('create', Company::class);
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.company.create',[
            'usersInputs'=> $users
        ]);
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'users' => ['array'],
            'users.*' => ['exists:users,id']
        ];
    }

    public function save(CompanyService $companyService)
    {
        $this->validate();

        $this->authorize('create', Company::class);

        $companyService->createCompany($this->name, $this->users);

        session()->flash('status', 'Company created successfully.');

        $this->redirectRoute('company.index', navigate: true);
    }
}
