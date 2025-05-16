<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\Office;

class UserEdit extends Component
{
    public $user, $name,$email, $password, $confirm_password;

    public $role='';
        public $roles = [];
        public $office_id='';
        public $offices=[];
    public function mount($id)
    {
        $this->roles = \Spatie\Permission\Models\Role::pluck('name')->toArray();
        $this->offices= Office::all();
        $this->user = User::find($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        // $this->office =$this->user->getOfficeNames()->first();
        $this->office_id = $this->user->office_id ?? '';
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
            'office_id'=>'required|exists:offices,id',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::findOrFail($this->user->id);
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->office_id = $this->office_id;
        $this->user->save();
        
        $this->user->syncRoles($this->role);
        
        // dd("here");
        return redirect(route('users.index'))->with('success', 'User created successfully.');
    }
}
