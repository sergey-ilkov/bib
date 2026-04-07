<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppController extends Controller
{
    //

    public function index()
    {
        // 
        $user = auth('web')->user();
        // dd($user->sites()->whereNot('is_blocked', true)->get());

        $sites = $user->sites()->whereNot('is_blocked', true)->get();

        return view('account.apps.index', [
            'title' => 'My Apps',
            'page' => 'app',
            'sites' => $sites,
        ]);
    }
}
