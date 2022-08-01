<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view('panel.user.index');
    }

    public function create()
    {
        $this->authorize('create', User::class);
        return view('panel.user.create');
    }

    public function edit(User $user)
    {
        $this->authorize('update', User::class);
        return view('panel.user.edit', compact('user'));
    }
}
