<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('participant_code')->nullable();
            $table->string('name');
            $table->string('school_type');
            $table->string('school_name');
            $table->string('major');
            $table->string('email');
            $table->string('file_application_letter');
            $table->string('file_cv');
            $table->string('file_transcript');
            $table->foreignId('division_id')->nullable();
            $table->foreignId('mentor_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->boolean('status')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('division_id')->references('id')->on('divisions')->nullOnDelete();
            $table->foreign('mentor_id')->references('id')->on('mentors')->nullOnDelete();
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
        Schema::dropIfExists('participants');
    }
}
