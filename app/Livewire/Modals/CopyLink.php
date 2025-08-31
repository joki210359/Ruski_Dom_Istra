<?php

namespace App\Livewire\Modals;

use Livewire\Component;

class CopyLink extends Component
{
    public $postId;
    public $show = false;
    public $copied = false;

    protected $listeners = ['openCopyLinkModal'];

    public function openCopyLinkModal($postId)
    {
        $this->postId = $postId;
        $this->show = true;
        $this->copied = false;
    }

    public function copy()
    {
        $this->copied = true;
        $this->dispatch('copied-success');
        $this->dispatch('close-after-delay');
    }

    public function close()
    {
        $this->show = false;
    }

    public function render()
    {
            $url = $this->postId ? route('post.show', ['post' => $this->postId]) : '';

    return view('livewire.modals.copy-link', ['url' => $url]);
    }
}
