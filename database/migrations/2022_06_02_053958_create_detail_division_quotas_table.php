<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailDivisionQuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_division_quotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->references('id')->on('divisions')->cascadeOnDelete();
            $table->foreignId('major_id')->references('id')->on('majors')->cascadeOnDelete();
            $table->tinyInteger('quota');
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
        Schema::dropIfExists('detail_division_quotas');
    }
}
