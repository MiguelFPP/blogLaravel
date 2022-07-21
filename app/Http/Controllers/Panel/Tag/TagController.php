<?php

namespace App\Http\Controllers\Panel\Tag;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        return view('panel.tag.index');
    }

    public function create()
    {
        return view('panel.tag.create');
    }

    public function edit(Tag $tag)
    {
        return view('panel.tag.edit', compact('tag'));
    }
}
