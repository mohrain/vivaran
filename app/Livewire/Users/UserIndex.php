<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Office;

class UserIndex extends Component
{
    public function render()
    {

        if (!auth()->user()->hasRole('super-admin')) {
         $users=  User::where('office_id', auth()->user()->office_id)->get();
        }
        else{
         $users = User::get();
        }



    return view('livewire.users.user-index', compact('users'))->layout('layouts.app');
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        session()->flash('success', 'User Deleted.');
    }

}
