<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', true)->paginate(17);

        $posts_likes = Post::select('id', 'title', 'image')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->limit(5)
            ->get();

        $count = 1;
        foreach ($posts_likes as $post_like) {
            $post_like->count = $count;
            $count++;
        }


        return view('blogs.index', compact('posts', 'posts_likes'));
    }
}
