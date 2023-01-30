<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Routing\Controller;
use App\Models\UserAccessLog;
use App\Models\User;
use Redirect;


class LoginController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show()
    {
    
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {





        $request->authenticate();

        //dd($request->authenticate());

         // if($request->authenticate()===0){

         //    $checklogin=User::where('email',$request->email)->count();



         //    if($checklogin==0){
         //     return redirect()
         //        ->route('auth::login.show')
         //        ->with('success', trans('xxxx'));

                

         //    }

         // }

        $user_id=User::where('email',$request->email)->first();

        if($request->authenticate()===null){


         
        $logs=new UserAccessLog;
        $logs->user_id=data_get($user_id,'id');
        $logs->login_at=date('Y-m-d H:i:s');
        $logs->IP_Address=request()->ip();
        $logs->save();

        }

        $lastlogin=User::find(data_get($user_id,'id'));
        $lastlogin->last_login_at=date('Y-m-d H:i:s');
        $lastlogin->save();

        $request->session()->regenerate();


        return redirect()->intended(RouteServiceProvider::HOME);
    }
 
}
