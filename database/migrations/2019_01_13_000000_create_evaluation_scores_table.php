<?php

use App\EvaluationScore;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationScoresTable extends Migration
{
    public function up()
    {
        Schema::create('evaluation_scores', function (Blueprint $table) {
            $table->modelHeader();
            $table->bigInteger('project_id');
            $table->bigInteger('evaluation_item_id');
            $table->integer('score')->nullable();
            $table->decimal('weighted_score', 5, 4);
            $table->string('description', EvaluationScore::DD_DESCRIPTION_LENGTH);
            $table->modelFooter();
            $table->index('project_id', 'ix_evaluation_scores_project_id');
            $table->foreign('project_id', 'fk_evaluation_scores_project_id')->references('id')->on('projects');
            $table->index('evaluation_item_id', 'ix_evaluation_scores_evaluation_item_id');
            $table->foreign('evaluation_item_id', 'fk_evaluation_scores_evaluation_item_id')->references('id')->on('evaluation_items');
            $table->unique(['project_id', 'evaluation_item_id'], 'ux_evaluation_scores_project_id_evaluation_item_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluation_scores');
    }
}
