<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDatatimeToStringRestToCardEquipament extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card_equipaments', function (Blueprint $table) {
            $table->string('rest', 45)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card_equipaments', function (Blueprint $table) {
            $table->dateTime('rest')->nullable(false)->change();
        });
    }
}
