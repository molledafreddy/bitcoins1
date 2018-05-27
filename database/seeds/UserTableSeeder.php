<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'name' => 'Administrador',
        'lastname' => '',
        'email' => 'admin@bitcoinbogota.co',
        'username' => 'admin',
        'password' => bcrypt('Administracion2023'),
        'type' => 'A',
        'is_active' => '1',
      ]);
    }
}
