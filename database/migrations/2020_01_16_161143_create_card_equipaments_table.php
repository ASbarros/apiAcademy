<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardEquipamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_equipaments', function (Blueprint $table) {
            $table->unsignedBigInteger('idCard')->nullable(false);
            $table->unsignedBigInteger('idEquipaments')->nullable(false);
            $table->dateTime('rest');
            $table->integer('weight');
            $table->integer('series');
            $table->integer('repetition');
            $table->char('side', 1)->default('A');
            $table->timestamps();

            $table->foreign('idCard')->references('id')->on('cards');
            $table->foreign('idEquipaments')->references('id')->on('equipaments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_equipaments');
    }
}
