<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViviendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->integer('precio');
            $table->integer('habitacion');
            $table->integer('planta');
            $table->integer('banos');
            $table->integer('ascensor')->default(0);
            $table->integer('garaje')->default(0);
            $table->integer('terraza')->default(0);
            $table->string('ciudad');
            $table->string('m2');
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
        Schema::dropIfExists('viviendas');
    }
}
