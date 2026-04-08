<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageAdminRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageAdminController extends Controller
{
    public function index()
    {
        $languages = Language::all();

        return view('admin.languages.index', compact('languages'));
    }
    public function create()
    {

        return view('admin.languages.create');
    }
    public function store(LanguageAdminRequest $request)

    {





        $language = Language::create([
            'name' => $request->input('name'),
            'code' => substr($request->input('code'), 0, 2),

        ]);

        if ($language) {
            alert(__('admin.success.create'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }

    public function edit($id)
    {
        $language = Language::find($id);
        if (!$language) {
            alert(__('admin.errors.no-data'), 'danger');
            return back();
        }

        return view('admin.languages.edit', compact('language'));
    }
    public function update(LanguageAdminRequest $request, $id)
    {

        $language = Language::find($id);
        if (!$language) {
            alert(__('admin.errors.no-data'), 'danger');
            return back();
        }

        $res = $language->update([
            'name' => $request->input('name'),
            'code' => substr($request->input('code'), 0, 2),
        ]);

        if ($res) {
            alert(__('admin.success.updated'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }

    public function destroy($id)
    {

        $language = Language::find($id);

        if ($language && $language->delete()) {

            alert(__('admin.success.delete'));
        } else {
            alert(__('admin.errors.delete'), 'danger');
        }




        return back();
    }
}
