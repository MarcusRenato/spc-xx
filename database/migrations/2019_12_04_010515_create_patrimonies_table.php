<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrimoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrimonies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rp')->unique()->nullable();
            $table->text('descricao');
            $table->string('marca')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('n_nf_tm')->nullable();
            $table->date('data_emissao')->nullable();
            $table->string('serie')->nullable();
            $table->string('prd')->nullable();
            $table->string('processo')->nullable();
            $table->date('data_entrada')->nullable();
            $table->unsignedBigInteger('origin_id')->nullable();
            $table->string('tipo_origem');
            $table->enum('estado', ['0', '1'])->nullable();
            $table->string('situacao');
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('origin_id')->references('id')->on('origins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patrimonies');
    }
}
