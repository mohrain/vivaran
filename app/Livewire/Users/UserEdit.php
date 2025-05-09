<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserEdit extends Component
{
    public $user, $name,$email, $password, $confirm_password;

    public $role='';
        public $roles = [];
    public function mount($id)
    {
        $this->roles = \Spatie\Permission\Models\Role::pluck('name')->toArray();
        $this->user = User::find($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $this->user->getRoleNames()->first();
    }

    public function render()
    {
        return view('livewire.users.user-edit')->layout('layouts.app');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|string|exists:roles,name',
        ]);
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->syncRoles($this->role);
        
        $this->user->save();
        // dd("here");
        return redirect(route('users.index'))->with('success', 'User Updated.');
    }
}
