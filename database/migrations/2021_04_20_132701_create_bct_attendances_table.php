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
            $table->string('subject_code'); //foreign from bct_subjects_table
            $table->smallInteger('batch');
            $table->string('teacher_code');
            $table->smallInteger('day');
            $table->boolean('present');
            $table->timestamps();

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
