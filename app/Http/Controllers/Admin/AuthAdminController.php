<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\BlockingAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    //
    // Показать форму входа
    public function showLoginForm(Request $request, BlockingAdmin $services)
    {



        if ($services->isBlocked($request)) {
            return view('admin.auth.login')->with('blocking', 'the user is blocked');
        }

        return view('admin.auth.login');
    }

    // Обработка отправки формы
    public function login(Request $request, BlockingAdmin $services)
    {
        if ($services->isBlocked($request)) {
            return view('admin.auth.login')->with('blocking', 'the user is blocked');
        }

        // 1. Валидация
        $validation = $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $data = clearTags($validation);
        // 2. Попытка входа через guard 'admin'
        // Мы используем Auth::guard('admin'), чтобы Laravel не путал админа с обычным пользователем
        if (Auth::guard('admin')->attempt($data, $request->remember)) {
            // Регенерируем сессию для защиты от фиксации сессии
            $request->session()->regenerate();

            return redirect()->intended(route('admin.home'));
        }

        $services->createOrUpdateBlockedUser($request);

        // 3. Если данные неверны
        return back()->withErrors([
            'login' => 'wrong login or password',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}