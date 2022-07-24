<?php

namespace App\Http\Livewire\Panel\Post;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $post;
    public $title;
    public $body;
    public $content;
    public $image;
    public $slug;
    public $status;
    public $category_id;
    public $tags_id = [];
    public $images = [];

    public $image_new;
    public $post_id;

    protected function rules()
    {
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $this->post->id,
        ];

        if ($this->status == 'published') {
            $rules = array_merge($rules, [
                'body' => 'required',
                /* 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:9196', */
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
        'image_new' => 'imagen',
        'slug' => 'slug',
        'status' => 'estado',
        'category_id' => 'categoria',
        'tags_id' => 'etiquetas',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->content = $post->content;
        $this->image = $post->image;
        $this->slug = $post->slug;
        $this->status = $post->status;
        $this->category_id = $post->category_id;
        $this->tags_id = $post->tags->pluck('id')->toArray();
        $this->images = $post->images->pluck('id')->toArray();
        $this->post_id = $post->id;
    }

    public function makeSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function addImage($image)
    {
        $this->images[] = $image;
    }

    public function update()
    {
        $this->validate();

        if ($this->image_new) {
            $image = $this->image_new->store('posts');
            Storage::delete($this->image);
        }

        $post = Post::find($this->post_id);

        $post->title = $this->title;
        $post->body = $this->body;
        $post->content = $this->content;
        $post->image = $this->image_new ? $image : $this->image;
        $post->slug = $this->slug;
        $post->status = $this->status;
        $post->category_id = $this->category_id;
        $post->tags()->sync($this->tags_id);

        $post->save();

        foreach ($this->images as $image) {
            $img = Image::where('path', $image)
                ->where('imageable_id', $this->post_id)
                ->where('imageable_type', Post::class)
                ->first();

            if (strpos($this->post->content, $image)) {
                $img->update([
                    'imageable_id' => $this->post_id,
                    'imageable_type' => Post::class,
                ]);
            } else {
                Storage::delete('public/' . $image);
                if ($img) {
                    $img->delete();
                }
            }
        }

        return redirect()->route('panel.post.index')->with('success', 'Post actualizado correctamente');
    }


    public function render()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('livewire.panel.post.edit', compact('tags', 'categories'));
    }
}
