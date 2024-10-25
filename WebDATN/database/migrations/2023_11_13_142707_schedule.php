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
        Schema::create('schedule', function (Blueprint $table) {

                $table->id();
                $table->string('code');
                $table->unsignedBigInteger('id_doctor');
                $table->unsignedBigInteger('id_user');
                $table->string('time');
                $table->string('date');
                $table->string('reason');
                $table->string('note')->nullable();;
                $table->string('insurance')->nullable();
                $table->string('payment');
                $table->string('type');
                $table->unsignedBigInteger('service')->nullable();
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
     Schema::dropIfExists('schedule');
    }
};
