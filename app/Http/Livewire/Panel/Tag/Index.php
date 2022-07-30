<?php

namespace App\Http\Livewire\Panel\Tag;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

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
        $tag = Tag::find($id);
        $tag->delete();
    }

    public function order($sort)
    {
        $this->order = $this->order == 'desc' ? 'asc' : 'desc';
        $this->sort = $sort;
    }

    public function render()
    {
        /* $tags = Tag::paginate(8); */
        $tags = Tag::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->paginate(8);
        return view('livewire.panel.tag.index', compact('tags'));
    }
}
