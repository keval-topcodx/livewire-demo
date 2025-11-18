<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $gender;
    public $phone_no;
    public $hobbies = [];
    public $credits = 0;
    public $image;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'password'   => [
                'bail',
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers(),
            ],
            'phone_no' => ['required', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],
            'gender'     => ['required', 'in:male,female'],
            'hobbies'   => ['required', 'array', 'min:1'],
            'hobbies.*' => ['in:football,movies,music,travelling,gaming'],
        ];
    }



    public function render()
    {
        return view('livewire.user.create');
    }

    public function submit()
    {

        $this->validate();
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'gender' => $this->gender,
            'phone_no' => $this->phone_no,
            'hobbies' => json_encode($this->hobbies),
        ]);

        $user
            ->addMedia($this->image)
            ->toMediaCollection('users');

        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->password = '';
        $this->gender = '';
        $this->phone_no = '';
        $this->hobbies = [];
        $this->credits = 0;
        $this->image = '';
        $this->password_confirmation = '';

        session()->flash('status', 'User Created.');

        $this->redirectRoute('user.index');

    }

}
