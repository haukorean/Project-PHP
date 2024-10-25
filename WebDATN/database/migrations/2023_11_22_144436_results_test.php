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
         Schema::create('results_test', function (Blueprint $table) {

                $table->id();
                $table->unsignedBigInteger('id_result');
                $table->string('name');
                $table->string('type');
                $table->string('file')->nullable();
                // $table->string('image')->nullable();
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
       Schema::dropIfExists('results_test');
    }
};
