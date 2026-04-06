<?php

namespace App\Http\Controllers;

use App\Models\WidgetTemplate;
use App\Models\WidgetType;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function index()
    {
        // 
        return view('test.index');
    }

    public function getTestConfig()

    {


        // $widget_type = WidgetType::where('slug', 'bank-statement-checker')->first();
        // dd($widget_type, $widget_type->templates);
        $template = WidgetTemplate::where('slug', 'mexico-bank-statement')->first();

        // dd($template, $template->widgetType, $template->defaultLanguage, $template->translations, $template->widgets);

        return response()->json([
            'validation_rules' => $template->validation_rules,
            'period_rules' => $template->period_rules
        ]);
    }
}