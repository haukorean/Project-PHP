<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('results_examination', function (Blueprint $table) {

                $table->id();
                $table->unsignedBigInteger('id_schedule');
                $table->string('symptom_describe');
                $table->string('initial_diagnosis');
                $table->string('final_diagnosis')->nullable();
                $table->string('recommended_treatment');
                $table->string('prescription')->nullable();
                $table->string('advice');
                $table->unsignedBigInteger('re_examination_schedule')->nullable();
                $table->string('costs_incurred');
                $table->string('costs_totals');
                $table->string('date');
                $table->string('status');
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
         Schema::dropIfExists('results_examination');
    }
};
