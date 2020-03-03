<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hospital_id')->index();
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospital_user');
    }
}
