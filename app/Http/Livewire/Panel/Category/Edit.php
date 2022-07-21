<?php

namespace App\Http\Livewire\Panel\Category;

use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $category;
    public $category_id;
    public $name;
    public $slug;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->category_id,
            'slug' => 'required|string|max:255|unique:categories,slug,' . $this->category_id,
        ];
    }

    protected $messages = [
        'name.required' => 'El nombre es requerido',
        'name.string' => 'El nombre debe ser una cadena de texto',
        'name.max' => 'El nombre no puede tener más de 255 caracteres',
        'name.unique' => 'El nombre de la categoria ya existe',
        'slug.required' => 'El slug es requerido',
        'slug.string' => 'El slug debe ser una cadena de texto',
        'slug.max' => 'El slug no puede tener más de 255 caracteres',
        'slug.unique' => 'El slug de la categoria ya existe',
    ];


    public function mount($category)
    {
        $this->category = $category;
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function makeSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function update()
    {
        $data = $this->validate();
        $this->category->update($data);

        return redirect()->route('panel.category.index')->with('success', 'Categoria actualizada correctamente');
    }

    public function render()
    {
        return view('livewire.panel.category.edit');
    }
}
