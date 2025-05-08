<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{
    public $name,$email,$password,$confirm_password;
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
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        return redirect(route('users.index'))->with('success', 'User created successfully.');
    }
}
