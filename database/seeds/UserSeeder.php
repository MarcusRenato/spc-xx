<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
            'email' => 'adm@adm.com',
            'function' => 'Administrador',
            'password' => Hash::make('administrador'),
            'admin' => '1'
        ]);
    }
}
