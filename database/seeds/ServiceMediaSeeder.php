<?php

use App\Migration\Service as MigrationService;
use App\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ServiceMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.s
     *
     * @return void
     */
    public function run()
    {
        $services = Service::query()
            ->get();

        foreach ($services as $service) {
            $teknik_service = MigrationService::where('pk_service', $service->id)->first();


            if ($teknik_service->pengajuan) {
                if (Storage::disk('migration')->exists('pengajuan-' . $teknik_service->pengajuan)) {
                    $service
                        ->addMedia(storage_path('MigrasiPdf/pengajuan-' . $teknik_service->pengajuan))
                        ->preservingOriginal()
                        ->toMediaCollection('pengajuan');
                }
            }
        }
    }
}
