<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('reply_to')->nullable();
            $table->text('message');
            $table->timestamps();

            $table->index('post_id', 'comments_post_idx');
            $table->index('user_id', 'comments_user_idx');
            $table->index('reply_to', 'comments_reply_to_idx');

            $table->foreign('post_id', 'comments_post_fk')->on('posts')->references('id');
            $table->foreign('user_id', 'comments_user_fk')->on('users')->references('id');
            $table->foreign('reply_to', 'comments_reply_to_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
