<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table)
        {

            $table->bigIncrements('id');
            $table->date('appointment_date');
            $table->smallInteger('year');
            $table->smallInteger('day');
            $table->smallInteger('month');

            $table->unsignedBigInteger('start_of_slot_id');
            $table->foreign('start_of_slot_id')->references('id')->on('start_of_slots');

            $table->unsignedBigInteger('expert_id');
            $table->foreign('expert_id')->references('id')->on('users');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('appointments');
    }
}
