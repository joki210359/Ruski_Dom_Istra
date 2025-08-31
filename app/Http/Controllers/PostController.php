<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Prikazuje sve postove.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10); // Bolje od all() ako ima puno podataka
        return view('posts.index', compact('posts'));
    }

    /**
     * Prikazuje pojedinačni post.
     */
    public function show(int $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
