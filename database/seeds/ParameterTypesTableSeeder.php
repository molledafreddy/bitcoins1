<?php

use Illuminate\Database\Seeder;
use App\ParameterType;

class ParameterTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParameterType::create([
	          'id' => 1,
            'name' => 'Correo de contacto',
            'status' => 1,
                   
      	]);

        ParameterType::create([
            'id' => 2,
            'name' => 'Comision en Bitcoins',
            'status' => 1,
          ]);

        ParameterType::create([
            'id' => 3,
            'name' => 'Comision en pesos',
            'status' => 1,
          ]);

    }
}
