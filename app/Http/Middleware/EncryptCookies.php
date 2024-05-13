<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {
        Cookie::queue(Cookie::forget('error'));

        if ($request->has('error')) {
            $query = request()->query();
            unset($query['error']);

            $url = url()->current().(! empty($query) ? '/?'.http_build_query($query) : '');

            $cookieLength = 60;
            $error = $request->input('error');

            return redirect()->to($url)->withCookie('error', $error, $cookieLength);

            // return redirect()->to($url);
        }

        $response = $next($request);

        $response->headers->set('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');

        $response->headers->set('Pragma', 'no-cache');

        $response->headers->set('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');

        return $response;

        // return $next($request);
    }
}
