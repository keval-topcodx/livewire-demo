<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.user.index', [
            'users' => User::all(),
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->hasMedia('users')) {
            $user->clearMediaCollection('users');
        }

        $user->delete();

        session()->flash('status', 'User deleted successfully.');
    }

}
