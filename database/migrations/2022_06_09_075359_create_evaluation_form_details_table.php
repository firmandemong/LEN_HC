<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationFormDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_form_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->references('id')->on('evaluation_forms')->cascadeOnDelete();
            $table->foreignId('subject_id')->references('id')->on('evaluation_subjects');
            $table->integer('point');
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
        Schema::dropIfExists('evaluation_form_details');
    }
}
