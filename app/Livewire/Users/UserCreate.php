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
        $this->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|same:confirm_password',
            // 'office_id' => 'nullable|exists:offices,id',
            // 'role' => 'nullable|string|exists:roles,name',
            // 'role' => 'nullable|string|exists:roles,id',
        ]);
        if(Auth::user()->office_id){
        $this->office_id = Auth::user()->office_id;
        }

        // dd($this->roles);
        $user=User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'office_id' => $this->office_id,
        ]);
        if($this->role){
            $user->assignRole($this->role);
        }

        return redirect(route(' users.index'))->with('success', 'User created successfully.');
    }

}
