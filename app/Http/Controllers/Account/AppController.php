<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use Illuminate\Http\Request;

class AppController extends Controller
{
    //

    public function index()
    {

        // $widget = Widget::with(['template.translations', 'clientTranslations'])->find(2);
        // dd($widget);


        // 
        $user = auth('web')->user();
        // dd($user->sites()->whereNot('is_blocked', true)->get());

        // $sites = $user->sites()->whereNot('is_blocked', true)->get();
        // $sites = $user->sites()->whereNot('is_blocked', true)->with('widgets')->get();
        // $sites = $user->sites()->whereNot('is_blocked', true)->with('widgets.template')->get();
        $sites = $user->sites()->whereNot('is_blocked', true)->with('widgets.template.widgetType')->get();

        // dd($sites);

        return response()
            ->view('account.apps.index', [
                'title' => 'My Apps',
                'page' => 'apps',
                'sites' => $sites,
            ])
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }
    //     return view('account.apps.index', [
    //         'title' => 'My Apps',
    //         'page' => 'apps',
    //         'sites' => $sites,
    //     ]);
    // }
}