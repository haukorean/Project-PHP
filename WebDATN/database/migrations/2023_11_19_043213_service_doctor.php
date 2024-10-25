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
        Schema::create('service_doctor', function (Blueprint $table) {

                $table->id();
                $table->unsignedBigInteger('id_service');
                $table->unsignedBigInteger('id_company');
                $table->string('name');
                $table->string('image')->nullable();
                $table->string('describe');
                $table->string('price');
                $table->timestamps();
                
            });
    }

    /**
     * Reverse the migrations.
     *s
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('service_doctor');
    }
};
