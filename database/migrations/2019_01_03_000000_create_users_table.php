<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->modelHeader();
            $table->string('name', User::DD_NAME_LENGTH);
            $table->string('email', User::DD_EMAIL_LENGTH);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 56);
            $table->bigInteger('role_id');
            $table->rememberToken();
            $table->modelFooter();
            $table->unique('email', 'ux_users_email');
            $table->index('role_id', 'ix_users_role_id');
            $table->foreign('role_id', 'fk_users_role_id')->references('id')->on('roles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
