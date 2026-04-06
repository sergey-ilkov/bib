<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Model::preventLazyLoading(!app()->isProduction());

        Paginator::useBootstrapFive();


        app(RateLimiter::class)->for('user-auth', function (Request $request) {
            $key = $request->input('email') . '|' . $request->ip();
            return Limit::perMinutes(10, 5)->by($key)->response(function () {
                return response()->json([
                    'errors' => ['login' => ['Too many login attempts. Please try again in 10 minutes.']],
                ], 429);
            });
        });
    }
}