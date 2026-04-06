<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserAdminController extends Controller
{
    //
    public function index()
    {
        // 

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        // 
        $generatedPassword = Str::random(12);
        return view('admin.users.create', compact('generatedPassword'));
    }
    public function store(Request $request)
    {
        // 

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:12',
        ]);

        $data = clearData($data);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'is_blocked' => false,
        ]);

        if (!$user) {
            alert(__('admin.errors.error'), 'danger');
            return back();
        }

        alert(__('admin.success.create'));
        return redirect()->route('admin.users.index');
    }
    public function edit($id)
    {
        // 
        $user = User::find($id);
        if (!$user) {
            alert(__('admin.errors.no-data'), 'danger');
            return back();
        }
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // 
        $user = User::find($id);
        if (!$user) {
            alert(__('admin.errors.no-data'), 'danger');
            return back();
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'max:255', Rule::unique('users', 'email')->ignore($id)],
        ]);


        $data = clearData($data);

        $res = $user->update($data);

        if ($res) {
            alert(__('admin.success.updated'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }

    public function toggleBlock(User $user)
    {
        $user->update(['is_blocked' => !$user->is_blocked]);

        $status = $user->is_blocked ? 'Blocked' : 'Unblocked';

        alert("User: {$user->name} {$status}");

        return back();
    }
}