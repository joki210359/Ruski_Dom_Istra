<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use App\Models\Post;

class PostFavorite extends Component
{
    public Post $post;

    public function toggleFavorite()
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleFavorite($this->post);

        // Refresh komponentu da promijeni stanje dugmeta
        $this->emit('favoriteToggled');
    }

    public function render()
    {
        return view('livewire.post.post-favorite');
    }
}
