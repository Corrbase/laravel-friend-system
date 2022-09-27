<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

//    public function __invoke(User $user, Request $request)
//    {
//        $request->user()->pendingFriendsTo()->attach($user);
//        return back();
//    }

    public function friend(Request $request, User $user)
    {
        $request->user()->pendingFriendsTo()->attach($user);

        return back();
    }
}