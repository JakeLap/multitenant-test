<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use SensitiveParameter;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createUser(
        string $name,
        string $email,
        string $role,
        #[SensitiveParameter] string $password
    ): User
    {
        $hashed_password = Hash::make($password);

        return User::create([
            'name' => $name,
            'email'=> $email,
            'role' => $role,
            'password' => $hashed_password,
        ]);
    }
}
