<?php

use Illuminate\Database\Seeder;
use App\PaymentDataDetail;

class PaymentDataDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentDataDetail::create([
          	'id' => 1,
            'name' => 'wallet',
            'value' => '1gH4DtRRE43JuIkoh75f43eDRf43sDfG4',
            'payment_data_id' => 1,          
                   
      	]);

      
        PaymentDataDetail::create([
          	'id' => 2,
            'name' => 'cuenta',
            'value' => '78458789568754895123',
            'payment_data_id' => 2,          
                   
      	]);
    }
}
