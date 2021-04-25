<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBctAttendanceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bct_attendance_reports', function (Blueprint $table) {
            $table->id();
            $table->string('roll_number');
            $table->string('subject_code');
            $table->integer('present_days');
            $table->integer('total_days');

            $table->foreign('roll_number')->references('roll_number')->on('bct_students');
            $table->foreign('subject_code')->references('subject_code')->on('bct_subjects');
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
        Schema::dropIfExists('bct_attendance_reports');
    }
}
