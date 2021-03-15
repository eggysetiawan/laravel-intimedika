<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Customer;
use App\DataTables\VisitDataTable;
use Illuminate\Support\Str;
use App\Http\Requests\VisitRequest;
use App\Services\VisitService;

class VisitController extends Controller
{
    public function index(VisitDataTable $dataTable)
    {
        return $dataTable->render('visits.index');
    }

    public function show(Visit $visit)
    {
        return view('visits.show', [
            'visit' => $visit,
        ]);
    }

    public function create()
    {
        return view('visits.create', [
            'visit' => new Visit(),
            'customers' => Customer::selectCustomer(),
        ]);
    }

    public function store(VisitRequest $request, VisitService $visitService)
    {
        $visitService->create($request);
        // alert success
        session()->flash('success', 'Kunjungan Berhasil di Buat!');
        return redirect('visits');
    }

    public function edit(Visit $visit)
    {
        return view('visits.edit', compact('visit'));
    }

    public function update(VisitRequest $request, Visit $visit, VisitService $visitService)
    {
        $this->authorize('update', $visit);
        $visitService->update($request, $visit);
        // alert success
        session()->flash('success', 'Kunjungan Berhasil di Update!');
        return redirect('visits');
    }

    public function destroy(Visit $visit)
    {
        $this->authorize('delete', $visit);
        $visit->delete();
        session()->flash('success', 'data berhasil di hapus!');
        return redirect('visits');
    }

    public function trash(VisitDataTable $dataTable)
    {
        return $dataTable->with(['trash' => true,])
            ->render('visits.index', [
                'tableHeader' => 'Table Kunjungan (Dihapus)',
            ]);
    }

    public function restore(Visit $visit)
    {
        if ($visit->trashed()) {
            $visit->restore();
        }
        session()->flash('success', 'data berhasil di restore!');

        return back();
    }
}
