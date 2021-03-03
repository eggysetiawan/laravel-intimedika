<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Hospital;
use Illuminate\Support\Str;
use App\Http\Requests\VisitRequest;

class VisitAddController extends Controller
{

    public function create()
    {
        return view('visits.add', [
            'customer' => new Customer(),
            'hospitals' => Hospital::select(['id', 'name', 'city'])
                ->orderBy('name', 'asc')
                ->where('name', '!=', '')
                ->get(),
        ]);
    }


    public function store(VisitRequest $request)
    {
        // validate input
        $attr = $request->all();

        // assignt name to slug
        $attr['slug'] = Str::slug(request('name') . ' ' . request('role'));

        $attr['user_id'] = auth()->id();
        $customer = Customer::create($attr);
        $customer->hospitals()->attach(request('hospital'));


        // assign to slug
        $timestamp = date('Y-m-d-H-i-s');
        $slug = Str::slug(request('request') . ' ' . $timestamp);
        $attr['slug'] = $slug;

        // insert into table visits
        $attr['customer_id'] = $customer->id;
        $attr['is_visited'] = 1;
        $visit = auth()->user()->visits()->create($attr);

        // if any image, upload image to media table
        if (request('img')) :
            $imgSlug = $slug . '.' . request()->file('img')->extension();

            $visit
                ->addMediaFromRequest('img')
                ->usingFileName($imgSlug)
                ->toMediaCollection('images');
        endif;

        // alert success
        session()->flash('success', 'Kunjungan Baru Berhasil di Buat!');
        // redirect to index visits
        return redirect('visits');
    }
}
