<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        return view('panel.profile.view', compact('user'));
    }
}
