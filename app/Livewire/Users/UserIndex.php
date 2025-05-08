<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Office;

class UserIndex extends Component
{
    public function render()
    {
    return view('livewire.users.user-index')->layout('layouts.app');
    }
}
