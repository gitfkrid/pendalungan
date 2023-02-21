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
        Schema::create('detail_event', function (Blueprint $table) {
            $table->unsignedBigInteger('id_event');
            $table->foreign('id_event')->references('id_event')->on('event');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_jobdesc');
            $table->foreign('id_jobdesc')->references('id_jobdesc')->on('jobdesc_event');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_event');
    }
};
