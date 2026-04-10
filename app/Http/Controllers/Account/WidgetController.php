<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\Widget;
use App\Models\WidgetTemplate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WidgetController extends Controller
{
    //

    public function create($id)
    {
        $user = auth('web')->user();



        $site_user = $user->sites()
            ->where('id', $id)
            ->where('is_blocked', false)
            ->first();


        if (!$site_user) {
            return redirect()->route('apps');
        }


        $template = WidgetTemplate::with('translations')->first();

        $widget_user = $site_user->widgets()->where('widget_template_id', $template->id)->first();


        if ($widget_user) {
            return redirect()->route('apps');
        }


        $uuid = (string) Str::uuid();
        $data = [
            'site_id' => $site_user->id,
            'widget_template_id' => $template->id,
            'uid' => $uuid,
            'name' => $template->name,
            // 'settings' => 'array',
            // 'is_active' => 'boolean',
        ];

        $widget = Widget::create($data);

        if ($widget) {
            return redirect()->route('widget.edit', $uuid);
        }





        // dd('Error', $data);







        // Пока у нас один шаблон, берем его первым по дефолту
        // $template = WidgetTemplate::with('translations')->first();

        // return view('account.widgets.create', [
        //     'title' => 'Widget create',
        //     'page' => 'widget',
        //     'site' => $site_user,
        //     'template' => $template,
        // ]);
    }

    public function store(Request $request, Site $site)
    {
        //  
        return 'store';
    }

    public function edit($uuid)
    {

        $user = auth('web')->user();

        $widget = $user->widgets()->where('uid', $uuid)->first();
        if (!$widget) {
            return redirect()->route('apps');
        }


        return view('account.widgets.edit', [
            'title' => $widget->name,
            'page' => 'configurator',
            'widget' => $widget,

        ]);

        // dd($widget);

        // dd('Success Constructor', $uuid);
    }


    public function update(Request $request, $uuid)
    {

        $user = auth('web')->user();

        $widget = $user->widgets()->where('uid', $uuid)->first();
        if (!$widget) {
            return response()->json([
                'errors' => ['update' => ['Data update error.']],
            ], 422);
        }


        $action = $request->input('action');

        if ($action == 'widget-rename') {
            $credentials = $request->validate([
                'name' => 'required|string',
            ]);

            $data = clearData($credentials);

            $widget->update($data);

            return response()->json([
                'success' => true,
                'name' => $widget->name,
                'message' => 'Name updated successfully',
            ]);
        }



        return response()->json([
            'errors' => ['action' => ['Invalid value.']],
        ], 422);
    }


    public function destroy($uuid)
    {
        $user = auth('web')->user();

        $widget = $user->widgets()->where('uid', $uuid)->first();
        if (!$widget) {
            return response()->json([
                'errors' => ['delete' => ['Data delete error.']],
            ], 422);
        }


        if ($widget->delete()) {

            return response()->json([
                'success' => true,
                'message' => 'Widget successfully removed.',
            ]);
        }


        return response()->json([
            'errors' => ['delete' => ['Data delete error.']],
        ], 422);
    }
}