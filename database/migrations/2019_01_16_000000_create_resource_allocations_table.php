<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceAllocationsTable extends Migration
{
    public function up()
    {
        Schema::create('resource_allocations', function (Blueprint $table) {
            $table->modelHeader();
            $table->bigInteger('project_id');
            $table->bigInteger('resource_id');
            $table->integer('month');
            $table->integer('quantity');
            $table->integer('sort_order');
            $table->modelFooter();
            $table->foreign('project_id', 'fk_resource_allocations_project_id')->references('id')->on('projects');
            $table->foreign('resource_id', 'fk_resource_allocations_resource_id')->references('id')->on('resources');
            $table->unique(['project_id', 'resource_id'], 'ux_resource_allocations_project_id_resource_id');
            $table->unique(['resource_id', 'month'], 'ux_resource_allocations_resource_id_month');
        });
    }

    public function down()
    {
        Schema::dropIfExists('resource_allocations');
    }
}
