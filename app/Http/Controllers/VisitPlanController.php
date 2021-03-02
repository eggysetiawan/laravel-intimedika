<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Hospital;
use App\VisitPlan;
use Illuminate\Support\Str;
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
                ->whereNotNull('name')
                ->get(),

            'visit' => new Visit(),
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

        $visit->plan()->create($attr);
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
        $visitplan = $visit->plan;

        return view('visitplan.edit', compact('visit', 'visitplan', 'customer'));
    }


    public function update(VisitPlanRequest $request, Visit $visit)
    {
        $attr = $request->all();
        $visit->customer()->update($attr);
        $visit->plan()->update($attr);
        // alert success
        session()->flash('success', 'Rencana Kunjungan telah berhasil di edit!');

        return redirect()->route('visitplan.index');
    }


    public function destroy($id)
    {
        //
    }
}
