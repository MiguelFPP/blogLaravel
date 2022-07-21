<?php

namespace App\Http\Livewire\Panel\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;
    public $slug;

    protected $rules = [
        'name' => 'required|min:3|max:255|unique:categories',
        'slug' => 'required|min:3|max:255|unique:categories'
    ];

    protected $messages = [
        'name.required' => 'El nombre es requerido',
        'name.min' => 'El nombre debe tener al menos 3 caracteres',
        'name.max' => 'El nombre debe tener como máximo 255 caracteres',
        'name.unique' => 'El nombre de la categoria ya existe',
        'slug.required' => 'El slug es requerido',
        'slug.min' => 'El slug debe tener al menos 3 caracteres',
        'slug.max' => 'El slug debe tener como máximo 255 caracteres',
        'slug.unique' => 'El slug de la categoria ya existe'
    ];

    public function makeSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function store()
    {
        $data = $this->validate();

        Category::create([
            'name' => $data['name'],
            'slug' => $data['slug']
        ]);

        return redirect()->route('panel.category.index')->with('success', 'Categoría creada correctamente');
    }

    public function render()
    {
        return view('livewire.panel.category.create');
    }
}
