<?php

namespace App\Http\Livewire\Panel\Category;

use App\Models\Category;
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
        $category = Category::find($id);
        $category->delete();
    }

    public function render()
    {
        $categories = Category::paginate(8);
        return view('livewire.panel.category.index', compact('categories'));
    }
}
