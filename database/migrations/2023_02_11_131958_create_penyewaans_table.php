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
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id('id_sewa');
            $table->unsignedBigInteger('id_penyewa');
            $table->foreign('id_penyewa')->references('id')->on('users');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('no_invoice', 25)->unique();
            $table->dateTime('tgl_sewa');
            $table->dateTime('tgl_kembali');
            $table->integer('durasi');
            $table->integer('total');
            $table->integer('pajak');
            $table->integer('dibayar')->nullable();
            $table->unsignedBigInteger('id_status_sewa');
            $table->foreign('id_status_sewa')->references('id_status_sewa')->on('status_sewa');
            $table->unsignedBigInteger('id_jaminan')->nullable();
            $table->foreign('id_jaminan')->references('id_jaminan')->on('jaminan');
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
        Schema::dropIfExists('penyewaan');
    }
};
