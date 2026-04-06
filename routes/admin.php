<?php

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\LanguageAdminController;
use App\Http\Controllers\Admin\SiteAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use Illuminate\Support\Facades\Route;

// Гостевые роуты
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthAdminController::class, 'login'])->name('login.post');
});

// Защищенные роуты
Route::middleware('auth:admin')->group(function () {



    Route::get('/', [HomeAdminController::class, 'index'])->name('home');
    Route::post('/logout', [AuthAdminController::class, 'logout'])->name('logout');



    // ? languages
    Route::get('/languages', [LanguageAdminController::class, 'index'])->name('languages.index');
    Route::get('/languages/create', [LanguageAdminController::class, 'create'])->name('languages.create');
    Route::post('/languages', [LanguageAdminController::class, 'store'])->name('languages.store');
    Route::get('/languages/{id}/edit', [LanguageAdminController::class, 'edit'])->name('languages.edit');
    Route::put('/languages/{id}', [LanguageAdminController::class, 'update'])->name('languages.update');
    Route::delete('/languages/{id}', [LanguageAdminController::class, 'destroy'])->name('languages.destroy');


    // ? users
    Route::get('/users', [UserAdminController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserAdminController::class, 'create'])->name('users.create');
    Route::post('/users', [UserAdminController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserAdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserAdminController::class, 'update'])->name('users.update');
    // Дополнительный роут для быстрой блокировки
    Route::patch('users/{user}/toggle-block', [UserAdminController::class, 'toggleBlock'])->name('users.toggle-block');



    // ? sites
    // Список всех сайтов
    Route::get('sites', [SiteAdminController::class, 'index'])->name('sites.index');
    // Список всех пользователей с количество сайтов для старта добавления сайта    
    Route::get('users-sites', [SiteAdminController::class, 'indexUsersSites'])->name('user-sites.index');

    // Создание сайта для КОНКРЕТНОГО пользователя
    Route::get('users/{user}/sites/create', [SiteAdminController::class, 'create'])->name('user-sites.create');

    // Стандартные действия (сохранение, редактирование, обновление)
    Route::post('sites', [SiteAdminController::class, 'store'])->name('sites.store');
    Route::get('sites/{site}/edit', [SiteAdminController::class, 'edit'])->name('sites.edit');
    Route::put('sites/{site}', [SiteAdminController::class, 'update'])->name('sites.update');

    // Блокировка сайта
    Route::patch('sites/{site}/toggle-block', [SiteAdminController::class, 'toggleBlock'])->name('sites.toggle-block');
});
