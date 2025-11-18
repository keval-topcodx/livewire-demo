<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;

class Create extends Component
{
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
        return view('livewire.client.create');
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

        $client = Client::create([
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
