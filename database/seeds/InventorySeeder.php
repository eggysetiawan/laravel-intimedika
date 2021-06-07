<?php

use App\Inventory as AppInventory;
use App\Migration\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventories = Inventory::all();

        foreach ($inventories as $inventory) {
            AppInventory::create([
                'user_id' => $inventory->user_id,
                'slug' => $inventory->slug,
                'departement_id' => $inventory->departement_id,
                'service_tag' => $inventory->service_tag,
                'serial_number' => $inventory->serial_number,
                'item' => $inventory->item,
                'type' => $inventory->type,
                'quantity' => $inventory->quantity,
                'user' => $inventory->user,
                'location' => $inventory->location,
                'purchase_date' => $inventory->purchase_date,
                'note' => $inventory->note,
                'created_at' => $inventory->created_at,
                'updated_at' => $inventory->updated_at,
                'deleted_at' => $inventory->deleted_at,
            ]);
        }
    }
}
