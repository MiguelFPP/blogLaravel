<?php

namespace App\Http\Livewire\Panel\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = [
        'delete' => 'delete',
    ];

    public function delete($id)
    {
        $post = Post::find($id);
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
