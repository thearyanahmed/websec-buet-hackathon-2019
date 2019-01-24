<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('title');
            $table->text('content');
            $table->boolean('status')
                    ->default(0)
                    ->comment('0 Referes to `the post is not apporoved`,1 Referes to `the post is approved`');
            $table->integer('last_modified_by')
                ->references('id')
                ->on('users')
                ->nullable()
                ->comment('Points to the admin/moderator user,Note:only points to the last modified user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
