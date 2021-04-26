<?php

/*
 * This file is part of the overtrue/laravel-follow.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained()->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('following_id')->constrained("users")->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists("followers");
    }
}
