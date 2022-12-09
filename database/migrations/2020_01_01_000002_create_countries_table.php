<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 45);
            $table->unsignedInteger('phone_code');
            $table->unsignedInteger('vat_rate')->nullable();
            $table->timestamps();

            //$table->foreign('fk_user_country', '{{%user}}', 'country_id', '{{%country}}', 'id', 'SET NULL', 'CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
