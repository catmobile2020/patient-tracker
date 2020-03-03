<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->double('rheuma')->nullable();
            $table->double('crdio')->nullable();
            $table->double('pulmo')->nullable();
            $table->boolean('pah_expert')->nullable();
            $table->boolean('rhc')->nullable();
            $table->boolean('rwe')->nullable();
            $table->boolean('echo')->nullable();
            $table->boolean('pah_attentive')->nullable();
            $table->unsignedBigInteger('city_id')->index();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->unsignedBigInteger('country_id')->index();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

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
        Schema::dropIfExists('hospitals');
    }
}
