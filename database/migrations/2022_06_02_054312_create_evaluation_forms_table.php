<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id');
            $table->double('average')->nullable();
            $table->string('predicate')->nullable();
            $table->foreignId('evaluator_id')->nullable();
            $table->datetime('evaluate_date');
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->foreign('evaluator_id')->references('id')->on('mentors')->onDelete('set null');
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
        Schema::dropIfExists('evaluation_forms');
    }
}
