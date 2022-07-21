<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('panel.category.index');
    }

    public function create()
    {
        return view('panel.category.create');
    }

    public function edit(Category $category)
    {
        return view('panel.category.edit', compact('category'));
    }
}
