<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{
    public $users, $name,$email,$password,$confirm_password;

    public $role='';
    public $roles = [];
    public function mount()
    {
        $this->roles = \Spatie\Permission\Models\Role::pluck('name')->toArray();
    }
    public function render()
    {
    return view('livewire.users.user-create')->layout('layouts.app');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|same:confirm_password',
            // 'role' => 'nullable|string|exists:roles,id',
        ]);

        // dd($this->roles);
        $user=User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        if($this->role){
            $user->assignRole($this->role);
        }

        return redirect(route('users.index'))->with('success', 'User created successfully.');
    }

}
