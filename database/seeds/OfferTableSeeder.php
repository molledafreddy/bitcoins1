<?php

use Illuminate\Database\Seeder;
use App\Offer;

class OfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Offer::class,10)->create();
    }
}
