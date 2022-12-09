<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnippetPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snippet_pages', function (Blueprint $table) {
            $table->bigIncrements('id'); // ???
            $table->unsignedBigInteger('snippet_id');
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->timestamps();

            $table->unique(['snippet_id', 'page_id']);

            $table->foreign('snippet_id')->references('id')->on('snippets')->onDelete('CASCADE');
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('CASCADE');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snippet_pages', function (Blueprint $table) {
            $table->dropForeign(['snippet_id', 'page_id', 'created_by']);
        });
    }
}
