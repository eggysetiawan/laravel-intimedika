<?php

namespace App\Services;

use App\InventoryType;
use Illuminate\Support\Str;


class InventoryService
{

    public function createInventory($request)
    {
        $attr = $request->all();
        $sn = $request->service_tag ?? $request->serial_number;
        $attr['slug'] = Str::slug($request->item . '-' . $sn);
        $attr['department_id'] = $request->department;
        return auth()->user()->inventories()->create($attr);
    }

    public function createType($request)
    {
        $types = InventoryType::where('name', $request->type)->exists();

        if (!$types) {
            return InventoryType::create([
                'name' => $request->type,
            ]);
        }
        return null;
    }
}
