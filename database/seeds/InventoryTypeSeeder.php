<?php

use App\InventoryType as AppInventoryType;
use App\Migration\InventoryType;
use Illuminate\Database\Seeder;

class InventoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventory_types = InventoryType::all();

        foreach ($inventory_types as $type) {
            AppInventoryType::create([
                'name' => $type->name,
                'created_at' => $type->created_at,
                'updated_at' => $type->updated_at,
            ]);
        }
    }
}
