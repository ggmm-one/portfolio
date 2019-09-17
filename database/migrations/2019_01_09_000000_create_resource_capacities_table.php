<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceCapacitiesTable extends Migration
{
    public function up()
    {
        Schema::create('resource_capacities', function (Blueprint $table) {
            $table->modelHeader();
            $table->bigInteger('resource_id');
            $table->date('start');
            $table->date('end');
            $table->char('type', 1);
            $table->bigInteger('quantity')->default(0);
            $table->modelFooter();
            $table->index('resource_id', 'ix_resource_capacities_resource_id');
            $table->foreign('resource_id', 'fk_resource_capacities_resource_id')->references('id')->on('resources');
        });
    }

    public function down()
    {
        Schema::dropIfExists('resource_capacities');
    }
}
