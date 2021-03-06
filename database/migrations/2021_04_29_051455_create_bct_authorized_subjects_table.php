<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBctAuthorizedSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bct_authorized_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_code');
            $table->string('subject_code');
            $table->string('batch');

            $table->foreign('teacher_code')->references('teacher_code')->on('users');
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
        Schema::dropIfExists('bct_authorized_subjects');
    }
}
