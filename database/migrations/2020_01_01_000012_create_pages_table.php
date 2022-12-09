<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->string('link_name', 100); // name // ??
            $table->string('slug', 100)->unique();
            $table->string('image')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);
            $table->string('title', 100)->nullable()->default(null);
            $table->string('meta_keywords')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->string('header', 100)->nullable()->default(null);
            $table->unsignedInteger('sorting')->nullable()->default(null); // ???
            $table->unsignedTinyInteger('visible')->default(1);
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('page_categories')->onDelete('SET NULL');
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
        Schema::dropIfExists('pages', function (Blueprint $table) {
            $table->dropForeign(['parent_id', 'created_by']);
        });
    }
}
