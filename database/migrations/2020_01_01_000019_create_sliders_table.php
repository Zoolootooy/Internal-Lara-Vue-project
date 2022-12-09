<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('image');
            $table->text('description')->nullable()->default(null);
            $table->string('video_url')->nullable()->default(null);
            $table->string('forward_url')->nullable()->default(null);
            //$table->boolean('type')->default(false);
            $table->unsignedTinyInteger('type')->default(0);
            $table->boolean('visible')->default(true);
            $table->unsignedTinyInteger('position')->default(0);
            $table->string('button_caption', 100)->nullable()->default(null);
            $table->unsignedInteger('sorting')->nullable()->default(null);
            //$table->unsignedBigInteger('theme_id')->nullable()->default(2); //'theme_id' => $this->integer()->defaultValue(2),
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->timestamps();

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
        Schema::dropIfExists('sliders', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });
    }
}
