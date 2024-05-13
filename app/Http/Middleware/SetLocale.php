<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Config;
use Curl;
use Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
        } else {
            $locale = 'ms'; //substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

            if ($locale != 'en') {
                $locale = 'ms';
            }
        }

        App::setLocale($locale);

        // $abc = file_get_contents('https://soa-dev.hasil.gov.my/SVCSSO/SSOService.svc/user/RequestToken');
        // $obj = json_decode($abc);

        // dd($obj );
        // // dd(\session()->all());

        // dd(\Cookie::get('cookiesession1'));

        // $response = Curl::to('https://soa-dev.hasil.gov.my/SVCSSO/SSOService.svc/user/RequestToken')
        //                   ->returnResponseObject()
        //                   ->get();

        // $data = $response->content;
        // dd($data);

        return $next($request);
    }
}
