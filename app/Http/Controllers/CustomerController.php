<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Customer;
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

    public function store()
    {
        // validate input
        $attr = $this->validateRequest();

        // assignt name to slug
        $attr['slug'] = Str::slug(request('name'));
        $customers = Customer::latest('id')->first();
        $customer_id = $customers->id + 1;
        $attr['id'] = $customer_id;
        $attr['username'] = Auth::user()->username;
        $attr['role'] = request('role');
        $attr['email'] = request('email');


        Customer::create($attr);


        // alert success
        session()->flash('success', 'Customer Baru Berhasil di Buat!');

        return redirect('customers');
        // return back();
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Customer $customer)
    {
        $attr = $this->validateRequest();

        $customer->update($attr);

        // alert success
        session()->flash('success', 'Customer Berhasil di Update!');

        return redirect('customers');
    }

    public function validateRequest()
    {
        return request()->validate(
            [
                'role' => 'required',
                'email' => 'required',
                'name' => 'required',
                'mobile' => 'required',
            ],
            // costumizing error message (optional)
            [
                'role.required' => 'Jabatan wajib diisi!',
                'email.required' => 'Email wajib diisi!',
                'name.required' => 'Nama wajib diisi!',
                'mobile.required' => 'Nomor Hp wajib diisi!',
            ]
        );
    }
}
