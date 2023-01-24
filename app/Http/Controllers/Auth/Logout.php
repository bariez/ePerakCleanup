<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccessLog;
use App\Models\User;
// use App\Models\UserAccessLog;
// use App\Models\User;

class Logout
{
    public function __invoke(Request $request): RedirectResponse
    {


        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();



        return redirect('/');
    }


    public function addlog($userid)
    {

    	//masuk dlm log

    	// $logs=new UserAccessLog;
     //    $logs->user_id=$userid;
     //    $logs->login_at=date('Y-m-d H:i:s');
     //    $logs->IP_Address=request()->ip();
     //    $logs->save();


        $useracesslog = UserAccessLog::where('login_at', '<=', date('Y-m-d H:i:s'))
                          ->whereNull('login_out')
                          ->where('user_id', '=', $userid)
                          ->orderBy('login_at', 'desc')->first();

          $useracesslog->login_out = date('Y-m-d H:i:s');
  		  $useracesslog->save();
         return redirect()->route('auth::logout');


    }
}
