<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    #[Validate]
    public $name;
    
    #[Validate]
    public $role;
    
    #[Validate]
    public $password;
    
    #[Validate]
    public $email;

    public User $user;

    public function mount(User $user)
    {
        $this->authorize('create', $user);
        $this->user = $user;
        $this->fill($user);
    }

    public function render()
    {
        return view('livewire.users.edit');
    }

    public function rules()
    {
        return [
            'name'=> ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user?->id ?? null, 'id')],
            'password' => ['nullable', 'string', Password::defaults()],
            'role' => ['required', 'string', Rule::in(array_keys(config('user.roles')))],
        ];
    }

    public function save(UserService $userService)
    {
        $this->validate();

        $this->authorize('update', $this->user);
        
        $userService->updateUser(
            user: $this->user,
            name: $this->name,
            email: $this->email,
            role: $this->role,
            password: $this->password
        );

        session()->flash('status', 'User updated successfully.');

        $this->redirectRoute('user.edit', ['user' => $this->user], navigate: true);
    }

    public function delete(UserService $userService)
    {
        $userService->deleteUser(user: $this->user);

        session()->flash('status', 'User deleted successfully.');

        $this->redirectRoute('user.index', navigate: true);
    }
}
