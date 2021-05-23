<?php

use App\Sidebar;
use Illuminate\Database\Seeder;

class SidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            // all
            'Home',
            'Inventory',
            'Rumah Sakit',
            // it
            'Perjalanan Dinas',
            'Laporan Harian',
            'Instalasi PACS',
            'Support PACS',
            // sales
            'Alat Kesehatan',
            'Customer',
            'Rencana Kunjungan',
            'Kunjungan',
            'Sales Funnel',
            'Semua Penawaran',
            // director
            'Approve Penawaran',
            'Approve Purchase Order',
            'Penawaran Berhasil'
        ];

        $nav_header = [
            // all
            'Dashboard',
            null,
            null,
            // it
            'Perjalanan Dinas',
            'Laporan Harian',
            'Instalasi PACS',
            null,
            // sales
            'Resource',
            null,
            'Kunjungan Harian',
            null,
            'Sales Funnel',
            'Penawaran',
            // director
            null,
            null,
            null
        ];

        $routes = [
            // all
            'home',
            'inventories.index',
            'hospitals.index',
            // it
            'advances.index',
            'daily_jobs.index',
            'pacs_installations.index',
            'pacs_supports.index',
            // sales
            'modalities.index',
            'customers.index',
            'visitplan.index',
            'visits.index',
            'funnels.index',
            'offers.index',
            // director
            'offers.approval',
            'progress.approval',
            'offers.complete',
        ];

        $icons = [
            // all
            '<i class="fas fa-home nav-icon"></i>',
            '<i class="fas fa-archive nav-icon"></i>',
            '<i class="fas fa-hospital nav-icon"></i>',
            // it
            '<i class="fas fa-luggage-cart nav-icon"></i>',
            '<i class="fas fa-calendar-alt nav-icon"></i>',
            '<i class="fas fa-download nav-icon"></i>',
            '<i class="fas fa-phone-alt nav-icon"></i>',
            // sales
            '<i class="fas fa-charging-station nav-icon"></i>',
            '<i class="fas fa-street-view nav-icon"></i>',
            '<i class="fas fa-map-marked-alt nav-icon"></i>',
            '<i class="fas fa-route nav-icon"></i>',
            '<i class="fas fa-funnel-dollar nav-icon"></i>',
            '<i class="fab fa-buffer nav-icon"></i>',
            // director
            '<i class="fas fa-exclamation nav-icon"></i>',
            '<i class="fas fa-hand-holding-usd nav-icon"></i>',
            '<i class="fas fa-check-circle nav-icon"></i>'
        ];
        $roles = [
            // all
            null,
            null,
            null,
            // it
            'supeardmin|it',
            'supeardmin|it',
            'supeardmin|it',
            'supeardmin|it',
            // sales
            'director|sales|superadmin',
            'director|sales|superadmin',
            'director|sales|superadmin',
            'director|sales|superadmin',
            'director|sales|superadmin',
            'director|sales|superadmin',
            // director
            'superadmin|director',
            'superadmin|director',
            'superadmin|director',
        ];

        $prefixes = [
            // all
            '/',
            'inventories',
            'hospitals',
            // it
            'advances',
            'daily_jobs',
            'pacs_installations',
            'pacs_supports',
            // sales
            'modalities',
            'customers',
            'visitplan',
            'visits',
            'funnels',
            'offers',
            // director
            'offers',
            'progress',
            'offers',


        ];



        $i = 0;
        foreach ($names as $name) {
            Sidebar::create([
                'name' => $name,
                'route' => $routes[$i],
                'icon' => $icons[$i],
                'role' => $roles[$i],
                'prefix' => $prefixes[$i],
                'nav_header' => $nav_header[$i],
            ]);
            $i++;
        }
    }
}
