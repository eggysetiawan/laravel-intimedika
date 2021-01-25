<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Customer;
use App\Hospital;
use Illuminate\Support\Str;
use App\Http\Requests\VisitRequest;
use Illuminate\Support\Facades\Storage;

class VisitController extends Controller
{
    public function index()
    {
        if (auth()->user()->level == 'top') :
            $visits = Visit::with('customer', 'author')
                ->latest()
                ->paginate(10);
        else :
            $visits = Visit::with('customer', 'author')
                ->latest()
                ->where('user_id', auth()->id())
                ->paginate(10);
        endif;

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

        $imgSlug = $slug . '.' . request()->file('img')->extension();

        $visit
            ->addMediaFromRequest('img')
            ->usingFileName($imgSlug)
            ->toMediaCollection('images');

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
}
