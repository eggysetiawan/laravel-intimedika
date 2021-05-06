<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Department;
use App\DataTables\InventoryDataTable;
use App\Http\Requests\InventoryRequest;
use App\InventoryType;
use App\Services\InventoryService;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InventoryDataTable $dataTable)
    {
        return $dataTable->render('inventories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventories.create', [
            'inventory' => new Inventory(),
            'departments' => Department::get(),
            'types' => InventoryType::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryRequest $request, InventoryService $inventoryService)
    {
        $inventoryService->createInventory($request);
        $inventoryService->createType($request);

        session()->flash('success', 'Inventory telah berhasil ditambahkan!');
        return redirect('inventories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        return view('inventories.edit', [
            'inventory' => $inventory,
            'departments' => Department::get(),
            'types' => InventoryType::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryRequest $request, Inventory $inventory)
    {
        (new InventoryService())->updateInventory($request, $inventory);
        session()->flash('success', 'Inventory telah berhasil diupdate!');
        return redirect('inventories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        session()->flash('success', 'Data barang telah berhasil di hapus!');
        return back();
    }
}
