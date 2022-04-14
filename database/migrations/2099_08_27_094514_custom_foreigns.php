<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CustomForeigns extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
  public function up(){



        Schema::table('inmobiliarias', function(Blueprint $table){
			$table->unsignedBigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->nullable();
		});

        Schema::table('suscripcions', function(Blueprint $table){
			$table->unsignedBigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->nullable();
		});

        Schema::table('viviendas', function(Blueprint $table){
			$table->unsignedBigInteger('inmobiliaria_id')->unsigned();
            $table->unsignedBigInteger('estado_id')->unsigned();
            $table->unsignedBigInteger('tipo_id')->unsigned();
			$table->foreign('inmobiliaria_id')->references('id')->on('inmobiliarias')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('tipo_id')->references('id')->on('tipos')->nullable();
		});

        Schema::table('imagens', function(Blueprint $table){
			$table->unsignedBigInteger('vivienda_id')->unsigned();
			$table->foreign('vivienda_id')->references('id')->on('viviendas')->nullable();
		});





		}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			//
	}
}
