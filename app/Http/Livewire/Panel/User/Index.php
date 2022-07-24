<?php

namespace App\Http\Livewire\Panel\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['delete' => 'delete'];

    public function delete($id)
    {
        $user = User::find($id);

        $posts = Post::where('user_id', $user->id)->get();

        foreach ($posts as $post) {
            $images = $post->images;
            if ($images) {
                foreach ($images as $image) {
                    Storage::delete($image->path);
                    $image->delete();
                }
            }
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
        }

        $user->delete();
    }

    public function render()
    {
        $users = User::where('id', '!=', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(8);
        return view('livewire.panel.user.index', compact('users'));
    }
}
