<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;

class SearchUsers extends Component
{
    public $query = '';
    public $results = [];

    // Poziva se svaki put kada se query promijeni
    public function updatedQuery()
    {
        $search = $this->query;

        $this->results = User::where('username', 'ILIKE', "%{$search}%")
            ->orWhere('name', 'ILIKE', "%{$search}%")
            ->get()
            ->toArray();
    }


    public function render()
    {
        return view('livewire.search-users');
    }
}

