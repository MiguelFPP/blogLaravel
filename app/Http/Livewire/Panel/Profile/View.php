<?php

namespace App\Http\Livewire\Panel\Profile;

use App\Events\PasswordChangeEvent;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class View extends Component
{
    /* informacion de usuario */
    public $user;
    public $name;
    public $surname;
    public $email;

    /* password */
    public $actual_pass;
    public $new_pass;
    public $new_pass_confirmation;

    public $user_id;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|min:3',
            'surname' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:60|unique:users,email,' . $this->user_id,
            'actual_pass' => 'required|string|min:6',
            'new_pass' => 'required|string|min:6|confirmed',
            'new_pass_confirmation' => 'required|string|min:6',
        ];
    }

    protected $validationAttributes = [
        'name' => 'nombre',
        'surname' => 'apellido',
        'email' => 'correo electrónico',
        'actual_pass' => 'contraseña actual',
        'new_pass' => 'contraseña nueva',
        'new_pass_confirmation' => 'confirmación de contraseña nueva',
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

    public function updatePassword()
    {
        $this->validate();

        $user = User::find(auth()->user()->id);

        if (Hash::check($this->actual_pass, $user->password)) {
            $user->password = Hash::make($this->new_pass);
            $user->save();

            /* send notificacion */

            event(new PasswordChangeEvent($user));

            $this->emit('passwordUpdated');

            $this->actual_pass = '';
            $this->new_pass = '';
            $this->new_pass_confirmation = '';
        } else {
            $this->emit('passwordError');
        }
    }

    public function render()
    {
        return view('livewire.panel.profile.view');
    }
}
