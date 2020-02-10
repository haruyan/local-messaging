<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pengirim_id')->unsigned();
            $table->bigInteger('tipe_surat_id')->unsigned();
            $table->string('nomor_surat');
            $table->text('body');
            $table->date('tanggal_surat');
            
            $table->softDeletes();
            $table->timestamps();

            
        });

        Schema::table('surat', function($table) {
            $table->foreign('pengirim_id')->references('id')->on('instansi')->onDelete('cascade');
            $table->foreign('tipe_surat_id')->references('id')->on('tipe_surat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat');
    }
}
