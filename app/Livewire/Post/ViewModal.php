<?php

namespace App\Livewire\Post;

use LivewireUI\Modal\ModalComponent;
use App\Models\Post;

class ViewModal extends ModalComponent
{
    public $post;
public string $postUrl;

    public function mount($post)
    {
        $foundPost = Post::find($post);
        if (!$foundPost) {
            abort(404, 'Post not found.');
        }

        $this->post = $foundPost;
    }

    public function render()
    {
        return view('livewire.post.view-modal');
    }
}

