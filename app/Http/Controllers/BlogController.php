<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class BlogController extends Controller
{

    public function index()
    {
        $posts = Post::where('status', true)->orderBy('id', 'desc')->paginate(17);

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

    public function category(Category $category)
    {
        $posts = Post::where('status', true)->where('category_id', $category->id)->orderBy('id')->paginate(17);

        return view('blogs.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()->where('status', true)->orderBy('id')->paginate(17);
        return view('blogs.tag', compact('posts', 'tag'));
    }

    public function show(Post $post)
    {
        $similars = Post::where('status', true)
            ->where('category_id', $post->category_id)
            ->orderBy('id')
            ->limit(5)
            ->get();
        return view('blogs.show', compact('post', 'similars'));
    }
}
