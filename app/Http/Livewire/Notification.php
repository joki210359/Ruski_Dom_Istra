<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public function markNotificationsAsRead()
    {
        // Ovdje ide tvoja logika za označavanje notifikacija kao pročitanih
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
