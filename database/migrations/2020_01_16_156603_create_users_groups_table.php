<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('idGroups')->nullable(false);
            $table->unsignedBigInteger('idUsers')->nullable(false);
            $table->string('pswdUsers')->nullable(false);
            $table->timestamps();

           $table->foreign('idGroups')->references('id')->on('groups');
           $table->foreign('idUsers')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_groups');
    }
}
