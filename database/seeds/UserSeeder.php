<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['nombre' => 'Admin', 'apellidos' => 'Master', 'email' => 'admin@admin.com', 'permiso_id' => 1, 'rol' => 'admin', 'password' => bcrypt('adminweb')],
            ['nombre' => 'Antonio', 'apellidos' => 'Palomeque', 'email' => 'colaborador@colaborador.com', 'permiso_id' => 1, 'rol' => 'colaborador', 'password' => bcrypt('adminweb')]
        ]);
    }
}
