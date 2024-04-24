<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    public function createCompany(string $name, ?array $users): Company
    {
        $company = Company::create([
            "name"=> $name
        ]);

        if (isset($users)) {
            $this->syncCompanyUsers($company, $users);
            $company->load('users');
        }        

        return $company;
    }

    public function updateCompany(Company $company, string $name, array $users): Company
    {
        $company->update([
            "name" => $name
        ]);

        if (isset($users)) {
            $this->syncCompanyUsers($company, $users);
            $company->load('users');
        }        

        return $company;
    }

    public function syncCompanyUsers(Company $company, array $ids): array
    {
        return $company->users()->sync($ids);
    }

    public function deleteCompany(Company $company): bool
    {
        return $company->delete();
    }
}
