<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_referrals', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('from_hospital')->index();
            $table->foreign('from_hospital')->references('id')->on('hospitals')->onDelete('cascade');
            $table->unsignedBigInteger('to_hospital')->index();
            $table->foreign('to_hospital')->references('id')->on('hospitals')->onDelete('cascade');

            $table->unsignedBigInteger('from_doctor');
            $table->foreign('from_doctor')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('to_doctor');
            $table->foreign('to_doctor')->references('id')->on('doctors')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('patient_id')->index();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
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
        Schema::dropIfExists('patient_referrals');
    }
}
