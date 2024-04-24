<?php

namespace App\Livewire\Company;

use App\Models\Company;
use App\Models\User;
use App\Services\CompanyService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    #[Validate]
    public $name;

    #[Validate]
    public $users = [];

    public Company $company;

    public function mount(Company $company)
    {
        $this->company = $company;
        $this->name = $company->name;
        $this->users = $company->users->pluck('id')->toArray();
    }

    public function render()
    {
        $userInputs = User::all();
        return view('livewire.company.edit',[
            'usersInputs'=> $userInputs
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

        $this->authorize('update', $this->company);

        $company = $companyService->updateCompany($this->company, $this->name, $this->users);

        session()->flash('status', 'Company updated successfully.');

        $this->redirectRoute('company.edit', ['company' => $company], navigate: true);
    }

    public function delete(CompanyService $companyService)
    {
        $this->authorize('delete', $this->company);

        $companyService->deleteCompany($this->company);

        session()->flash('status', 'Company deleted successfully.');

        $this->redirectRoute('company.index', navigate: true);
    }
}
