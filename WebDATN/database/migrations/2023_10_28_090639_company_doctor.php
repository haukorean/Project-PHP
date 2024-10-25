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
         Schema::create('company_doctor', function (Blueprint $table) {

                $table->id();
                $table->unsignedBigInteger('id_user');
                $table->unsignedBigInteger('id_specialist');       
                $table->string('company_name');
                $table->string('company_phone');
                $table->string('company_email');
                $table->string('company_address');
                $table->longText('service');
                $table->string('price');
                $table->string('about_us');
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
       Schema::dropIfExists('company_doctor');
    }
};
