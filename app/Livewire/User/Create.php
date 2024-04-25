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

    public function mount()
    {
        $this->authorize('create', User::class);
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

        $this->authorize('create', User::class);
        
        $userService->createUser(
            name: $this->name,
            email: $this->email,
            role: $this->role,
            password: $this->password
        );

        session()->flash('status', 'User created successfully.');

        $this->redirectRoute('user.index', navigate: true);
    }
}
