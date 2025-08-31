<?php


namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;

class LanguageDropdown extends Component
{
    public $languages = [
        'en' => ['name' => 'English', 'flag' => '🇺🇸'],
        'hr' => ['name' => 'Hrvatski', 'flag' => '🇭🇷'],
        'ru' => ['name' => 'Русский', 'flag' => '🇷🇺'],
    ];

    public $current;

    public function mount()
    {
        $this->current = App::getLocale();
    }

    public function setLanguage($lang)
    {
        session(['locale' => $lang]);
        App::setLocale($lang);
        $this->current = $lang;
        // Reload page to apply translation
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.language-dropdown');
    }
}
