<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Office;

class UserCreate extends Component
{
    public function render()
    {
    return view('livewire.users.user-create')->layout('layouts.app');
    }
}
