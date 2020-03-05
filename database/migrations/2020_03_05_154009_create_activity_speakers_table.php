<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitySpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_speakers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type'); // 1=> locale  2=> international
            $table->string('name');
            $table->string('speaker_type');// 1=> Expert Speaker , 2=> Raising Start
            $table->string('speciality');
            $table->unsignedBigInteger('activity_id')->index();
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
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
        Schema::dropIfExists('activity_speakers');
    }
}
