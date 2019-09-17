<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\PortfolioUnit;

class CreatePortfolioUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('portfolio_units', function (Blueprint $table) {
            $table->modelHeader();
            $table->bigInteger('parent_id')->nullable();
            $table->char('type', 1);
            $table->string('name', PortfolioUnit::DD_NAME_LENGTH);
            $table->smallInteger('hierarchy_order')->default(0);
            $table->smallInteger('hierarchy_level')->default(0);
            $table->string('description', PortfolioUnit::DD_DESCRIPTION_LENGTH)->nullable();
            $table->modelFooter();
            $table->foreign('parent_id', 'fk_pun_parent_id')->references('id')->on('portfolio_units');
        });
    }

    public function down()
    {
        Schema::dropIfExists('portfolio_units');
    }
}
