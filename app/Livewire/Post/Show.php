<?php
namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Show extends Component
{
    public $post;

    public function mount($id)
    {
        // $this->post = Post::findOrFail($id);
       $this->post = Post::findOrFail($postId); // ✅ Ovo vraća jedan Post model


    }

    public function show($id)
{
    $post = Post::findOrFail($id); // Retrieve the post by ID (or slug)
    return view('posts.show', compact('post')); // Pass $post to the view
}


    public function render()
    {
        // return view('livewire.post-show')
        //     ->layout('layouts.app'); // Obavezno!
            return view('livewire.post.view.page');
    }
}
