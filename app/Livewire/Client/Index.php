<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.client.index', [
            'clients' => Client::all(),
        ]);
    }
    public function deleteClient($id)
    {
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            session()->flash('status', 'Client deleted successfully.');
        } else {
            session()->flash('status', 'Client not found.');
        }


    }
}
