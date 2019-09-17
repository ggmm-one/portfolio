<?php

use App\Resource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->modelHeader();
            $table->bigInteger('resource_owner_id');
            $table->bigInteger('resource_type_id');
            $table->string('name', Resource::DD_NAME_LENGTH);
            $table->string('description', Resource::DD_DESCRIPTION_LENGTH)->nullable();
            $table->modelFooter();
            $table->index('resource_owner_id', 'ix_resources_resource_owner_id');
            $table->foreign('resource_owner_id', 'fk_resources_resource_owner_id')->references('id')->on('resource_owners');
            $table->index('resource_type_id', 'ix_resources_resource_type_id');
            $table->foreign('resource_type_id', 'fk_resources_resource_type_id')->references('id')->on('resource_types');
        });
    }

    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
