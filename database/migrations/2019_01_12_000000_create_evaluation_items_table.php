<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\EvaluationItem;

class CreateEvaluationItemsTable extends Migration
{
    public function up()
    {
        Schema::create('evaluation_items', function (Blueprint $table) {
            $table->modelHeader();
            $table->string('name', EvaluationItem::DD_NAME_LENGTH);
            $table->string('instructions', EvaluationItem::DD_INSTRUCTIONS_LENGTH)->nullable();
            $table->integer('weight')->default(10);
            $table->decimal('weight_factor', 5, 4);
            $table->integer('sort_order')->default(0);
            $table->modelFooter();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluation_items');
    }
}
