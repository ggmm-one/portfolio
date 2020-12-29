<?php

use App\Portfolio;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioTable extends Migration
{
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->modelHeader();
            $table->bigInteger('parent_id')->nullable();
            $table->string('name', Portfolio::DD_NAME_LENGTH);
            $table->smallInteger('hierarchy_order')->default(0);
            $table->smallInteger('hierarchy_level')->default(0);
            $table->string('description', Portfolio::DD_DESCRIPTION_LENGTH)->nullable();
            $table->modelFooter();
            $table->foreign('parent_id', 'fk_por_parent_id')->references('id')->on('portfolios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}
