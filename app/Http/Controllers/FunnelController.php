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
use App\Http\Requests\FunnelUpdateRequest;
use App\Order;

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

        // to invoices table
        $invoice = $offer->invoices()->create();

        // to offer_progress table
        $offer->progress()->create([
            'progress' => $request->progress,
            'status' => 'Funnel',
        ]);

        foreach ($request->modality as $i => $v) {
            // to table orders
            Order::insert([
                'invoice_id' => $invoice->id,
                'modality_id' => $request->modality[$i],
                'price' => str_replace(".", "", $request->price[$i]),
                'references' => $request->references[$i],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }

        // assign to funnel slug
        $attr['slug'] = Str::slug($request->description . ' ' . date('YmdHis'));
        // insert into funnels table
        $offer->funnel()->create($attr);


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
        $modalities = Modality::orderBy('name', 'asc', 'price')->get();

        return view('funnels.edit', compact('offer', 'funnel', 'count', 'modalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function update(FunnelUpdateRequest $request, Funnel $funnel)
    {
        $attr = $request->all();

        foreach ($funnel->offer->invoices->last()->orders as $i => $order) {
            // to table orders
            $order->update([
                'modality_id' => $request->modality[$i],
                'price' => str_replace(".", "", $request->price[$i]),
                'references' => $request->references[$i],
                'updated_at' => now()->toDateTimeString(),
            ]);
        }

        // assign to funnel slug
        // insert into funnels table
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
