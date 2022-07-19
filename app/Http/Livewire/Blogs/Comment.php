<?php

namespace App\Http\Livewire\Blogs;

use App\Models\Comment as ModelsComment;
use Livewire\Component;

class Comment extends Component
{
    public $post;
    public $content;

    protected $rules = [
        'content' => 'required',
    ];

    protected $listeners = [
        'render'
    ];

    public function comment()
    {
        $data = $this->validate();

        ModelsComment::create([
            'post_id' => $this->post->id,
            'content' => $data['content'],
            'user_id' => auth()->user()->id,
        ]);

        $this->content = '';

        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.blogs.comment');
    }
}
