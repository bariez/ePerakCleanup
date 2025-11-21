<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'auth',
        // 'middleware' => 'guest' // ni kalau nak redirect terus login
    ],
    function (Router $router) {
        // 🟡 Login
        $router->get('login', [LoginController::class, 'show'])->name('auth::login.show');
        $router->post('login', [LoginController::class, 'store'])->name('auth::login.store');

        // 🟡 Password Reset
        $router->get('forgot', [ForgotPasswordController::class, 'show'])->name('auth::forgot.show');
        $router->post('forgot', [ForgotPasswordController::class, 'store'])->name('auth::forgot.store');

        $router->get('reset/{token}', [ResetPasswordController::class, 'show'])->name('auth::reset.show');
        $router->post('reset/{token}', [ResetPasswordController::class, 'store'])->name('auth::reset.store');

        //  Tambahan route ni untuk form reset-password (baru)
        $router->post('reset-password', [ResetPasswordController::class, 'reset'])->name('auth::reset.password.post');

        // 🟡 Registration
        if (config('laravolt.platform.features.registration')) {
            $router->get('register', [RegistrationController::class, 'show'])->name('auth::registration.show');
            $router->post('register', [RegistrationController::class, 'store'])->name('auth::registration.store');
        }
    }
);

Route::group(
    [
        'prefix' => 'auth',
        'middleware' => 'auth',
    ],
    function (Router $router) {
        // 🟡 Logout
        $router->any('logout', Logout::class)->name('auth::logout');
        $router->get('addlog/{userid}', [Logout::class, 'addlog'])->name('auth::addlog');

        // 🟡 Email Verification (jika aktif)
        if (config('laravolt.platform.features.verification')) {
            $router->get('/verify-email', [\App\Http\Controllers\Auth\VerificationController::class, 'show'])
                ->name('verification.notice');

            $router->post('/verify-email', [\App\Http\Controllers\Auth\VerificationController::class, 'store'])
                ->middleware(['throttle:6,1'])
                ->name('verification.send');

            $router->get('/verify-email/{id}/{hash}', [\App\Http\Controllers\Auth\VerificationController::class, 'update'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
        }
    }
);
