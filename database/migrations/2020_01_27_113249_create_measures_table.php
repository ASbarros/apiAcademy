<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idUser')->nullable(false)->unique();
            $table->double('leftArm', 8, 2)->nullable(false);
            $table->double('leftForearm', 8, 2)->nullable(false);
            $table->double('rightArm', 8, 2)->nullable(false);
            $table->double('rightForearm', 8, 2)->nullable(false);
            $table->double('contractedRightArm', 8, 2)->nullable(false);
            $table->double('contractedLeftArm', 8, 2)->nullable(false);
            $table->double('leftThigh', 8, 2)->nullable(false);
            $table->double('rightThigh', 8, 2)->nullable(false);
            $table->double('leftCalf', 8, 2)->nullable(false);
            $table->double('rightCalf', 8, 2)->nullable(false);
            $table->double('chest', 8, 2)->nullable(false);
            $table->double('waist', 8, 2)->nullable(false);
            $table->double('abdomen', 8, 2)->nullable(false);
            $table->double('hip', 8, 2)->nullable(false);
            $table->double('abdominal', 8, 2)->nullable(false);
            $table->double('supraIliac', 8, 2)->nullable(false);
            $table->double('triceps', 8, 2)->nullable(false);
            $table->double('subScapula', 8, 2)->nullable(false);
            $table->double('biceps', 8, 2)->nullable(false);
            $table->double('breastplate', 8, 2)->nullable(false);
            $table->double('auxiliaryMedia', 8, 2)->nullable(false);
            $table->double('thigh', 8, 2)->nullable(false);
            $table->double('calf', 8, 2)->nullable(false);
            $table->double('weight', 8, 2)->nullable(false);
            $table->double('height', 8, 2)->nullable(false);
            $table->double('currentIMC', 8, 2)->nullable(false);
            $table->double('currentFat', 8, 2)->nullable(false);
            $table->double('RCQ', 8, 2)->nullable(false);
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users');
        });
        DB::unprepared("CREATE TRIGGER `measures_AFTER_INSERT` AFTER INSERT ON `measures` FOR EACH ROW BEGIN insert into measures_log(id, idUser, leftArm, rightArm, leftForearm, rightForearm, contractedRightArm, contractedLeftArm, leftThigh, rightThigh, leftCalf, rightCalf, chest, waist, abdomen, hip, abdominal, supraIliac, triceps, subScapula, biceps, breastplate, auxiliaryMedia, thigh, calf, weight, height, currentIMC, currentFat, RCQ, operation, date) values (new.id, new.idUser, new.leftArm, new.rightArm, new.leftForearm, new.rightForearm, new.contractedRightArm, new.contractedLeftArm, new.leftThigh, new.rightThigh, new.leftCalf, new.rightCalf, new.chest, new.waist, new.abdomen, new.hip, new.abdominal, new.supraIliac, new.triceps, new.subScapula, new.biceps, new.breastplate, new.auxiliaryMedia, new.thigh, new.calf, new.weight, new.height, new.currentIMC, new.currentFat, new.RCQ, 'INSERT', now());END");
        DB::unprepared("CREATE TRIGGER `measures_AFTER_UPDATE` AFTER UPDATE ON `measures` FOR EACH ROW BEGIN insert into measures_log(id, idUser, leftArm, rightArm, leftForearm, rightForearm, contractedRightArm, contractedLeftArm, leftThigh, rightThigh, leftCalf, rightCalf, chest, waist, abdomen, hip, abdominal, supraIliac, triceps, subScapula, biceps, breastplate, auxiliaryMedia, thigh, calf, weight, height, currentIMC, currentFat, RCQ, operation, date) values (new.id, new.idUser, new.leftArm, new.rightArm, new.leftForearm, new.rightForearm, new.contractedRightArm, new.contractedLeftArm, new.leftThigh, new.rightThigh, new.leftCalf, new.rightCalf, new.chest, new.waist, new.abdomen, new.hip, new.abdominal, new.supraIliac, new.triceps, new.subScapula, new.biceps, new.breastplate, new.auxiliaryMedia, new.thigh, new.calf, new.weight, new.height, new.currentIMC, new.currentFat, new.RCQ, 'UPDATE', now());END ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `measures_AFTER_INSERT`');
        DB::unprepared('DROP TRIGGER `measures_AFTER_UPDATE`');
        Schema::dropIfExists('measures');
    }
}
