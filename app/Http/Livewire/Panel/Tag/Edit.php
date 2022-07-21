<?php

namespace App\Http\Livewire\Panel\Tag;

use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $tag;
    public $tag_id;
    public $name;
    public $slug;

    public function mount($tag)
    {
        $this->tag = $tag;
        $this->tag_id = $tag->id;
        $this->name = $tag->name;
        $this->slug = $tag->slug;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:tags,name,' . $this->tag_id,
            'slug' => 'required|string|max:255|unique:tags,slug,' . $this->tag_id,
        ];
    }

    protected $messages = [
        'name.required' => 'El nombre es requerido',
        'name.string' => 'El nombre debe ser una cadena de texto',
        'name.max' => 'El nombre no puede tener más de 255 caracteres',
        'name.unique' => 'El nombre de la etiqueta ya existe',
        'slug.required' => 'El slug es requerido',
        'slug.string' => 'El slug debe ser una cadena de texto',
        'slug.max' => 'El slug no puede tener más de 255 caracteres',
        'slug.unique' => 'El slug de la etiqueta ya existe',
    ];

    public function makeSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function update()
    {
        $data = $this->validate();
        $this->tag->update($data);

        return redirect()->route('panel.tag.index')->with('success', 'Etiqueta actualizada correctamente');
    }

    public function render()
    {
        return view('livewire.panel.tag.edit');
    }
}
