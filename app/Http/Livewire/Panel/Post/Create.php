<?php

namespace App\Http\Livewire\Panel\Post;

use App\Models\Tag;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class Create extends Component
{
    public $title;
    public $body;
    public $content;
    public $image;
    public $slug;
    public $status;
    public $category_id;
    public $tags_id = [];

    protected $rules = [
        'status' => 'required',
    ];

    public function makeSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function render()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('livewire.panel.post.create', compact('tags', 'categories'));
    }
}
