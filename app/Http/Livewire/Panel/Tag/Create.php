<?php

namespace App\Http\Livewire\Panel\Tag;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;
    public $slug;

    protected $rules = [
        'name' => 'required|min:3|max:255|unique:tags',
        'slug' => 'required|min:3|max:255|unique:tags',
    ];

    protected $messages = [
        'name.requred' => 'El nombre es requerido',
        'name.min' => 'El nombre debe tener al menos 3 caracteres',
        'name.max' => 'El nombre debe tener como máximo 255 caracteres',
        'name.unique' => 'El nombre de la etiqueta ya existe',
        'slug.required' => 'El slug es requerido',
        'slug.min' => 'El slug debe tener al menos 3 caracteres',
        'slug.max' => 'El slug debe tener como máximo 255 caracteres',
        'slug.unique' => 'El slug de la etiqueta ya existe',
    ];

    public function makeSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function store()
    {
        $data = $this->validate();

        Tag::create($data);

        return redirect()->route('panel.tag.index')->with('success', 'Etiqueta creada correctamente');
    }

    public function render()
    {
        return view('livewire.panel.tag.create');
    }
}
