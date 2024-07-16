<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userprofile', function (Blueprint $table) {
            $table->id();
            $table->string('nama_userprofile');
            $table->text('alamat_userprofile');
            $table->boolean('status_userprofile');
            $table->unsignedBigInteger('fk_user_id');
            $table->unsignedBigInteger('fk_provinsi_id');
            $table->unsignedBigInteger('fk_kota_id');
            $table->unsignedBigInteger('fk_kecamatan_id');
            $table->foreign('fk_user_id')->references('id')->on('user');
            $table->foreign('fk_provinsi_id')->references('id')->on('provinsi');
            $table->foreign('fk_kota_id')->references('id')->on('kota');
            $table->foreign('fk_kecamatan_id')->references('id')->on('kecamatan');
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
        Schema::dropIfExists('userprofile');
    }
}
