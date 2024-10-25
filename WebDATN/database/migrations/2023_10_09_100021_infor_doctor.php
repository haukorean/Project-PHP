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
        Schema::create('infor_doctor', function (Blueprint $table) {

                $table->id();
          
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
                $table->string('work_experience');
                $table->string('file_physician');
                $table->string('front_cccd');
                $table->string('backside_cccd');
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
        Schema::dropIfExists('infor_doctor');
    }
};
