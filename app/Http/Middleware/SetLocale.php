<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Ako nije postavljen jezik, postaviti default iz sesije
        $locale = Session::get('locale', config('app.locale'));

        // Provjeri da li je odabrani jezik podržan
        if (in_array($locale, ['en', 'hr', 'ru'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
