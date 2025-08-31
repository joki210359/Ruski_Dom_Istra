<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id); // Pretpostavka: koristiš Eloquent model Post
    return view('post.show', compact('post')); // ili tvoj odgovarajući view
    }
}
