<?php

namespace App\Http\Livewire\Panel\Category;

use App\Models\Category;
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
        $category = Category::find($id);
        $category->delete();
    }

    public function order($sort)
    {
        $this->order = $this->order == 'desc' ? 'asc' : 'desc';
        $this->sort = $sort;
    }

    public function render()
    {
        /* $categories = Category::paginate(8); */
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->paginate(8);
        return view('livewire.panel.category.index', compact('categories'));
    }
}
