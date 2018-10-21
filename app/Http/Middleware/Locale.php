<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Config;
use Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $sessionLocale = Session::get('locale');
        if(in_array($sessionLocale, Config::get('app.locales'))){
            App::setLocale($sessionLocale);
        }

        return $next($request);
    }
}