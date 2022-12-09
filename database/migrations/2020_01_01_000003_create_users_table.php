<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique(); // username // ???
            $table->string('email')->unique();
            $table->string('password');

            $table->string('first_name', 100)->nullable()->default(null);
            $table->string('last_name', 100)->nullable()->default(null);
            $table->unsignedBigInteger('country_id')->nullable()->default(null);
            $table->string('zip', 10)->nullable()->default(null);
            $table->string('city', 100)->nullable()->default(null);
            $table->string('address', 100)->nullable()->default(null);
            $table->string('phone', 50)->nullable()->default(null);
            $table->string('avatar')->nullable()->default(null);
            $table->timestamp('birthday')->nullable()->default(null);
            $table->boolean('gender')->nullable()->default(null);
            //$table->unsignedTinyInteger('active')->default(1);
            $table->tinyInteger('status')->default(0);
            $table->timestamp('last_login_at')->nullable()->default(null);

            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
    }
}
