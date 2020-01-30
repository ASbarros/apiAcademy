<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasuresLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measures_log', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('idUser');
            $table->double('leftArm', 8, 2);
            $table->double('leftForearm', 8, 2);
            $table->double('rightArm', 8, 2);
            $table->double('rightForearm', 8, 2);
            $table->double('contractedRightArm', 8, 2);
            $table->double('contractedLeftArm', 8, 2);
            $table->double('leftThigh', 8, 2);
            $table->double('rightThigh', 8, 2);
            $table->double('leftCalf', 8, 2);
            $table->double('rightCalf', 8, 2);
            $table->double('chest', 8, 2);
            $table->double('waist', 8, 2);
            $table->double('abdomen', 8, 2);
            $table->double('hip', 8, 2);
            $table->double('abdominal', 8, 2);
            $table->double('supraIliac', 8, 2);
            $table->double('triceps', 8, 2);
            $table->double('subScapula', 8, 2);
            $table->double('biceps', 8, 2);
            $table->double('breastplate', 8, 2);
            $table->double('auxiliaryMedia', 8, 2);
            $table->double('thigh', 8, 2);
            $table->double('calf', 8, 2);
            $table->double('weight', 8, 2);
            $table->double('height', 8, 2);
            $table->double('currentIMC', 8, 2);
            $table->double('currentFat', 8, 2);
            $table->double('RCQ', 8, 2);
            $table->string('operation', 10);
            $table->date('date', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measures_log');
    }
}
