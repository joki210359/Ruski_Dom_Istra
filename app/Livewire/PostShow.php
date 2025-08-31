<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostShow extends Component
{
    public Post $post;

    public function mount($id)
    {
        $this->post = Post::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.post-show')->layout('layouts.app');
    }
}
