<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public User $user;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $password_confirmation;
    public $phone_no;
    public $gender;
    public $hobbies;
    public $credits;
    public $image;
    public $image_url;

    protected function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'email'      => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user),
            ],
            'password'   => [
                'sometimes',
                'nullable',
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
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }



    public function mount(User $user)
    {
        $this->user = $user;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone_no = $user->phone_no;
        $this->gender = $user->gender;
        $this->credits = $user->credits;
        $this->image_url = $user->image_url;

        $this->hobbies = json_decode($user->hobbies, true);
    }

    public function render()
    {
        return view('livewire.user.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $this->user->password,
            'hobbies' => json_encode($this->hobbies),
            'gender' => $this->gender,
            'phone_no' => $this->phone_no,
        ]);

        if ($this->image) {

            $this->user->clearMediaCollection('users');

            $this->user
                ->addMedia($this->image)
                ->toMediaCollection('users');
        }

        session()->flash('status', 'User Edited Successfully..');

        $this->redirectRoute('user.index');

    }
}
