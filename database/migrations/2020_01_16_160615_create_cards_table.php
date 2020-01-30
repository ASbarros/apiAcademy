<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('nextReview');
            $table->date('startDate')->nullable(false);
            $table->unsignedBigInteger('idHeating')->nullable(false);
            $table->unsignedBigInteger('idGoal')->nullable(false);
            $table->unsignedBigInteger('idUser')->nullable(false);
            $table->integer('frequency');
            $table->timestamps();

            $table->foreign('idHeating')->references('id')->on('heatings');
            $table->foreign('idGoal')->references('id')->on('goals');
            $table->foreign('idUser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
