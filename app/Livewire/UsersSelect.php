<?php

namespace App\Livewire;

use App\Core\Components;
use Domain\User\Entities\User;

class UsersSelect extends Components
{
    public string $atrName;
    public ?string $role = null;
    public int $selectedId = 0;

    public function render()
    {
        $users = User::query();

        if(!is_null($this->role))
            $users = $users->whereRole($this->role);

        $users = $users->get();

        return view('livewire.users-select', compact('users'));
    }
}
