<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenerimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerima', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('penerima_id')->unsigned();
            $table->bigInteger('surat_id')->unsigned();
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('penerima_id')->references('id')->on('instansi')->onDelete('cascade');
            $table->foreign('surat_id')->references('id')->on('surat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penerima');
    }
}
