<?php

namespace App\Http\Livewire\Panel\Post;

use App\Models\Post;
use App\Models\Image;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

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

    public function render()
    {
        $posts = Post::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        return view('livewire.panel.post.index', compact('posts'));
    }
}
