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
      Schema::create('infor_patient', function (Blueprint $table) {
                $table->id();

                // $table->unsignedBigInteger('id_user');
                $table->unsignedBigInteger('id_user');
                // $table->foreignId('id_user')->constrained('users')->cascadeOnUpdate();
                $table->string('firt_name');
                $table->string('last_name');
                $table->string('number_phone');
                $table->string('avt_user');
                $table->string('address');
                $table->string('details_address');
                $table->string('birth_day');
                $table->string('sex');
                $table->string('age');
                $table->string('height');
                $table->string('weight');
                $table->string('blood_group');
                $table->string('about_me')->nullable();;
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
         Schema::dropIfExists('infor_patient');
    }
};
