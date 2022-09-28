<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendPatchController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request)
    {
        $user = $request->user_id;

        $request->user()->pendingFriendsFrom()->updateExistingPivot($user, [
            'accepted' => true
        ]);

        return back();
    }
}
