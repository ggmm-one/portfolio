<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\ResourceOwner;

class CreateResourceOwnersTable extends Migration
{
    public function up()
    {
        Schema::create('resource_owners', function (Blueprint $table) {
            $table->modelHeader();
            $table->string('name', ResourceOwner::DD_NAME_LENGTH);
            $table->string('email', ResourceOwner::DD_EMAIL_LENGTH);
            $table->modelFooter();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resource_owners');
    }
}
