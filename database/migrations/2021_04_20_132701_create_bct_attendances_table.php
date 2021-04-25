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
            $table->unsignedBigInteger('bct_subject_id'); //foreign from bct_subjects_table
            $table->smallInteger('batch');
            $table->string('teacher_name');
            $table->smallInteger('day');
            $table->timestamps();

        $table->foreign('bct_subject_id')->references('id')->on('bct_subjects');
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
