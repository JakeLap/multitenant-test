<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public $name;
    
    #[Validate]
    public $role;
    
    #[Validate]
    public $password;
    
    #[Validate]
    public $email;

    private ?User $user = null;

    public function mount(?User $user)
    {
        $this->user = $user;
        $this->name = $user?->name;
        $this->role = $user?->role;
        $this->email = $user?->email;
        $this->password = $user?->password;
    }

    public function render()
    {
        return view('livewire.users.create');
    }

    public function rules()
    {
        return [
            'name'=> ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user?->id ?? null, 'id')],
            'password' => ['required', 'string', Password::defaults()],
            'role' => ['required', 'string', Rule::in(array_keys(config('user.roles')))],
        ];
    }

    public function save(UserService $userService)
    {
        $this->validate();

        dd($this->user);
        
        $userService->createUser(
            name: $this->name,
            email: $this->email,
            role: $this->role,
            password: $this->password
        );
    }
}
