<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('panel.user.index');
    }

    public function create()
    {
        return view('panel.user.create');
    }

    public function edit(User $user)
    {
        return view('panel.user.edit', compact('user'));
    }
}
