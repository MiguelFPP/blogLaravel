<?php

namespace App\Http\Livewire\Panel\Profile;

use App\Models\User;
use Livewire\Component;

class View extends Component
{
    public $user;
    public $name;
    public $surname;
    public $email;

    public $user_id;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|min:3',
            'surname' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:60|unique:users,email,' . $this->user_id,
        ];
    }

    protected $validationAttributes = [
        'name' => 'nombre',
        'surname' => 'apellido',
        'email' => 'correo electrónico',
    ];

    public function mount(User $user)
    {
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->email = $user->email;
    }

    public function updateInfo()
    {
        $this->validate();

        $user = User::find(auth()->user()->id);

        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->email = $this->email;
        $user->save();

        $this->emit('userUpdated');
    }

    public function render()
    {
        return view('livewire.panel.profile.view');
    }
}
