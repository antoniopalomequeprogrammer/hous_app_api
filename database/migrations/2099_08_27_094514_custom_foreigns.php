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
			$table->foreign('user_id')->references('id')
			->onDelete('cascade')
			->on('users')->nullable();
		});

        Schema::table('suscripcions', function(Blueprint $table){
			$table->unsignedBigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->nullable();
		});

        Schema::table('viviendas', function(Blueprint $table){
			$table->unsignedBigInteger('inmobiliaria_id')->unsigned();

            $table->unsignedBigInteger('estado_id')->unsigned();

            $table->unsignedBigInteger('tipo_id')->unsigned();
			$table->foreign('inmobiliaria_id')
			->references('id')
			->on('inmobiliarias')
			->onDelete('cascade')
			->nullable();
			
            $table->foreign('estado_id')->references('id')
			->onDelete('cascade')
			->on('estados');

            $table->foreign('tipo_id')->references('id')
			->onDelete('cascade')
			->on('tipos')->nullable();
		});

        Schema::table('imagens', function(Blueprint $table){
			$table->unsignedBigInteger('vivienda_id')->unsigned();
			$table->foreign('vivienda_id')->references('id')
			->on('viviendas')
			->onDelete('cascade')
			->nullable();
		});

		Schema::table('notificacions', function(Blueprint $table){
			$table->unsignedBigInteger('vivienda_id')->unsigned();
			$table->foreign('vivienda_id')->references('id')
			->on('viviendas')
			->onDelete('cascade')
			->nullable();
		});

		Schema::table('user_vivienda', function(Blueprint $table){
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vivienda_id')->references('id')->on('viviendas')->onDelete('cascade');
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
