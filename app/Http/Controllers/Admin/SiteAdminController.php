<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiteAdminController extends Controller
{

    // Список всех сайтов
    public function index()
    {

        $perPage = 20;

        // $sites = Site::with('user')->orderBy('user_id')->orderBy('id')->get();
        $sites = Site::with('user')->orderBy('user_id')->orderBy('id')->paginate($perPage);
        // $sites = Site::with('user')->orderBy('user_id')->orderBy('id')->cursorPaginate($perPage);

        // dd($sites);

        return view('admin.sites.index', compact('sites'));
    }

    // список пользователей с кол. сайтов и ссылками для создания сайтов для пользователя
    public function indexUsersSites()
    {
        // 

        $users = User::withCount('sites')->get();

        return view('admin.sites.index-users-sites', compact('users'));
    }


    public function create(User $user)
    {
        // 

        return view('admin.sites.create', compact('user'));
    }


    public function store(Request $request, Site $site)
    {
        // 
        $data = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'name'       => 'required|string|max:255',
            'domen'   => 'required|string|unique:sites,domen',
            'upload_url' => 'required|url',
        ]);

        $data = clearData($data);

        $data['device_script'] = $request->has('device_script');
        $data['is_blocked'] = false;




        $site = Site::create($data);

        if (!$site) {
            alert(__('admin.errors.error'), 'danger');
            return back();
        }
        alert(__('admin.success.create'));
        return back();
    }

    public function edit(Site $site)
    {

        return view('admin.sites.edit', compact('site'));
    }


    public function update(Request $request, Site $site)
    {


        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'domen'   => ['required', 'string', Rule::unique('sites', 'domen')->ignore($site->id)],
            'upload_url' => 'required|url',
        ]);

        $data = clearData($data);

        $data['device_script'] = $request->has('device_script');


        $res = $site->update($data);
        if ($res) {
            alert(__('admin.success.updated'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }


    public function toggleBlock(Site $site)
    {
        $site->update(['is_blocked' => !$site->is_blocked]);
        $status = $site->is_blocked ? 'Blocked' : 'Unblocked';

        alert("Site: {$site->name} {$status}");

        return back();
    }
}