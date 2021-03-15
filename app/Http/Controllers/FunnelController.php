<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Funnel;
use App\Customer;
use App\Modality;
use App\DataTables\FunnelDataTable;
use App\Http\Requests\FunnelRequest;
use App\Http\Requests\FunnelUpdateRequest;
use App\Services\FunnelService;

class FunnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FunnelDataTable $dataTable)
    {
        return $dataTable->render('funnels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('funnels.create', [
            'offer' => new Offer(),
            'funnel' => new Funnel(),
            'customers' => Customer::selectCustomer(),
            'modalities' => Modality::selectModality(),
            'count' => request('count'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FunnelRequest $request, FunnelService $funnelService)
    {
        // to offers table
        $funnelService->createOffer($request);
        // to invoices table
        $funnelService->createInvoice();
        // to offer_progress table
        $funnelService->createProgress($request);
        // to orders table
        $funnelService->insertOrder($request);
        // to funnels table
        $funnelService->createFunnel($request);

        // alert success
        session()->flash('success', 'Funnel telah berhasil dibuat!');
        return redirect('funnels');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function show(Funnel $funnel)
    {
        return view('funnels.show', compact('funnel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Funnel $funnel)
    {
        $offer = $funnel->offer;
        $count = $offer->invoices()->first()->orders()->count();
        $modalities = Modality::selectModality();

        return view('funnels.edit', compact('offer', 'funnel', 'count', 'modalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function update(FunnelUpdateRequest $request, Funnel $funnel, FunnelService $funnelService)
    {
        $attr = $request->all();
        $funnelService->updateOrder($request, $funnel);
        $funnel->update($attr);
        // alert success
        session()->flash('success', 'Funnel telah berhasil di update!');
        return redirect('funnels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funnel $funnel)
    {
        //
    }
}
