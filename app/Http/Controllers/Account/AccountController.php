<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //

    public function index()
    {
        // 

        return view('account.index', ['title' => 'Account', 'page' => 'account']);
    }

    public function update(Request $request)
    {


        if (!$request->has('action')) {
            return response()->json([
                'message' => 'The action field is required.'
            ], 422);
        }

        $user = $request->user();


        $action = $request->input('action');


        if ($action == 'change-name') {

            $credentials = $request->validate([
                'name' => 'required|string',
            ]);

            $data = clearData($credentials);

            $user->update($data);

            return response()->json([
                'success' => true,
                'name' => $user->name,
                'message' => 'Name updated successfully',
            ]);
        }

        if ($action == 'change-password') {
            $credentials = $request->validate([
                'password' => 'required|min:12',
            ]);

            $data = clearData($credentials);

            $user->update($data);

            return response()->json([
                'success' => true,
                'name' => $user->name,
                'message' => 'Password updated successfully',
            ]);
        }




        return response()->json([
            'errors' => ['action' => ['Invalid value.']],
        ], 422);
    }
}