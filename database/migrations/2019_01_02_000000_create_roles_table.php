<?php

use App\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->modelHeader();
            $table->string('name', Role::DD_NAME_LENGTH);
            $table->char('permission_portfolios', 1);
            $table->char('permission_projects', 1);
            $table->char('permission_resources', 1);
            $table->char('permission_admin', 1);
            $table->modelFooter();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
