<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectOrderConstraintsTable extends Migration
{
    public function up()
    {
        Schema::create('project_order_constraints', function (Blueprint $table) {
            $table->modelHeader();
            $table->bigInteger('before_project_id');
            $table->bigInteger('after_project_id');
            $table->modelFooter();
            $table->index('before_project_id', 'ix_project_order_constraints_before_project_id');
            $table->foreign('before_project_id', 'fk_project_order_constraints_before_project_id')->references('id')->on('projects');
            $table->index('after_project_id', 'ix_project_order_constraints_after_project_id');
            $table->foreign('after_project_id', 'fk_project_order_constraints_after_project_id')->references('id')->on('projects');
            $table->unique(['before_project_id', 'after_project_id', 'deleted_at'], 'ux_project_order_constraints_before_project_id_after_project_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_order_constraints');
    }
}
