<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    protected $maxAttempts = 5;
    protected $decaySeconds = 60;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|array>
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
            // 'g-recaptcha-response' => 'required|captcha',
           
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return void
     */
    public function authenticate()
    {


        // $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only('email', 'password') + ['status' => 'ACTIVE'], $this->filled('remember'))) {//password x betul

          
            // RateLimiter::hit($this->throttleKey(), $this->decaySeconds);


            throw ValidationException::withMessages(
                [
                    'email' => __('Kata laluan dan emel tidak sepadan. Jika belum berdaftar, sila buat pendaftaran pengguna.'),
                ]
            );

           // return 0;

        }



        // RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return void
     */
    public function ensureIsNotRateLimited()
    {
        // if (!RateLimiter::tooManyAttempts($this->throttleKey(), $this->maxAttempts)) {
        //     return;
        // }

        event(new Lockout($this));

        // $seconds = RateLimiter::availableIn($this->throttleKey());
        $seconds = 0;

        throw ValidationException::withMessages(
            [
                'email' => trans(
                    'auth.throttle',
                    [
                        'seconds' => $seconds,
                        'minutes' => ceil($seconds / 60),
                    ]
                ),
            ]
        );
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
    
}
