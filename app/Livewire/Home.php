<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class Home extends Component
{
    public $posts;

    function mount()
    {

        $this->posts = Post::latest()->get();

        // dd( $this->posts);

    }

    public function render()
    {
        return view('livewire.home');
    }
}


//namespace App\Livewire;
//
//use Livewire\Component;
//
//class Home extends Component
//{
//    public function render()
//    {
//        // Promenili smo view na 'welcome' umesto 'livewire.home'
//        return view('welcome');
//    }
//}
