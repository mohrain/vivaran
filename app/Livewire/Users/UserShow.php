<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class UserShow extends Component
{
    public $user;
    public function mount($id)
    {
        $this->user = User::find($id);

    }
    public function render()
    {
        return view('livewire.users.user-show')->layout('layouts.app');
    }
}
