<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Funnel;
use App\Customer;
use App\Modality;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\FunnelDataTable;
use App\Http\Requests\FunnelRequest;

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
    public function create(FunnelDataTable $dataTable)
    {
        $customers = Customer::with('hospitals')
            ->orderBy('name', 'asc')
            ->get();

        if (!request('count')) :
            return $dataTable->render('funnels.index');
        else :
            return view('funnels.create', [
                'offer' => new Offer(),
                'funnel' => new Funnel,
                'customers' => $customers,
                'modalities' => Modality::orderBy('name', 'asc', 'price')->get(),
                'count' => request('count'),
            ]);
        endif;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FunnelRequest $request)
    {
        $attr = $request->all();
        // insert into offer table
        $attr['customer_id'] = $request->customer;
        $offer = auth()->user()->offers()->create($attr);

        // assign to funnel slug
        $attr['slug'] = Str::slug($request->description . ' ' . date('YmdHis'));
        // insert into funnels table
        $offer->funnel()->create($attr);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Funnel $funnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funnel $funnel)
    {
        //
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
