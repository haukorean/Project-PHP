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
        Schema::create('handbook', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('id_doctor');
                    $table->string('title');
                    $table->longText('content');
                    $table->string('image');
                    $table->string('status');
                    $table->string('date');
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
           Schema::dropIfExists('handbook');
    }
};
