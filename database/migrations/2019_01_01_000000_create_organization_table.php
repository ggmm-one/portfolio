<?php

use App\Organization;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationTable extends Migration
{

    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('pid', 11);
            $table->string('name', Organization::DD_NAME_LENGTH);
            $table->timestamps();
            $table->unique('pid', 'ux_org_pid');
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
