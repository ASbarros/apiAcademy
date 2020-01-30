<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCardEquipamentsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_equipaments_log', function (Blueprint $table) {
            $table->integer('idcard')->nullable(false);
            $table->integer('idequipaments')->nullable(false);
            $table->dateTime('rest');
            $table->dateTime('date');
            $table->integer('weight');
            $table->integer('series');
            $table->integer('repetition');
            $table->char('side', 1)->default('A');
            $table->string('operation');
            $table->timestamps();
        });
        DB::unprepared("CREATE TRIGGER `card_equipaments_AFTER_INSERT` AFTER INSERT ON `card_equipaments` FOR EACH ROW BEGIN insert into card_equipaments_log(idCard, idEquipaments, rest, weight, series, repetition, side, date, operation) values (new.idCard, new.idEquipaments, new.rest, new.weight, new.series, new.repetition, new.side, now(), 'INSERT');END");
        DB::unprepared("CREATE TRIGGER `card_equipaments_AFTER_UPDATE` AFTER UPDATE ON `card_equipaments` FOR EACH ROW BEGIN insert into card_equipaments_log(idCard, idEquipaments, rest, weight, series, repetition, side, date, operation) values (new.idCard, new.idEquipaments, new.rest, new.weight, new.series, new.repetition, new.side, now(), 'UPDATE');END ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_equipaments_log');
    }
}
