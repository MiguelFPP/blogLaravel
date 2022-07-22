<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('panel.post.index');
    }

    public function create()
    {
        return view('panel.post.create');
    }

    public function edit(Post $post)
    {
        return view('panel.post.edit', compact('post'));
    }
}
