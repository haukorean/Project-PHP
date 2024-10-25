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
       Schema::create('datachatbot', function (Blueprint $table) {

                $table->id();
                $table->string('TrieuChung');
                $table->string('ChuanDoan');
                $table->string('ChuyenKhoa');
                $table->string('LoiKhuyen');
                $table->string('ID_Doctor');
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
         Schema::dropIfExists('datachatbot');
    }
};
