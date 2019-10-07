<?php

use Illuminate\Database\Seeder;
use Infoclinic\Model\Pais;

class PaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::create(['id'=>1,'nome'=>'Brasil','sigla'=>'PR']);
    }
}
