<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->modelHeader();
            $table->integer('evaluation_max');
            $table->modelFooter();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
