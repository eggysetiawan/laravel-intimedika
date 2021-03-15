<?php

namespace App\Services;

use App\Customer;
use Illuminate\Support\Str;

class VisitAddService
{
    private $customer, $visit;

    public function slug()
    {
        $timestamp = date('Y-m-d-H-i-s');
        return Str::slug(request('request') . ' ' . $timestamp);
    }

    public function createCustomer($request)
    {
        // validate input
        $attr = $request->all();

        // assignt name to slug
        $attr['slug'] = Str::slug(request('name') . ' ' . request('role'));

        $attr['user_id'] = auth()->id();
        return $this->customer = Customer::create($attr);
    }

    public function attachHospital()
    {
        return $this->customer->hospitals()->attach(request('hospital'));
    }

    public function addVisit($request)
    {
        $attr = $request->all();

        $timestamp = date('Y-m-d-H-i-s');
        $slug = Str::slug(request('request') . ' ' . $timestamp);
        $attr['slug'] = $slug;

        // insert into table visits
        $attr['customer_id'] = $this->customer->id;
        $attr['is_visited'] = 1;
        return $this->visit = auth()->user()->visits()->create($attr);
    }

    public function uploadImage()
    {
        $imgSlug = $this->slug() . '.' . request()->file('img')->extension();
        return $this->visit
            ->addMediaFromRequest('img')
            ->usingFileName($imgSlug)
            ->toMediaCollection('images');
    }
}
