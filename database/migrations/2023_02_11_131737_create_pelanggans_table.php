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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->string('uuid')->unique();
            $table->string('nama_pelanggan', 50);
            $table->string('alamat_pelanggan', 100);
            $table->string('hp_pelanggan', 14);
            $table->string('email_pelanggan', 50);
            $table->string('username_pelanggan', 50);
            $table->string('password_pelanggan', 255);
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
        Schema::dropIfExists('pelanggan');
    }
};
