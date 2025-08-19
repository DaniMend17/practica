<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $posts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->whereHas('tags', function ($query) use ($post) {
                $query->whereIn('tags.id', $post->tags->pluck('id'));
            })->get();
        return view('posts.show', compact('post'));
    }
}
