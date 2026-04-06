<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix(config('app.admin_prefix')) // Берем префикс из конфига
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->alias([
            'localize'                => LaravelLocalizationRoutes::class,
            'localizationRedirect'    => LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => LocaleSessionRedirect::class,
            'localeCookieRedirect'    => LocaleCookieRedirect::class,
            'localeViewPath'     => LaravelLocalizationViewPath::class,
        ]);

        // Настраиваем, куда отправлять гостей (неавторизованных)
        $middleware->redirectTo(
            guests: function (Request $request) {
                // Если запрос начинается с нашего секретного префикса админки
                if ($request->is(config('app.admin_prefix') . '*')) {
                    return route('admin.login');
                }

                // Для всех остальных (клиентов) отправляем на обычный логин или главную
                return route('login'); // Если роута 'login' еще нет, можно написать '/'
            }
        );

        // Куда отправлять УЖЕ авторизованных пользователей, 
        // если они лезут на страницу логина/регистрации
        $middleware->redirectUsersTo(function (Request $request) {
            if (Auth::guard('admin')->check()) {
                return route('admin.home');
            }

            // По умолчанию для обычных пользователей (когда сделаем кабинет)
            return route('account');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
