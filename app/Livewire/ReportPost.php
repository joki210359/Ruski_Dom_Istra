<?php

namespace App\Livewire;

use Exception;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\PostReport;

class ReportPost extends ModalComponent
{
    public $postId;
    public $name;
    public $email;
    public $reason = '';

    public $flashMessage = '';
    public $flashMessageType = '';

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->flashMessage = '';
        $this->flashMessageType = '';
    }

    public function sendApplicationMethod()
    {
        $this->resetErrorBag();
        $this->flashMessage = '';

        $this->validate([
            'name'   => 'required|string|min:3|max:100',
            'email'  => 'required|email',
            'reason' => 'required|string|min:10|max:500',
        ]);

        try {
            Mail::raw("Dear {$this->name},\n\nYour report for post ID: {$this->postId} has been received.\n\nReason: {$this->reason}", function ($message) {
                $message->to($this->email)->subject('Report Confirmation');
            });

            Mail::raw("New Report Received for Post ID: {$this->postId}\n\nName: {$this->name}\nEmail: {$this->email}\nReason: {$this->reason}", function ($message) {
                $message->to('dujovan@outlook.com')->subject('New Post Report');
            });

            PostReport::create([
                'post_id' => $this->postId,
                'name'    => $this->name,
                'email'   => $this->email,
                'reason'  => $this->reason,
            ]);

            $this->flashMessage = 'Your report has been submitted successfully! Thank you!';
            $this->flashMessageType = 'success';

            $this->reset(['name', 'email', 'reason']);

            // Dispatch event koji Alpine.js prati
            $this->dispatch('reportSubmitted');
        } catch (Exception $e) {
            $this->flashMessage = 'An error occurred while submitting the report. Please try again.';
            $this->flashMessageType = 'error';
            Log::error('Report error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.report-post');
    }
}
