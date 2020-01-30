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
            $table->char('cpf', 11)->unique()->nullable(false);
            $table->string('name', 80);
            $table->string('email', 60)->unique()->nullable(false);
            $table->tinyInteger('active')->default(0);
            $table->string('pswd')->nullable(false);
            $table->char('changePswd', 1)->default('S');
            $table->unsignedBigInteger('idAcademy')->nullable(false);
            $table->timestamps();

            $table->foreign('idAcademy')->references('id')->on('academys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
