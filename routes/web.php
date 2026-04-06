<?php

use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\AppController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



// Route::group([
//     'prefix' => LaravelLocalization::setLocale(),
//     'middleware' => ['localizationRedirect', 'localeViewPath']
// ], function () {


//     Route::get('/', function () {
//         return "
//             <h1>" . __('messages.welcome') . "</h1>
//             <p>Current Locale: " . app()->getLocale() . "</p>

//         ";
//     });
// });


Route::get('/', function () {
    return "Home page";
});




// ? auth

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])->name('login');

    Route::get('/password-reset', [AuthController::class, 'indexPasswordReset'])->name('password-reset');
    Route::post('/password-reset', [AuthController::class, 'passwordReset'])->name('password-reset.post');

    Route::get('/new-password/{token}', [AuthController::class, 'indexNewPassword'])->name('new-password');
    Route::post('/new-password', [AuthController::class, 'newPassword'])->name('new-password.post');

    Route::get('/new-password', function () {
        return redirect()->route('password-reset');
    });
});

Route::middleware(['guest', 'throttle:user-auth'])->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});



Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');

    Route::get('/apps', [AppController::class, 'index'])->name('apps');
});





// routes/web.php
// Route::fallback(function () {
//     if (request()->user()) {
//         return response()->view('errors.user_404', [], 404);
//     }
//     return response()->view('errors.404', [], 404);
// });



// ? Test route
Route::get('/test', [TestController::class, 'index'])->name('test');
Route::get('/test-config', [TestController::class, 'getTestConfig'])->name('test-config');