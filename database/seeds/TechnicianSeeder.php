<?php

use App\User;
use Illuminate\Database\Seeder;

class TechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technicians = [
            [
                'name' => 'Asep Suhendar',
                'position' => 'Teknisi',
                'username' => 'asepsuhendar',
                'initial' => 'AS',
                'email' => 'asepsuhendar@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],

            [
                'name' => 'Muhammad Natsir',
                'position' => 'Teknisi',
                'username' => 'mnatsir',
                'initial' => 'MN',
                'email' => 'mnatsir@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],
            [
                'name' => 'Febry Sihite',
                'position' => 'Teknisi',
                'username' => 'febrysihite',
                'initial' => 'FS',
                'email' => 'febrysihite@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],
            [
                'name' => 'Rafly Chalid',
                'position' => 'Teknisi',
                'username' => 'raflychalid',
                'initial' => 'RC',
                'email' => 'raflychalid@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],
            [
                'name' => 'Yustinus Yondi',
                'position' => 'Teknisi',
                'username' => 'yustinusyondi',
                'initial' => 'YY',
                'email' => 'yustinusyondi@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],
            [
                'name' => 'Ade Yunanda',
                'position' => 'Teknisi',
                'username' => 'yunandaade',
                'initial' => 'AY',
                'email' => 'yunandaade@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],
            [
                'name' => 'Ahmad Fanani',
                'position' => 'Teknisi',
                'username' => 'fananiahmad',
                'initial' => 'AF',
                'email' => 'fanani@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],
            [
                'name' => 'Advent Kristian',
                'position' => 'Teknisi',
                'username' => 'adventkristian',
                'initial' => 'AK',
                'email' => 'advent@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],
            [
                'name' => 'Okta Dwi Suprapto',
                'position' => 'Teknisi',
                'username' => 'dwiokta',
                'initial' => 'ODS',
                'email' => 'oktadwi@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],
            [
                'name' => 'Dea Indar Saputro',
                'position' => 'Teknisi',
                'username' => 'deaindar',
                'initial' => 'DIS',
                'email' => 'dea@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],
            [
                'name' => 'Januar Ariadhi Bhismantara',
                'position' => 'Teknisi',
                'username' => 'januar',
                'initial' => 'JAB',
                'email' => 'januar@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ],
            [
                'name' => 'Salman Alfarisy',
                'position' => 'Teknisi',
                'username' => 'salman',
                'initial' => 'SA',
                'email' => 'salman@intimedika.co',
                'password' => bcrypt('intiwid'),
                'phone' => '02402402',
                'address' => 'North Jakarta',
                'city' => 'Jakarta'
            ]
        ];

        foreach ($technicians as $technician) {
            $user = User::create($technician);

            $user->assignRole('teknisi');
        }
    }
}
