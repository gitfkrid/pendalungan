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
        Schema::create('detail_riwayat_penyewaan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_riwayat_penyewaan');
            $table->foreign('id_riwayat_penyewaan')->references('id_riwayat_penyewaan')->on('riwayat_penyewaan');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id_barang')->on('barang');
            $table->integer('subtotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_riwayat_penyewaan');
    }
};
