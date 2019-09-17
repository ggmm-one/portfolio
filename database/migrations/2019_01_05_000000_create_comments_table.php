<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Comment;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->modelHeader();
            $table->bigInteger('user_id');
            $table->bigInteger('commentable_id');
            $table->char('commentable_type', 3);
            $table->string('content', Comment::DD_CONTENT_LENGTH);
            $table->modelFooter();
            $table->index('user_id', 'ix_comments_user_id');
            $table->foreign('user_id', 'fk_comments_user_id')->references('id')->on('users');
            $table->index('commentable_id', 'ix_comments_commentable_id');
            $table->index('commentable_type', 'ix_comments_commentable_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
