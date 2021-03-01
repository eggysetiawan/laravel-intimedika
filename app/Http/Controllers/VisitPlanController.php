<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Hospital;
use App\VisitPlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\VisitDataTable;
use App\Http\Requests\VisitPlanRequest;
use App\Http\Requests\VisitRequest;
use App\Visit;

class VisitPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VisitDataTable $dataTable)
    {
        return $dataTable
            ->with([
                'plan' => true,
            ])
            ->render('visits.index', [
                'tableHeader' => 'Table Rencana Kunjungan',
                'caption' => 'Rencana Kunjungan',
            ]);
    }


    public function create()
    {
        return view('visitplan.create', [
            'hospitals' => Hospital::select(['id', 'name', 'city'])
                ->orderBy('name', 'asc')
                ->where('name', '!=', '')
                ->get(),

            'visitplan' => new VisitPlan(),
            'customer' => new Customer(),
            'cardHeader' => 'Buat Rencana Kunjungan',
        ]);
    }


    public function store(VisitPlanRequest $request)
    {
        $attr = $request->all();
        $attr['slug'] = Str::slug(request('name') . '_' . date('Y-m-d H:i:s'));
        $customer = auth()->user()->customers()->create($attr);
        $customer->hospitals()->attach(request('hospital'));

        $attr['customer_id'] = $customer->id;

        $visit = auth()->user()->visits()->create($attr);

        $visit->plans()->create($attr);
        // alert success
        session()->flash('success', 'Rencana Kunjungan telah berhasil di buat!');

        return redirect()->route('visitplan.index');
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        $customer = $visit->customer;
        $hospitals = Hospital::select(['id', 'name', 'city'])
            ->orderBy('name', 'asc')
            ->where('name', '!=', '')
            ->get();
        return view('visitplan.edit', compact('visit', 'customer', 'hospitals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VisitRequest $request, Visit $visit)
    {
        $attr = $request->all();
        $visit->update($attr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
