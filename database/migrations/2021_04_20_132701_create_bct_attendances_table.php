<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBctAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bct_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('roll_number');
            $table->string('subject_code'); //foreign from bct_subjects_table
            $table->smallInteger('batch');
            $table->string('teacher_code');
            $table->smallInteger('day');
            $table->string('attendance');
            $table->timestamps();

            $table->foreign('roll_number')->references('roll_number')->on('bct_students');
            $table->foreign('subject_code')->references('subject_code')->on('bct_subjects');
            $table->foreign('teacher_code')->references('teacher_code')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bct_attendances');
    }
}
