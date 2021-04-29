<?php

namespace App\Http\Controllers;

use App\Advance;
use App\DataTables\AdvanceDataTable;
use Illuminate\Http\Request;
use App\Http\Requests\AdvanceRequest;
use App\Http\Resources\UpdateNeedResource;
use App\Services\AdvanceService;

class AdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdvanceDataTable $dataTable)
    {
        return $dataTable->render('advances.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('advances.create', [
            'advance' => new Advance(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AdvanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvanceRequest $request, AdvanceService $advanceService)
    {
        $advanceService->createAdvance($request);
        $advanceService->insertNeeds($request);

        session()->flash('success', 'Advances Perjalanan berhasil dibuat!');
        return redirect('advances');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function show(Advance $advance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function edit(Advance $advance)
    {
        $advance->load('needs');
        return view('advances.edit', [
            'advance' => $advance,
        ]);
    }

    public function needs(Advance $advance)
    {
        $needs = UpdateNeedResource::collection($advance->needs);
        return response()->json($needs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advance $advance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advance $advance)
    {
        $advance->delete();
        session()->flash('success', 'Advance telah berhasil dihapus!');
        return redirect('advances');
    }
}
