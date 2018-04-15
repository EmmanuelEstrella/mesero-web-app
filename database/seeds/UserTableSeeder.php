<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        User::firstOrCreate(['email' => 'admin@test.com'], [
            'name' => 'Mr. Admin',
            'password' => Hash::make('default')
        ]);
    }
}
