<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokter')->nullable();
            $table->string('npa')->nullable();
            $table->string('nama_dokter')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('praktek1')->nullable();
            $table->string('praktek2')->nullable();
            $table->string('praktek3')->nullable();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('dokter');
    }
}