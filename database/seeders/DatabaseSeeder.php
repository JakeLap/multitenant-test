<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Multitenancy\Models\Tenant;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tenant::checkCurrent()
           ? $this->runTenantSpecificSeeders()
           : $this->runLandlordSpecificSeeders();
    }

    private function runTenantSpecificSeeders(): void
    {
        $password = Hash::make('123456789');

        // Create an admin user
        User::factory()->create([
            'email' => 'admin@test.tes',
            'password' => $password,
            'role' => 'admin'
        ]);

        for ($i=0; $i < 3; $i++) { 

            $users = User::factory()
                ->count(3)
                ->state(function (array $attributes) use ($password) {
                    return [
                        'password' => $password,
                    ];
                });
    
            $company = Company::factory()
                ->has($users)
                ->create();
    
            Project::factory()
                ->for($company)
                ->count(3)
                ->create(
                    [
                        'creator_id' => $company->users()->inRandomOrder()->first()->id,
                    ]
                );
        }        
    }

    private function runLandlordSpecificSeeders(): void
    {
        DB::table('tenants')->insert([
            'name' => 'tenant1',
            'database' => 'tenant1',
            'domain' => 'tenant1.test'
        ]);

        DB::table('tenants')->insert([
            'name' => 'tenant2',
            'database' => 'tenant2',
            'domain' => 'tenant2.test'
        ]);
    }
}
