<?php


namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Item extends Component
{

    public Post $post;


    public function render()
    {
        // dd($this->post);
        return view('livewire.post.item');
    }
}


/*namespace App\Livewire\Post;

use Livewire\Component;

class Item extends Component
{
    public function render()
    {
        return view('livewire.post.item');
    }
}*/
