<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMergedRelations\Facades\Schema;

class CreateFriendsView extends Migration
{

    public function up()
    {
        Schema::createMergeView(
            'friends_view',
            [(new \App\Models\User())->acceptedFriendsTo(), (new \App\Models\User())->acceptedFriendsFrom()]
        );
    }

    public function down()
    {
        Schema::dropView('friend_view');
    }
}
