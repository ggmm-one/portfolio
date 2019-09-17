<?php

use App\ResourceType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceTypesTable extends Migration
{
    public function up()
    {
        Schema::create('resource_types', function (Blueprint $table) {
            $table->modelHeader();
            $table->char('category', 1);
            $table->string('name', ResourceType::DD_NAME_LENGTH);
            $table->modelFooter();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resource_types');
    }
}
