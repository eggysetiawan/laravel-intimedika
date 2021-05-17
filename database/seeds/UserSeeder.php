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
            'email' => 'intiwid@intimedika.co',
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
        $userIT = User::create([
            'name' => 'IT Intimedika',
            'username' => 'intimedika_it',
            'position' => 'IT Developer',
            'initial' => 'IT',
            'email' => 'it@intimedika.co',
            'password' => bcrypt('intiwid'),
            'phone' => '0816854312',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);

        // IT
        $rahmat = User::create([
            'name' => 'Rahmat Setiawan',
            'username' => 'eggysetiawan',
            'position' => 'IT Developer',
            'initial' => 'RS',
            'email' => 'rahmat@intimedika.co',
            'password' => bcrypt('intiwid1'),
            'phone' => '081387239119',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);
        $rafli = User::create([
            'name' => 'M. Rafli Satriawan',
            'username' => 'mraff10',
            'position' => 'IT Developer',
            'initial' => 'MRS',
            'email' => 'rafli@intimedika.co',
            'password' => bcrypt('intiwid1'),
            'phone' => '081387239119',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);

        $andika = User::create([
            'name' => 'Andika Utama',
            'username' => 'andikautama',
            'position' => 'IT Developer',
            'initial' => 'AU',
            'email' => 'andika@intimedika.co',
            'password' => bcrypt('intiwid1'),
            'phone' => '081387239119',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);
        $febrian = User::create([
            'name' => 'Febrian Faturrahman',
            'username' => 'febrianftr',
            'position' => 'IT Developer',
            'initial' => 'FF',
            'email' => 'febrian@intimedika.co',
            'password' => bcrypt('intiwid1'),
            'phone' => '081387239119',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);
        $dimas = User::create([
            'name' => 'Dimas Halim H',
            'username' => 'dimashalimh',
            'position' => 'IT Developer',
            'initial' => 'DHH',
            'email' => 'dimas@intimedika.co',
            'password' => bcrypt('intiwid1'),
            'phone' => '081387239119',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);

        $richard = User::create([
            'name' => 'Richard Karisma',
            'username' => 'richardkarisma',
            'position' => 'IT Developer',
            'initial' => 'RKA',
            'email' => 'richard@intimedika.co',
            'password' => bcrypt('intiwid1'),
            'phone' => '081387239119',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);

        $hardian = User::create([
            'name' => 'Hardian Kristi P.',
            'username' => 'hardian',
            'position' => 'IT Developer',
            'initial' => 'HKP',
            'email' => 'hardian@intimedika.co',
            'password' => bcrypt('intiwid1'),
            'phone' => '0822032030',
            'address' => 'North Jakarta',
            'city' => 'Jakarta',
        ]);

        Permission::create(['name' => 'approval']);
        Permission::create(['name' => 'salesman']);
        Permission::create(['name' => 'engineering']);
        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'supervise']);
        Permission::create(['name' => 'openworld']);
        Permission::create(['name' => 'develop']);


        $supeardmin = Role::create(['name' => 'superadmin']);
        $director = Role::create(['name' => 'director']);
        $supervisor = Role::create(['name' => 'supervisor']);
        $sales = Role::create(['name' => 'sales']);
        $teknisi = Role::create(['name' => 'teknisi']);
        $admin = Role::create(['name' => 'admin']);
        $it = Role::create(['name' => 'it']);

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
        $it->givePermissionTo('develop');




        // assign role
        $userSuperAdmin->assignRole('superadmin');
        $userDirector->assignRole('director');
        $userAdmin->assignRole('admin');
        $userTeknisi->assignRole('teknisi');
        $userSales->assignRole('sales');
        $userSupervisor->assignRole('sales');
        $userIT->assignRole('it');

        $rahmat->assignRole('it');
        $rafli->assignRole('it');
        $febrian->assignRole('it');
        $andika->assignRole('it');
        $richard->assignRole('it');
        $dimas->assignRole('it');
        $hardian->assignRole('it');
        $hardian->assignRole('supervisor');
    }
}
