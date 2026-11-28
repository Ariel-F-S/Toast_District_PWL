<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                $role = $request->user()->role;

                return match ($role) {
                    'owner' => redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali, Owner!'),
                    'kasir' => redirect()->intended('/kasir')->with('success', 'Selamat bertugas, Kasir!'),
                    default => redirect()->intended('/')->with('success', 'Login berhasil!'),
                };
            }
        });

        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
            public function toResponse($request)
            {
                return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang di Toast.district.');
            }
        });

        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/login')->with('success', 'Kamu telah berhasil logout.');
            }
        });
    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::loginView(function () {
            return view('auth.auth-slider', ['isRegister' => false]);
        });

        Fortify::registerView(function () {
            return view('auth.auth-slider', ['isRegister' => true]);
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email . $request->ip());
        });
    }
}