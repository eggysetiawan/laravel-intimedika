<?php

use App\Migration\PacsSupport;
use App\PacsSupport as AppPacsSupport;
use Illuminate\Database\Seeder;

class PacsSupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supports = PacsSupport::get();

        foreach ($supports as $support) {
            AppPacsSupport::create([
                'user_id' => $support->user_id,
                'slug' => $support->slug,
                'pacs_installation_id' => $support->pacs_installation_id,
                'hospital_personel' => $support->hospital_personel,
                'report_date' => $support->report_date,
                'report_time' => $support->report_time,
                'problem' => $support->problem,
                'solve' => $support->solve,
                'solve_date' => $support->solve_date,
                'solve_time' => $support->solve_time,
                'created_at' => $support->created_at,
                'updated_at' => $support->updated_at,
                'deleted_at' => $support->deleted_at,
            ]);
        }
    }
}
