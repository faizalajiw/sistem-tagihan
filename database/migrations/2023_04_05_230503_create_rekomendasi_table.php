<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekomendasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekomendasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokter_rekomendasi')->nullable();
            $table->string('alamat_rekomendasi')->nullable();
            $table->string('ttl')->nullable();
            $table->string('no_str')->nullable();
            $table->string('alamat_praktik_dimiliki')->nullable();
            $table->string('alamat_praktik_diminta')->nullable();
            $table->string('idi_cabang')->nullable();
            $table->string('no_rekomendasi')->nullable();
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
        Schema::dropIfExists('rekomendasi');
    }
}
