<?php

use App\User;
use Illuminate\Database\Seeder;

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
            'name' => 'IT Division',
            'username' => 'intiwid01',
            'initial' => 'IT',
            'email' => 'setiawaneggy@gmail.com',
            'password' => bcrypt('intiwid1'),
            'pin' => bcrypt(112233),
            'level' => 'top',
            'phone' => '081387239119',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);
    }
}
