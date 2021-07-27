<?php

use App\Customer;
use App\InstalledModality;
use App\Migration\Service as MigrationService;
use App\Service;
use App\Software;
use App\User;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teknik_service = MigrationService::all();

        foreach ($teknik_service as $service) {


            if ($service->sales) {
                $sales_ids = User::where('username', str_replace(['intiwid', 'intiwidteknik', 'intiwid02'], 'intiwid01', $service->sales))->first();
                $sales_id = $sales_ids->id;
            } else {
                $sales_id = 2;
            }
            $user_ids = User::where('username', str_replace('intwidteknik', 'intiwid01', $service->username))->first();
            $user_id = $user_ids->id;

            if (Customer::find($service->fk_cust)) {

                $services = Service::create([
                    'id' => $service->pk_service,
                    'user_id' => $user_id,
                    'customer_id' => $service->fk_cust,
                    'sn' => $service->sn,
                    'condition' => $service->kondisi,
                    'problem' => $service->problem,
                    'service_note' => $service->ketservice,
                    'result' => $service->hasil_service,
                    'date' => $service->tgl_service,
                    'sales_id' => $sales_id,
                    'status' => $service->status,
                    'is_finished' => $service->finish,
                    'created_at' => $service->created_at,
                    'updated_at' => $service->updated_at,
                ]);


                if ($service->fk_sw && Software::find($service->fk_sw)) {
                    $services->softwares()->attach($service->fk_sw);
                }

                if ($service->fk_modality && InstalledModality::find($service->fk_modality)) {
                    $services->installed_mods()->attach($service->fk_modality);
                }

                if ($service->fk_instalasi) {
                    $services->installations()->attach($service->fk_instalasi);
                }
            }
        }
    }
}
