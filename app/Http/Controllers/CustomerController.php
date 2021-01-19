<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        $visits = $customer->visits()->paginate(10);
        return view('visits.index', compact('visits', 'customer'));
    }
    public function create()
    {
        return view('customers.create', [
            'customer' => new Customer(),
        ]);
    }

    public function store(CustomerRequest $request)
    {
        // validate input
        $attr = $request->all();

        // assignt name to slug
        $attr['slug'] = Str::slug(request('name'));
        $customers = Customer::latest('id')->first();
        $customer_id = $customers->id + 1;
        $attr['id'] = $customer_id;
        $attr['username'] = Auth::user()->username;



        Customer::create($attr);


        // alert success
        session()->flash('success', 'Customer Baru Berhasil di Buat!');

        return redirect('customers');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $attr = $request->all();

        $customer->update($attr);

        // alert success
        session()->flash('success', 'Customer Berhasil di Update!');

        return redirect('customers');
    }
}
