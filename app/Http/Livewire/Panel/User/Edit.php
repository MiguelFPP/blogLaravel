<?php

namespace App\Http\Livewire\Panel\User;

use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $user;
    public $name;
    public $surname;
    public $email;
    public $rol;

    public $user_id;


    public function mount(User $user)
    {
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->email = $user->email;
        $this->rol = $user->rol;
        $this->user_id = $user->id;
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'rol' => 'required',
        ];
    }

    protected $validationAttributes = [
        'name' => 'Nombre',
        'surname' => 'Apellido',
        'email' => 'Correo electrónico',
        'rol' => 'Rol',
    ];

    public function update()
    {
        $this->validate();

        $this->user->name = $this->name;
        $this->user->surname = $this->surname;
        $this->user->email = $this->email;
        $this->user->rol = $this->rol;
        $this->user->save();

        return redirect()->route('panel.user.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function render()
    {
        return view('livewire.panel.user.edit');
    }
}
