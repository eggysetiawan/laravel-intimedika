<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Customer;
use App\DataTables\VisitDataTable;
use App\Hospital;
use Illuminate\Support\Str;
use App\Http\Requests\VisitRequest;
use Illuminate\Support\Facades\Storage;

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
        $customers = Customer::whereHas('hospitals')
            ->select(['id', 'name'])
            ->orderBy('name', 'asc')
            ->get();

        return view('visits.create', [
            'visit' => new Visit(),
            'customers' => $customers,
        ]);
    }

    public function store(VisitRequest $request)
    {
        // validate input
        $attr = $request->all();

        // assign to slug
        $timestamp = date('Y-m-d-H-i-s');
        $slug = Str::slug(request('request') . ' ' . $timestamp);
        $attr['slug'] = $slug;

        // customer_id
        $attr['customer_id'] = request('customer');

        // insert
        auth()
            ->user()
            ->visits()
            ->create($attr);

        // alert success
        session()->flash('success', 'Kunjungan Berhasil di Buat!');

        return redirect('visits');
    }

    public function add()
    {
        return view('visits.add', [
            'customer' => new Customer(),
            'hospitals' => Hospital::select(['id', 'name', 'city'])
                ->orderBy('name', 'asc')
                ->where('name', '!=', '')
                ->take(1000)
                ->get(),
        ]);
    }

    public function addStore(VisitRequest $request)
    {
        // validate input
        $attr = $request->all();

        // assignt name to slug
        $attr['slug'] = Str::slug(request('name') . ' ' . request('role'));

        $attr['user_id'] = auth()->id();
        $customer = Customer::create($attr);
        $customer->hospitals()->attach(request('hospital'));


        // assign to slug (slug = name-hospitalname)
        $timestamp = date('Y-m-d-H-i-s');
        $slug = Str::slug(request('request') . ' ' . $timestamp);

        $attr['slug'] = $slug;
        $attr['customer_id'] = $customer->id;
        $visit = auth()->user()->visits()->create($attr);

        if (request('img')) :
            $imgSlug = $slug . '.' . request()->file('img')->extension();

            $visit
                ->addMediaFromRequest('img')
                ->usingFileName($imgSlug)
                ->toMediaCollection('images');
        endif;

        // alert success
        session()->flash('success', 'Kunjungan Baru Berhasil di Buat!');

        return redirect('visits');
    }

    public function edit(Visit $visit)
    {
        return view('visits.edit', compact('visit'));
    }

    public function update(VisitRequest $request, Visit $visit)
    {
        $this->authorize('update', $visit);

        if (request()->file('img')) :
            Storage::delete($visit->image);
            $img = request()
                ->file('img')
                ->store('images/visits');
        else :
            $img = $visit->image;
        endif;

        $attr = $request->all();
        $attr['image'] = $img;
        $visit->update($attr);

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
