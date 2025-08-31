<?php
namespace App\Livewire\Post;

use LivewireUI\Modal\ModalComponent;

class NotInterested extends ModalComponent
{
    public $postId;
    public $showSuccessPopup = false;

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function markNotInterested()
    {
        // Logika spremanja

        $this->showSuccessPopup = true;

        // Emitiraj event roditeljskoj komponenti za osvježavanje
        $this->dispatch('refresh-posts');

        // Zatvori modal s odgodom radi prikaza pop-upa
        $this->dispatch('close-modal-with-delay');
        
    }

    public function render()
    {
        return view('livewire.post.not-interested');
    }
}
