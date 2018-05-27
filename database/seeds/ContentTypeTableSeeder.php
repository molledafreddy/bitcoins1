<?php

use Illuminate\Database\Seeder;
use App\ContentType;
use App\LoadContent;
class ContentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContentType::create([
	        'id' => 1,
	        'name' => 'Politicas de uso web',
	        'status' => 1,	       
      	]);

      	ContentType::create([
	        'id' => 2,
	        'name' => 'Terminos y condiciones',
	        'status' => 1,	       
      	]);

      	ContentType::create([
	        'id' => 3,
	        'name' => 'Consejos de seguridad',
	        'status' => 1,	       
      	]);

      	$seller = ContentType::create([
	        'id' => 4,
	        'name' => 'Condiciones de venta',
	        'status' => 1,	       
      	]);
        $buy = ContentType::create([
          'id' => 5,
          'name' => 'Condiciones de compra',
          'status' => 1,         
        ]);

    }
}
