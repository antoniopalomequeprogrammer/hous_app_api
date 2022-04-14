<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePermisoModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permiso_modelos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('permiso_id');
            $table->string('modelo');
            $table->boolean('ver')->default(0);
            $table->boolean('crear')->default(0);
            $table->boolean('editar')->default(0);
            $table->boolean('eliminar')->default(0);
            $table->timestamps();
        });

        $defaultPermisoModelos = [
            ['permiso_id' => 1, 'modelo' => 'usuarios', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 1, 'modelo' => 'permisos', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 1, 'modelo' => 'establecimientos', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 1, 'modelo' => 'productos', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 1, 'modelo' => 'categorias', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 1, 'modelo' => 'logs', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 1, 'modelo' => 'dashboard', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1]
        ];

        //permisos AdminEstablecimiento
        $permisosAdminEstablecimiento = [
            ['permiso_id' => 2, 'modelo' => 'usuarios', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 2, 'modelo' => 'permisos', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 2, 'modelo' => 'establecimientos', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 2, 'modelo' => 'productos', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 2, 'modelo' => 'categorias', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 2, 'modelo' => 'logs', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1],
            ['permiso_id' => 2, 'modelo' => 'dashboard', 'ver' => 1, 'crear' => 1, 'editar' => 1, 'eliminar' => 1]
        ];
        //permisos Usuario
        $permisosUsuario = [
            ['permiso_id' => 3, 'modelo' => 'usuarios', 'ver' => 0, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 3, 'modelo' => 'permisos', 'ver' => 0, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 3, 'modelo' => 'establecimientos', 'ver' => 1, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 3, 'modelo' => 'productos', 'ver' => 1, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 3, 'modelo' => 'categorias', 'ver' => 1, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 3, 'modelo' => 'logs', 'ver' => 0, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 3, 'modelo' => 'dashboard', 'ver' => 0, 'crear' => 0, 'editar' => 0, 'eliminar' => 0]
        ];
        //permisos Cliente
        $permisosCliente = [
            ['permiso_id' => 4, 'modelo' => 'usuarios', 'ver' => 0, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 4, 'modelo' => 'permisos', 'ver' => 0, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 4, 'modelo' => 'establecimientos', 'ver' => 1, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 4, 'modelo' => 'productos', 'ver' => 1, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 4, 'modelo' => 'categorias', 'ver' => 1, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 4, 'modelo' => 'logs', 'ver' => 0, 'crear' => 0, 'editar' => 0, 'eliminar' => 0],
            ['permiso_id' => 4, 'modelo' => 'dashboard', 'ver' => 0, 'crear' => 0, 'editar' => 0, 'eliminar' => 0]
        ];

        DB::table('permiso_modelos')->insert($defaultPermisoModelos);
        DB::table('permiso_modelos')->insert($permisosAdminEstablecimiento);
        DB::table('permiso_modelos')->insert($permisosUsuario);
        DB::table('permiso_modelos')->insert($permisosCliente);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permiso_modelos');
    }
}
