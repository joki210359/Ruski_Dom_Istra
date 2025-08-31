<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class ConfirmButton extends Component
{
    // Javno svojstvo koje će kontrolisati vidljivost pop-up poruke
    public $showSuccessPopup = false;

    /**
     * Metoda koja se poziva kada se klikne na dugme "Confirm".
     * Ovde možete dodati logiku za potvrdu.
     */
    public function markNotInterested()
    {
        // Simulirajte neku logiku (npr. spremanje u bazu, ažuriranje statusa)
        // Obično bi ovde bila neka validacija ili poslovna logika.
        // Npr: $this->someService->confirmAction();

        // Postavite svojstvo na true da prikažete pop-up
        $this->showSuccessPopup = true;

        // Opcionalno: Možete resetovati pop-up nakon određenog vremena
        // Ovaj deo će biti obrađen Alpine.js-om na frontendu za bolji UX.

        // Ako želite da pošaljete flash poruku (za preusmeravanje ili refresh stranice), možete:
        // session()->flash('message', 'Successfully Confirmed');
    }

    /**
     * Renderuje Blade pogled za ovu komponentu.
     *
     * @return View
     */
    public function render()
    {
        return view('livewire.confirm-button');
    }
}
