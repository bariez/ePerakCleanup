<?php

namespace App\Http\Controllers\Auth;

use App\Events\AuditLog;
use App\Http\Controllers\Auth\AccountInformation;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\WhiteListEmail;
use Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use Workbench\Site\Model\Lookup\AclRoleUser;

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
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new WhiteListEmail],
                'password' => [
                    'required',
                    'regex:/^(?=.*[A-Z])(?=.*\d).*$|^(?=.*[@\].])(?=.*\d).*$|^(?=.*[@\].])(?=.*[A-Z]).*$|^[A-Z]$|^[A-Z]{3,}$/',
                    'min:8',
                    'confirmed',
                ],
                'jabatan' => 'required|string|max:255',
                'notel' => 'required|numeric',
                'Tujuan' => 'nullable|string|max:255',

            ],
            [
                'password.regex' => 'Sila masukkan gabungan abjad, nombor & aksara khas!',
                'password.min' => 'Panjang kata laluan 8 karakter!',
                'password.required' => 'Katalaluan wajib diisi!',
                'email.required' => 'Email wajib diisi!',
                'email.regex' => 'Email Salah Format!',
                'email.unique'=> 'Email Telah Wujud!',

            ]
        );

        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'PENDING',
                'jabatan' => $request->jabatan,
                'jawatan' => $request->jawatan,
                'notel' => $request->notel,
                'Tujuan' => $request->Tujuan,
                'email_verified_at' => date('Y-m-d h:i:s'),
            ]
        );

        $getemailadmin = AclRoleUser::with('user')
                  ->where('role_id', 1)->get();

        foreach ($getemailadmin as $emailto) {
            $dataemail = [
                'name'=>$request->name,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'jawatan' => $request->jawatan,
                'notel' => $request->notel,
                'Tujuan'=> $request->Tujuan,

            ];

            try {
                Mail::send('site::email/emailnewuser', $dataemail, function ($message) use ($name, $email) {
                    $message->from('eperak.gov.my', 'Pemberitahuan');

                    $message->to($emailto->email)->subject('Perlu Kelulusan Pengguna');
                });
            } catch (\Exception $e) {
                $activities = 'Hantar email Permohonan Baru Gagal Dihantar';
                Event::dispatch(new AuditLog('', '', $activities, '', $e));
            }
        }

        try {
            Mail::send('site::email/emailnotifyuser', $dataemail, function ($message) use ($name, $email) {
                $message->from('eperak.gov.my', 'Pemberitahuan');

                $message->to($request->email)->subject('Perlu Kelulusan Pengguna');
            });
        } catch (\Exception $e) {
            $activities = 'Hantar email Permohonan Baru Gagal Dihantar';
            Event::dispatch(new AuditLog('', '', $activities, '', $e));
        }

        return redirect('/auth/register')->with('success', __('Permohonan telah dihantar untuk kelulusan'));
    }
}
