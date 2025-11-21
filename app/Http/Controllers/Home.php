<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Redirect;
use Workbench\Dashboard\Http\Controllers\DashboardController as dUser;

class Home extends Controller
{
    // public function __invoke(Request $request): View
    public function __invoke()
    {
        $user = auth()->user();

        if ($user->roles->count() == 0) {
            // no roles ->go to apply roles
            return redirect::to('/indexhome');
        }

        if ($user->hasRole('PENTADBIR SISTEM') == true) {
            return redirect::to('/dashboard/admin');
        }

        if ($user->hasRole('PENGURUSAN TERTINGGI') == true) {
            return redirect::to('/location/topmanage');
        }

        if ($user->hasRole('PENGHULU MUKIM') == true) {
            return redirect::to('/dashboard/penghulumukim');
        }

        if ($user->hasRole('PENTADBIR DAERAH') == true) {
            return redirect::to('/location/admindaerah');
        }

        if ($user->hasRole('DATA ENTRY') == true) {
            return redirect::to('/dataentry/searchkampung/index');
        }

        if ($user->hasRole('KETUA KAMPUNG') == true) {
            return redirect::to('/dashboard/ketuakampung');
        }

    //    if ($user->hasRole('KETUA KAMPUNG') == true) {
    //        return redirect::to('/dashboard/ketuakampung');
       // }
    }

    public function indexhome()
    {
        return redirect::to('/dashboard/homeindex');
    }
}
