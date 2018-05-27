<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ContentTypeTableSeeder::class);
        $this->call(LoadContentTableSeeder::class);
        $this->call(ParameterTypesTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        // $this->call(OfferTableSeeder::class);
        $this->call(PaymentDataSeeder::class);
        $this->call(PaymentDataDetailSeeder::class);
    }
}
