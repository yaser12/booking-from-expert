<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStartOfSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('start_of_slots', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string("current_working_hours_start_am_or_pm");
            $table->smallInteger("current_working_hours_start")->unsigned();
            $table->string("current_working_hours_in_minutes_start");
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_available')->default(false);
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
        Schema::dropIfExists('start_of_slots');
    }
}
