<?php

use App\Link;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->modelHeader();
            $table->bigInteger('linkable_id');
            $table->char('linkable_type', 3);
            $table->char('linkable_subtype', 1);
            $table->smallInteger('sort_order')->default(0);
            $table->string('title', Link::DD_TITLE_LENGTH);
            $table->string('url', Link::DD_URL_LENGTH);
            $table->modelFooter();
            $table->index('linkable_id', 'ix_links_linkable_id');
            $table->index('linkable_type', 'ix_links_linkable_type');
            $table->index('linkable_subtype', 'ix_links_linkable_subtype');
        });
    }

    public function down()
    {
        Schema::dropIfExists('links');
    }
}
