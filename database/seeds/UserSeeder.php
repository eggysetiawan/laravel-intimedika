<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userSuperAdmin = User::create([
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

        $userDirector = User::create([
            'name' => 'Johannes Hendrajaja',
            'username' => 'intimedika01',
            'initial' => 'JH',
            'email' => 'jhn@mail.com',
            'password' => bcrypt('intiwid1'),
            'level' => 'middle',
            'phone' => '0816854312',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);

        Permission::create(['name' => 'approval']);
        Permission::create(['name' => 'salesman']);
        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'supervise']);


        $supeardmin = Role::create(['name' => 'superadmin']);
        $director = Role::create(['name' => 'director']);

        Role::create(['name' => 'sales']);
        Role::create(['name' => 'teknisi']);
        Role::create(['name' => 'admin']);


        $supeardmin->givePermissionTo('approval');
        $supeardmin->givePermissionTo('salesman');
        $supeardmin->givePermissionTo('admin');


        $director->givePermissionTo('approval');

        $userSuperAdmin->assignRole('superadmin');
        $userDirector->assignRole('director');
    }
}
