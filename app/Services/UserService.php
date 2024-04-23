<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use SensitiveParameter;

class UserService
{
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

    public function updateUser(
        User $user,
        string $name,
        string $email,
        string $role,
        #[SensitiveParameter] ?string $password
    ): User
    {
        $data = [
            'name'=> $name,
            'email'=> $email,
            'role'=> $role,
        ];

        if (isset($password)) {
            $data['password'] = Hash::make($password);
        }

        $user->update($data);

        return $user;
    }

    public function deleteUser(User $user): bool|null
    {
        return $user->delete();
    }
}
