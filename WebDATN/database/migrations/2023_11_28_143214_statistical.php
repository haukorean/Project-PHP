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
          Schema::create('statistical', function (Blueprint $table) {

                $table->id();
                $table->unsignedBigInteger('id_user')->nullable();
                $table->unsignedBigInteger('id_doctor')->nullable();
                $table->unsignedBigInteger('id_schedule')->nullable();
                $table->string('stype')->nullable();
                $table->string('key_stype')->nullable();
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
           Schema::dropIfExists('statistical');
    }
};
