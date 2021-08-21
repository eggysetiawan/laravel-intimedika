<?php

use App\Installation;
use App\Migration\Installation as MigrationInstallation;
use Illuminate\Database\Seeder;

class InstallationMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $installations = Installation::query()
            ->get();

        foreach ($installations as $installation) {
            $teknik_instalasi = MigrationInstallation::where('pk_instalasi', $installation->id)->first();

            if ($teknik_instalasi->pengajuan) {
                $installation
                    ->addMedia(storage_path('MigrasiPdf/pengajuan-' . $teknik_instalasi->pengajuan))
                    ->preservingOriginal()
                    ->toMediaCollection('pengajuan');
            }
        }
    }
}
