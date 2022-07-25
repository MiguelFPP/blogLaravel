<?php

namespace App\Http\Livewire\Panel\User;

use App\Events\RegisterUser;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public $name;
    public $surname;
    public $email;
    public $rol;

    protected $rules = [
        'name' => 'required|min:3',
        'surname' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'rol' => 'required',
    ];

    protected $validationAttributes = [
        'name' => 'Nombre',
        'surname' => 'Apellido',
        'email' => 'Correo electrónico',
        'rol' => 'Rol',
    ];

    public function store()
    {
        $this->validate();

        $pass = Str::random(8);

        $user = new User();
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->email = $this->email;
        $user->rol = $this->rol;
        $user->password = Hash::make($pass);
        $user->email_verified_at = now();
        $user->save();

        event(new RegisterUser($user, $pass));

        return redirect()->route('panel.user.index')->with('success', 'Usuario creado correctamente');
    }

    public function render()
    {
        return view('livewire.panel.user.create');
    }
}
