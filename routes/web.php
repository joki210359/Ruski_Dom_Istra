<?php
use App\Livewire\Chat\Index;
use App\Livewire\Chat\Main;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Explore;
use App\Livewire\Home;
use App\Livewire\Post\View\Page;
use App\Livewire\Profile\Home as ProfileHome;
use App\Livewire\Profile\Reels as ProfileReels;
use App\Livewire\Profile\Saved as ProfileSaved;
use App\Livewire\Reels as LivewireReels;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\HtmlTagsController;

// Prvo prikaz izbora jezika
Route::get('/', function () {
    if (!session()->has('locale')) {
        return view('choicelanguage'); // Ako nema odabran jezik, prikazuje choicelanguage
    }
    return redirect()->route('home'); // Ako je jezik odabran, ide na choicelanguage (po želji)
})->name('root');

// Ruta za welcome, može ostati ako želite da korisnici budu preusmjereni na ovu stranicu nakon odabira jezika
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome.page');

// Ruta za choicelanguage
Route::get('/choicelanguage', function () {
    return view('choicelanguage');
})->name('choicelanguage.page');

// Ruta za postavljanje jezika
Route::get('set-language/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'hr', 'ru'])) {
        App::setLocale($lang);
        session()->put('locale', $lang);
    }
    return redirect()->route('welcome.page'); // Preusmjerenje na welcome nakon odabira jezika
})->name('set.language');


// ✅ Ako želiš da postoji i /welcome ruta (dodatno)
//Route::get('/welcome', fn() => view('welcome'))->name('welcome.page');


// ✅ Zaštićene rute
Route::middleware('auth')->group(function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/explore', Explore::class)->name('explore');
    Route::get('/reels', LivewireReels::class)->name('reels');

    // Post
    Route::get('/post/{post}', Page::class)->name('post');

    // Chat
    Route::prefix('chat')->group(function () {
        Route::get('/', Index::class)->name('chat');
        Route::get('/{chat}', Main::class)->name('chat.main');
    });

    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/{user}', ProfileHome::class)->name('profile.home');
        Route::get('/{user}/reels', ProfileReels::class)->name('profile.reels');
        Route::get('/{user}/saved', ProfileSaved::class)->name('profile.saved');
    });

    // Profile settings
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/post/{id}', [PostController::class, 'show'])->name('post.view');

        Route::post('/profile/update-picture', [ProfileController::class, 'updatePicture'])->name('profile.update.picture');
        Route::post('/profile/picture', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');

        Route::get('/profil/profil', [ProfileController::class, 'urediprofil'])->name('profile.urediprofil');
        Route::get('/id/{id}', [ProfileController::class, 'show'])->name('profile.show');
    });

    // Language selector
    //Route::get('/select-language', \App\Livewire\LanguageSelector::class)->name('select-language');
    //Route::get('/select-language', fn() => view('livewire.language-selector'))->name('select-language');

Route::get('/find_html_tags', [HtmlTagsController::class, 'findTags']);

    // Email verification
    Route::prefix('email')->group(function () {
        Route::get('/verify', fn() => view('auth.verify'))->middleware('verified')->name('verification.notice');
        Route::get('/verify/{id}/{hash}', [EmailVerificationPromptController::class, 'verify'])
            ->middleware(['signed'])->name('verification.verify');
        Route::post('/resend', [EmailVerificationPromptController::class, 'resend'])
            ->middleware('throttle:6,1')->name('verification.resend');
    });
});

// Auth routes
require __DIR__ . '/auth.php';
