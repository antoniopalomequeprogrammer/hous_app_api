<?php

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            ['id' => 1, 'estado' => 'NUEVO'],
            ['id' => 2, 'estado' => 'REFORMADO'],
            ['id' => 3, 'estado' => 'BUEN ESTADO'],
            ['id' => 4, 'estado' => 'PARA REFORMAR'],
            
        ]);

    }
}
