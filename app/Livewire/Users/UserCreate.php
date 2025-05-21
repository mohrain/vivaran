<?php

namespace App\Livewire\Users;

use App\Models\Office;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{
    public $users, $name,$email,$password,$confirm_password;

    public $role='';
    public $roles = [];
    public $office_id='';
    public $office_name='';

    public $offices = [];

    public function mount()
    {
        $this->roles = \Spatie\Permission\Models\Role::pluck('name')->toArray();
        $this->offices = Office::all();
    }
    public function render()
    {
    return view('livewire.users.user-create')->layout('layouts.app');
    }


public function submit()
{
    $rules = [
        'name' => 'required',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|min:8|same:confirm_password',
    ];

    // Only super-admin can select office, so require it for them
    if (auth()->user()->hasRole('super-admin')) {
        $rules['office_id'] = 'required|exists:offices,id';
    }

    $this->validate($rules);

    // For admin, force office_id to their own
    if (!auth()->user()->hasRole('super-admin')) {
        $this->office_id = auth()->user()->office_id;
    }

    $user = User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => \Hash::make($this->password),
        'office_id' => $this->office_id,
    ]);
    if ($this->role) {
        $user->assignRole($this->role);
    }

    return redirect(route('users.index'))->with('success', 'User created successfully.');
}

}
