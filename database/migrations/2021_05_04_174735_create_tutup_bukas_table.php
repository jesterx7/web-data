<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutupBukasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutup_buka', function (Blueprint $table) {
            $table->bigIncrements('id_tutupbuka');
            $table->dateTime('tanggal_tutup');
            $table->dateTime('tanggal_buka');
            $table->unsignedBigInteger('id_anak');
            $table->foreign('id_anak')->references('id_anak')->on('anak');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutup_buka');
    }
}
