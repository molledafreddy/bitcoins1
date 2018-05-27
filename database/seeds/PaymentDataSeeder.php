<?php

use Illuminate\Database\Seeder;
use App\PaymentData;
class PaymentDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	PaymentData::create([
          	'id' => 1,
            'name' => 'Uphold',
            'description' => 'metodo de pago de transacciones electronicas',
            'logo' => 'uphold.jpg',
            'type' => 1,
            'status' => 1,
                   
      	]);

      	PaymentData::create([
          	'id' => 2,
            'name' => 'Banco de Bogota',
            'description' => 'entidad bancaria de bogota',
            'logo' => 'bancobogota.jpg',
            'type' => 2,
            'status' => 1,
                   
      	]);
    }
}
