<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class NotInterested extends Component
{
    public bool $showSuccessPopup = false;
    public ?string $flashMessage = null;
    public ?string $flashMessageType = null;

    public function markNotInterested()
    {
        try {
            // Ovdje možeš implementirati logiku, npr. označavanje posta kao "not interested"
            // Post::find($this->postId)->update(['interested' => false]);

            $this->showSuccessPopup = true;

            $this->flashMessage = 'Your report has been submitted successfully! Thank you!';
            $this->flashMessageType = 'success';

            // Alpine.js prati ovaj događaj
            $this->dispatch('reportSubmitted');
        } catch (Exception $e) {
            $this->flashMessage = 'An error occurred while submitting the report. Please try again.';
            $this->flashMessageType = 'error';

            Log::error('Report error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.post.not-interested');
    }
}
