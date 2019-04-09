<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_provinsi');
            $table->string('nama', 50);
            $table->string('email', 30)->unique();
            $table->string('password');
            $table->boolean('gender');
            $table->string('poto')->nullable();
            $table->text('alamat');
            $table->timestamps();
            $table->foreign('id_provinsi')->references('id')->on('provinsi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('santri');
    }
}
