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
            'position' => 'IT Developer',
            'initial' => 'IT',
            'email' => 'setiawaneggy@gmail.com',
            'password' => bcrypt('intiwid1'),
            'pin' => bcrypt(1111),
            'phone' => '081387239119',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);

        $userDirector = User::create([
            'name' => 'Johannes Hendrajaja',
            'username' => 'intimedika01',
            'position' => 'Direktur',
            'initial' => 'JH',
            'email' => 'jhn@mail.com',
            'password' => bcrypt('intiwid1'),
            'phone' => '0816854312',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);
        $userAdmin = User::create([
            'name' => 'PT. Intimedika Puspa Indah',
            'username' => 'admin_intimed',
            'position' => 'Admin',
            'initial' => 'IPI',
            'email' => 'intimedika@mail.com',
            'password' => bcrypt('intiwid1'),
            'phone' => '0816854312',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);
        $userSupervisor = User::create([
            'name' => 'Demo Supervisor',
            'username' => 'spv_intimed',
            'position' => 'Sales',
            'initial' => 'SPV',
            'email' => 'spv@mail.com',
            'password' => bcrypt('intiwid1'),
            'phone' => '0816854312',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);
        $userTeknisi = User::create([
            'name' => 'Demo Teknisi',
            'username' => 'teknisi',
            'position' => 'Teknisi',
            'initial' => 'TKN',
            'email' => 'teknisi@mail.com',
            'password' => bcrypt('intiwid1'),
            'phone' => '0816854312',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);
        $userSales = User::create([
            'name' => 'Demo sales',
            'username' => 'sales',
            'position' => 'Sales',
            'initial' => 'Sls',
            'email' => 'sales@mail.com',
            'password' => bcrypt('intiwid1'),
            'phone' => '0816854312',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);

        Permission::create(['name' => 'approval']);
        Permission::create(['name' => 'salesman']);
        Permission::create(['name' => 'engineering']);
        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'supervise']);
        Permission::create(['name' => 'openworld']);


        $supeardmin = Role::create(['name' => 'superadmin']);
        $director = Role::create(['name' => 'director']);
        $supervisor = Role::create(['name' => 'supervisor']);
        $sales = Role::create(['name' => 'sales']);
        $teknisi = Role::create(['name' => 'teknisi']);
        $admin = Role::create(['name' => 'admin']);

        // give permission
        $supeardmin->givePermissionTo('approval');
        $supeardmin->givePermissionTo('salesman');
        $supeardmin->givePermissionTo('admin');
        $supeardmin->givePermissionTo('openworld');
        $supeardmin->givePermissionTo('supervise');

        $director->givePermissionTo('approval');

        $supervisor->givePermissionTo('supervise');

        $sales->givePermissionTo('salesman');

        $teknisi->givePermissionTo('engineering');

        $admin->givePermissionTo('admin');


        // assign role
        $userSuperAdmin->assignRole('superadmin');
        $userDirector->assignRole('director');
        $userAdmin->assignRole('admin');
        $userTeknisi->assignRole('teknisi');
        $userSales->assignRole('sales');
        $userSupervisor->assignRole('supervisor');
    }
}
