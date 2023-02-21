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
        Schema::create('event', function (Blueprint $table) {
            $table->id('id_event');
            $table->unsignedBigInteger('id_paket');
            $table->foreign('id_paket')->references('id_paket')->on('paket_event');
            $table->string('no_invoice', 20);
            $table->string('nama_event', 50);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('lokasi_event', 50);
            $table->string('nama_pemesan', 50);
            $table->unsignedBigInteger('id_status_event');
            $table->foreign('id_status_event')->references('id_status_event')->on('status_event');
            $table->integer('subtotal');
            $table->integer('pajak');
            $table->integer('total');
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
        Schema::dropIfExists('event');
    }
};
