<?php

use App\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->modelHeader();
            $table->bigInteger('portfolio_id');
            $table->char('type', 1);
            $table->char('status', 1);
            $table->decimal('score', 5, 3);
            $table->string('name', Project::DD_NAME_LENGTH);
            $table->string('code', Project::DD_CODE_LENGTH)->nullable();
            $table->date('start');
            $table->date('end');
            $table->string('description', Project::DD_DESCRIPTION_LENGTH)->nullable();
            $table->date('start_after')->nullable();
            $table->date('end_before')->nullable();
            $table->modelFooter();
            $table->index('portfolio_id', 'ix_projects_portfolio_id');
            $table->foreign('portfolio_id', 'fk_projects_portfolio_id')->references('id')->on('portfolios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
