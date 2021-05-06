<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'user_id' => 1,
            'name' => 'Admin',
            'manager' => 'Liliek Anggraeni',
            'floor' => '2',
            'location' => 'Kantor Utama'
        ]);

        Department::create([
            'user_id' => 1,
            'name' => 'Sales',
            'manager' => 'Teten Sutendi',
            'floor' => '3',
            'location' => 'Kantor Utama'
        ]);

        Department::create([
            'user_id' => 1,
            'name' => 'Teknisi',
            'manager' => 'Advent Kristian',
            'floor' => '3',
            'location' => 'Kantor Utama'
        ]);

        Department::create([
            'user_id' => 1,
            'name' => 'IT',
            'manager' => 'Hardian Kristi',
            'floor' => '3',
            'location' => 'Kantor Utama'
        ]);
    }
}
