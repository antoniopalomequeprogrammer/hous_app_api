<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->unsignedBigInteger('permiso_padre_id')->nullable();
            $table->timestamps();
        });

        $defaultPermiso = [
            ['nombre' => 'Master']
        ];

        $permisoAdminEstablecimiento = [
            ['nombre'=> 'adminEstablecimiento']
        ];

        $permisoUsuario = [
            ['nombre'=> 'usuario']
        ];

        $permisoCliente = [
            ['nombre' => 'cliente']
        ];

        DB::table('permisos')->insert($defaultPermiso);
        DB::table('permisos')->insert($permisoAdminEstablecimiento);
        DB::table('permisos')->insert($permisoUsuario);
        DB::table('permisos')->insert($permisoCliente);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
