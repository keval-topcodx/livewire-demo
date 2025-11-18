<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;

class Edit extends Component
{
    public Client $client;
    public $step = 1;
    public $name;
    public $email;
    public $phone_no;
    public $primary_goal;
    public $company_name;
    public $industry;
    public $team_size;
    public $feedback;
    public $discovery_method;

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->name = $client->name;
        $this->email = $client->email;
        $this->phone_no = $client->phone_no;
        $this->primary_goal = $client->primary_goal;
        $this->company_name = $client->company_name;
        $this->industry = $client->industry;
        $this->team_size = $client->team_size;
        $this->feedback = $client->feedback;
        $this->discovery_method = $client->discovery_method;

    }

    public function nextStep()
    {
        switch($this->step) {
            case '1' :
                $this->validate([
                    'name' => ['required', 'string', 'min:3'],
                    'email' => ['required', 'email'],
                    'phone_no' => ['required', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],
                ]);
                break;

            case '2' :
                $this->validate([
                    'primary_goal' => ['required']
                ]);
                break;

            case '3' :
                $this->validate([
                    'company_name' => ['required', 'string', 'min:3'],
                    'industry' => ['required'],
                    'team_size' => ['required'],
                ]);
                break;

            default:
                break;
        }
        $this->step++;
    }
    public function previousStep()
    {
        $this->step--;
    }


    public function render()
    {
        return view('livewire.client.edit');
    }

    public function submit()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
            'phone_no' => ['required', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],
            'primary_goal' => ['required'],
            'company_name' => ['required', 'string', 'min:3'],
            'industry' => ['required'],
            'team_size' => ['required'],
            'feedback' => ['nullable'],
            'discovery_method' => ['required'],
        ]);

        $this->client->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
            'primary_goal' => $this->primary_goal,
            'company_name' => $this->company_name,
            'industry' => $this->industry,
            'team_size' => $this->team_size,
            'feedback' => $this->feedback,
            'discovery_method' => $this->discovery_method,
        ]);

        $this->redirectRoute('client.index');
    }

}
