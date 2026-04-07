<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    protected $channel;

    public function __construct()
    {
        //
        $this->channel = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/auth.log'),
        ]);
    }


    //
    public function index()
    {
        // 
        return view('account.auth.login', ['title' => 'Sign In']);
    }


    public function login(Request $request)
    {
        // 
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = clearData($credentials);
        // Пытаемся авторизовать
        if (Auth::attempt($data)) {
            $user = Auth::user();

            // Проверка на блокировку пользователя
            if ($user->is_blocked) {
                Auth::logout();
                return response()->json([
                    'errors' => ['email' => ['Your account has been blocked.']]
                ], 422);
            }

            return response()->json([
                'success' => true,
                'redirect' => route('apps')
            ]);
        }
        return response()->json([
            'errors' => ['email' => ['Incorrect login or password.']],
            // 'errors' => ['email' => ['Неверный логин или пароль.', 'i Magic']]
        ], 422);
    }


    public function indexPasswordReset()
    {
        // 

        // return view('frontend.emails.password-reset', ['url' => route('new-password', 'dsdsds2312')]);

        return view('account.auth.passwort-reset', ['title' => 'Password Reset']);
    }


    public function passwordReset(Request $request)
    {
        // 
        $credentials = $request->validate([
            'email' => 'required|email',
        ]);

        $data = clearData($credentials);

        $email = $data['email'];

        $user = User::where('email', $email)->first();


        $sendMail = null;

        if ($user) {
            try {
                $token = Str::random(64);

                // Сохраняем токен в стандартную таблицу Laravel password_reset_tokens
                DB::table('password_reset_tokens')->updateOrInsert(
                    ['email' => $email],
                    ['token' => $token, 'created_at' => now()]
                );

                // Отправка почты
                $sendMail = true;
                // $sendMail = Mail::to($request->email)->send(new ResetPasswordMail($token));


            } catch (Exception $ex) {
                Log::stack([$this->channel])->error('Error send email password reset: ', ['error' => $ex->getMessage()]);
            }
        } else {
            return response()->json([
                'errors' => ['email' => ['There is no registered user with this email.']],
            ], 422);
        }


        if ($sendMail) {

            return response()->json([
                'success' => true,
                'messages' => ['sending' => ["An email has been send on email {$email}", 'Click the link in email to reset your password']],
            ]);
        }

        return response()->json([
            'errors' => ['sending' => ['There was an error sending your email, please try again.']],
        ], 422);
    }


    public function indexNewPassword($token)
    {
        // 
        $resetData = DB::table('password_reset_tokens')->where('token', $token)->first();
        // $resetData = DB::table('password_reset_tokens')->where('token', 'Q9hlAyPMoCmIutsPXuyF8BSO61yj7OATOguNCWICNNAS83QFtzgJ0nMrvS10zNkC')->first();

        // dd($resetData);
        if ($resetData && Carbon::parse($resetData->created_at)->addMinutes(60) < Carbon::now()) {
            $resetData = null;
        }

        return view('account.auth.new-password', ['title' => 'New Password', 'token' => $token, 'resetData' => $resetData]);
    }


    public function newPassword(Request $request)
    {
        // 
        $credentials = $request->validate([
            'token' => 'required',
            'password' => 'required|min:12',
        ]);

        $resetData = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if (!$resetData) {
            return response()->json(['message' => 'Invalid or expired token.'], 400);
        }
        if (Carbon::parse($resetData->created_at)->addMinutes(60) < Carbon::now()) {
            // Удаляем использованный токен
            DB::table('password_reset_tokens')->where('email', $resetData->email)->delete();

            return response()->json(['message' => 'Invalid or expired token.'], 400);
        }



        $data = clearData($credentials);

        $user = User::where('email', $resetData->email)->first();
        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        // Удаляем использованный токен
        DB::table('password_reset_tokens')->where('email', $resetData->email)->delete();

        return response()->json([
            'success' => true,
            'message' => 'New password saved.',
            'redirect' => route('login')
        ]);
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
