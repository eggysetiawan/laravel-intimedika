<?php

namespace App\Services;

use App\Department;
use App\InventoryType;
use Illuminate\Support\Str;


class InventoryService
{
    public function createInventory($request)
    {
        $attr = $request->validated();
        $sn = $request->service_tag ?? $request->serial_number;
        $slug = Str::slug($request->item . '-' . $sn);
        if ($slug == '') {
            $slug = Str::slug(uniqid('inventories-'));
        }
        $attr['service_tag'] = $request->service_tag ?? 0;
        $attr['serial_number'] = $request->serial_number ?? 0;
        $attr['slug'] = $slug;
        $attr['department_id'] = Department::getDepartmentId();
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

    public function updateInventory($request, $inventory)
    {
        $attr = $request->validated();
        $attr['department_id'] = $request->department;
        return  $inventory->update($attr);
    }
}
