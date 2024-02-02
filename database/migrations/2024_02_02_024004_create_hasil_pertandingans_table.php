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
        Schema::create('hasil_pertandingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('klub_tuan_rumah_id')->constrained('klubs');
            $table->foreignId('klub_tamu_id')->constrained('klubs');
            $table->integer('skor_tuan_rumah');
            $table->integer('skor_tamu');
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
        Schema::dropIfExists('hasil_pertandingans');
    }
};
