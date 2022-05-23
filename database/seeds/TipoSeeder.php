<?php

use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            ['id' => 1, 'tipo' => 'ATICO'],
            ['id' => 2, 'tipo' => 'DUPLEX'],
            ['id' => 3, 'tipo' => 'CASA'],
        ]);
    }
}
