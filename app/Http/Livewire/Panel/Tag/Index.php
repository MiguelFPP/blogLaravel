<?php

namespace App\Http\Livewire\Panel\Tag;

use App\Models\Tag;
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
        $tag = Tag::find($id);
        $tag->delete();
    }

    public function render()
    {
        $tags = Tag::paginate(8);
        return view('livewire.panel.tag.index', compact('tags'));
    }
}
