<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Http\Controllers\Auth\AccountInformation;
use Workbench\Site\Model\Lookup\AclRoleUser;
use Event;
use App\Providers\AuditLog;


class RegistrationController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|regex:/(.*)@*.gov\.my/i|unique:users|',
                // 'email' => 'required|string|email|max:255|regex:/(.*)@gov\.my/i|unique:users|',
                // 'password' => 'required|string|confirmed|min:8',
                // 'password' => 'required|string|confirmed|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&.~`^()-_+={}:;<>])[A-Za-z\d@$!%*#?&.~`^()-_+={}:;<>]{8,}$/',
                //'password' => 'required|string|confirmed|min:8|regex:/^(?=.*[a-z0-9])[a-z0-9!@#$%&*.]{8,}$/i',
                 'password' => [
                     'required', 
                     'regex:/^(?=.*[A-Z])(?=.*\d).*$|^(?=.*[@\].])(?=.*\d).*$|^(?=.*[@\].])(?=.*[A-Z]).*$|^[A-Z]$|^[A-Z]{3,}$/',
                     'min:8', 
                     'confirmed',
                   ],
                'jabatan' => 'required|string|max:255',
                'notel' => 'required|numeric',



            ],
      //        [
      //     'notel.integer' => 'Sila masukan nombor !',
          
        
      // ]
        );


        Auth::login(
            $user = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'status' => 'PENDING',
                    'jabatan' => $request->jabatan,
                    'jawatan' => $request->jawatan,
                    'notel' => $request->notel,
                    'email_verified_at' => date('Y-m-d h:i:s')
                ]
            )
        );

    $getemailadmin=AclRoleUser::with('user')
                  ->where('role_id',1)->get();

    //email ke admin

    foreach($getemailadmin as $emailto){

        $dataemail = array(
                'name'=>$request->name,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'jawatan' => $request->jawatan,
                'notel' => $request->notel

              );


     try {

         Mail::to(data_get($emailto,'user.email'))->send(new AccountInformation($dataemail));

       } catch (\Exception $e) {

            $activities='Hantar email Permohonan Baru Gagal Dihantar';
             Event::dispatch(new AuditLog('','',$activities,'',$e));
            
        }
      

   }

   //email ke user


     try {

         Mail::to($request->email)->send(new NotifyUserNewRegis($dataemail));

       } catch (\Exception $e) {

            $activities='Hantar email Permohonan Baru Gagal Dihantar';
             Event::dispatch(new AuditLog('','',$activities,'',$e));
            
        }





        // Mail::send('site::email/emailnewuser', $dataemail, function($message)use($name,$email)
        //   {
        //     $message->from('eperak.gov.my', 'Pemberitahuan');

        //     // $message->to($emailto->email)->subject('Perlu Kelulusan Pengguna');

        //      $message->to('dora@3fresources.com')->subject('Perlu Kelulusan Pengguna');


        //   });

   // }

        // if (config('laravolt.platform.features.verification') === false) {
        //     $user->markEmailAsVerified();
        // }

       // event(new Registered($user));

       // return redirect(RouteServiceProvider::HOME)->with('success', __('Your account successfully created'));



        return redirect('/auth/register')->with('success', __('Permohonan telah dihantar untuk kelulusan'));
    // return redirect::to('/auth/register')->withSuccess(__('Permohonan telah dihantar untuk kelulusan'));
    }
}
