<?php
namespace App\Livewire;

use Exception;
use Livewire\Component;
use App\Models\Report;
use Illuminate\Support\Facades\Mail;

class ApplicationForm extends Component
{
    public $name;
    public $email;
    public $reason;

    public function sendApplicationMethod()
    {
        $this->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'reason' => 'required|string',
        ]);

        try {
            // Spremi u bazu
            Report::create([
                'name' => $this->name,
                'email' => $this->email,
                'reason' => $this->reason,
            ]);

            // Pošalji korisniku
            Mail::raw("Hi {$this->name},\n\nThank you for your report.\n\nReason: {$this->reason}", function ($message) {
                $message->to($this->email)
                        ->subject('Your report has been received');
            });

            // Pošalji adminu kopiju
            Mail::raw("New report submitted:\n\nName: {$this->name}\nEmail: {$this->email}\nReason: {$this->reason}", function ($message) {
                $message->to('dujovan@outlook.com') // ⚠️ Promijeni ovo u pravu admin adresu
                        ->subject('New report received');
            });

            session()->flash('message', 'Report successfully sent. A confirmation was sent to your email.');
            $this->reset(['name', 'email', 'reason']);
        } catch (Exception $e) {
            session()->flash('error', 'Failed to send report. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.application-form');
    }
}
