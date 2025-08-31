<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class SearchUsers extends Component
{
    public $query = '';
    public $results = [];

    // Ova funkcija se poziva svaki put kada se $query promijeni
    public function updatedQuery()
    {
        $search = $this->query;

        // Case-insensitive pretraga po username i name koristeći ILIKE
        $this->results = User::where('username', 'ILIKE', "%{$search}%")
            ->orWhere('name', 'ILIKE', "%{$search}%")
            ->get()
            ->toArray();

        $this->results = User::withCount(['followings', 'followers'])
            ->where('username', 'ILIKE', "%{$search}%")
            ->orWhere('name', 'ILIKE', "%{$search}%")
            ->get();
    }

    public function render()
    {
        return view('livewire.search-users');
    }
}
