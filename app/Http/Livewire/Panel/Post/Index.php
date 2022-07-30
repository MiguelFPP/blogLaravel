<?php

namespace App\Http\Livewire\Panel\Post;

use App\Models\Post;
use App\Models\Image;
use Illuminate\Http\Client\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'id';
    public $order = 'desc';

    protected $listeners = [
        'delete' => 'delete',
    ];

    public function delete($id)
    {
        $images = Image::where('imageable_id', $id)
            ->where('imageable_type', Post::class)
            ->get();
        $post = Post::find($id);

        /* Deleting the images that are related to the post. */
        if ($images) {
            foreach ($images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }
        $post->tags()->detach();
        $post->likes()->delete();
        Storage::disk('public')->delete($post->image);
        $post->delete();
    }

    public function order($sort)
    {
        $this->order = $this->order == 'desc' ? 'asc' : 'desc';
        $this->sort = $sort;
    }

    public function render()
    {
        $posts = Post::select(['posts.*', 'categories.name'])
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->withCount('likes', 'comments')
            ->orderBy($this->sort, $this->order)
            ->where('user_id', auth()->user()->id)
            ->where('title', 'like', '%' . $this->search . '%')
            ->paginate(8);

        return view('livewire.panel.post.index', compact('posts'));
    }
}
