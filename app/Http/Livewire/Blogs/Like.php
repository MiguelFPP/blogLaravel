<?php

namespace App\Http\Livewire\Blogs;

use App\Models\Post;
use Livewire\Component;

class Like extends Component
{
    public $post;
    public $isLiked;
    public $likesCount;

    public function mount(Post $post)
    {
        if (auth()->check()) {
            $this->isLiked = $post->checkLike(auth()->user());
        } else {
            $this->isLiked = false;
        }
        $this->likesCount = $post->likes->count();
    }

    public function like()
    {
        if (auth()->check()) {
            if ($this->post->checkLike(auth()->user())) {
                $this->post->likes()->where('post_id', $this->post->id)
                    ->where('user_id', auth()->user()->id)
                    ->delete();
                $this->isLiked = false;
                $this->likesCount--;
            } else {
                $this->post->likes()->create([
                    'user_id' => auth()->user()->id
                ]);
                $this->isLiked = true;
                $this->likesCount++;
            }
        } else {
            session()->flash('error', 'Debes iniciar sesión para poder darle me gusta a un post');
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.blogs.like');
    }
}
