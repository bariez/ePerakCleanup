<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Providers\RouteServiceProvider;

class ResetPasswordController extends Controller
{
    /**
     * Papar borang reset katalaluan.
     */
    public function show(Request $request, string $token = null)
    {
        return view('auth.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

  /**
     * Simpan katalaluan baru pengguna.
     * TUKAR DARI 'store' KEPADA 'reset' DI SINI
     */
    public function reset(Request $request)
    {
        $request->validate(
            [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|string|confirmed|min:8',
            ],
            [
                'password.min' => 'Panjang kata laluan mesti 8 karakter!',
                'password.required' => 'Katalaluan wajib diisi!',
                'email.required' => 'Email wajib diisi!',
            ]
        );

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect('/auth/login')
                ->with('status', 'Katalaluan anda telah berjaya ditetapkan semula!');
        }

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
