<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Customer;
use App\Hospital;
use App\Http\Requests\VisitRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index()
    {
        $visits =  Visit::with('customer')->latest()->paginate(10);
        return view('visits.index', [
            'visits' => $visits,
        ]);
    }

    public function show(Visit $visit)
    {
        return view('visits.show', compact('visit'));
    }

    public function create()
    {
        $customers = Customer::select(['id', 'name'])->orderBy('name', 'asc')->get();
        return view('visits.create', [
            'visit' => new Visit(),
            'customers' => $customers,
        ]);
    }

    public function store(VisitRequest $request)
    {
        // validate input
        $attr = $request->all();

        // assignt name to slug
        $attr['slug'] = Str::slug(request('request'));
        $attr['customer_id'] =  request('customer');
        $attr['username'] = Auth::user()->username;

        Visit::create($attr);


        // alert success
        session()->flash('success', 'Kunjungan Berhasil di Buat!');

        return redirect('visits');
    }

    public function add()
    {
        return view('visits.add', [
            'customer' => new Customer(),
            'hospitals' => Hospital::select(['id', 'name', 'city'])->orderBy('name', 'asc')->get(),

        ]);
    }

    public function addStore(VisitRequest $request)
    {
        // validate input
        $attr = $request->all();
        // assignt name to slug

        // manually add customer id
        $customer_id = Customer::latest('id')->first()->id + 1;

        // to customers table
        $attr['id'] = $customer_id;
        $attr['hospital_id'] = request('hospital');
        $attr['slug'] = Str::slug(request('name'));
        $attr['username'] = Auth::user()->username;
        Customer::create($attr);



        // to visits table
        $attr2['slug'] = Str::slug(request('request'));
        $attr2['customer_id'] =  $customer_id;
        Visit::create($attr2);






        // alert success
        session()->flash('success', 'Kunjungan Baru Berhasil di Buat!');

        return redirect('visits');
        // return back();
    }

    public function edit(Visit $visit)
    {
        return view('visits.edit', compact('visit'));
    }

    public function update(VisitRequest $request, Visit $visit)
    {
        $attr = $request->all();

        $visit->update($attr);

        // alert success
        session()->flash('success', 'Kunjungan Berhasil di Update!');

        return redirect('visits');
    }




    public function destroy(Visit $visit)
    {
        $visit->delete();
        session()->flash('success', 'data berhasil di hapus!');
        return redirect('visits');
    }
}
