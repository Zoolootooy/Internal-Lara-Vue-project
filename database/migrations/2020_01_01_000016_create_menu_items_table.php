<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_id');
            //$table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->unsignedBigInteger('page_id')->nullable()->default(null);
            $table->unsignedTinyInteger('type')->default(0);
            $table->string('link_name', 100)->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->boolean('inherited')->default(true);
            $table->unsignedInteger('sorting')->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->timestamps();

            NestedSet::columns($table);

            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('CASCADE');
            //$table->foreign('parent_id')->references('id')->on('menu_items')->onDelete('CASCADE');
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
        Schema::dropIfExists('menu_items', function (Blueprint $table) {
            $table->dropForeign(['menu_id', 'page_id', 'created_by']); // parent_id
        });
    }
}
