<?php

namespace App\Services\Admin;

use App\Models\Blocking;

class BlockingAdmin
{
    public function isBlocked($request)
    {

        $user = Blocking::query()
            ->where('ip', '=', $request->ip())
            ->first();


        if ($user && $user->blocking) {

            return true;
        }

        return false;
    }


    public function createOrUpdateBlockedUser($request)
    {
        $user = Blocking::query()
            ->where('ip', '=', $request->ip())
            ->first();

        if (!$user) {
            $user = Blocking::query()->create([

                'ip' => $request->ip(),
                'count' => 1,
                'blocking' => false,
            ]);
        } else {

            $user->increment('count');

            if ($user->count >= config('app.admin_blocking_count')) {

                $user->update(['blocking' => true]);
            }
        }
    }
}