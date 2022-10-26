<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // if (request('change_language')) {
        //     session()->put('language', request('change_language'));
        //     $language = request('change_language');
        // } elseif (session('language')) {
        //     $language = session('language');
        // } elseif (config('panel.primary_language')) {
        //     $language = config('panel.primary_language');
        // }

        // if (isset($language)) {
        //     app()->setLocale($language);
        // }

        // this it was used for setting locale
        // app()->setLocale($request->segment(1));
        // if ($request->segment(1) != 'en' && $request->segment(1) != 'es'){
        //     app()->setLocale('en');
        // }
        // return $next($request);

        return $next($request);
    }
}
