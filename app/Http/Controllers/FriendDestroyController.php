<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;

class FriendDestroyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request)
    {
        $user = $request->user_id;
        if ($request->user()->friendsTo()->detach($user))
        {
            return back();
        }

        $request->user()->friendsFrom()->detach($user);

        return back();
    }
}
