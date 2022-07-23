<?php

namespace App\Http\Livewire\Panel\Post;

use App\Models\Tag;
use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $body;
    public $content;
    public $image;
    public $slug;
    public $status;
    public $category_id;
    public $tags_id = [];

    protected function rules()
    {
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:posts',
        ];

        if ($this->status == 'published') {
            $rules = array_merge($rules, [
                'body' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:9196',
                'content' => 'required',
                'category_id' => 'required',
                'tags_id' => 'required',
            ]);
        }

        return $rules;
    }

    protected $validationAttributes  = [
        'title' => 'titulo',
        'body' => 'cuerpo del post',
        'content' => 'contenido',
        'image' => 'imagen',
        'slug' => 'slug',
        'status' => 'estado',
        'category_id' => 'categoria',
        'tags_id' => 'etiquetas',
    ];

    public function makeSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function store()
    {
        $this->validate();

        if ($this->image) {
            $image = $this->image->store('posts');
        }

        $post = new Post();

        $post->title = $this->title;
        $post->body = $this->body;
        $post->content = $this->content;
        $post->image = $this->image ? $image : null;
        $post->slug = $this->slug;
        $post->status = $this->status == 'published' ? true : false;
        $post->category_id = $this->category_id;
        $post->user_id = auth()->user()->id;
        $post->save();

        if ($this->tags_id) {
            $post->tags()->sync($this->tags_id);
        }

        return redirect()->route('panel.post.index')->with('success', 'Post creado correctamente');
    }

    public function render()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('livewire.panel.post.create', compact('tags', 'categories'));
    }
}
