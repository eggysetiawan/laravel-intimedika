<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Hospital;
use Illuminate\Support\Str;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    public function index()
    {

        if (auth()->user()->level == "top") :
            $customers = Customer::with('author', 'visits', 'hospital')
                ->latest()
                ->paginate(10);
        else :
            $customers = Customer::with('author', 'visits')
                ->latest()
                ->where('user_id', auth()->id())
                ->paginate(10);
        endif;

        return view('customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        return view('visits.index', compact('customer'));
    }
    public function create()
    {
        return view('customers.create', [
            'customer' => new Customer(),
            'hospitals' => Hospital::select('id', 'name', 'city')->orderBy('name', 'asc')->where('name', '!=', '')->get()
        ]);
    }

    public function store(CustomerRequest $request)
    {
        // validate input
        $attr = $request->all();

        // assignt name to slug (slug = name-role)
        $attr['slug'] = Str::slug(request('name') . ' ' . request('role'));
        $customers = Customer::latest('id')->first();
        $customer_id = $customers->id + 1;
        $attr['id'] = $customer_id;
        $attr['hospital_id'] = request('hospital');
        auth()->user()->customers()->create($attr);


        // alert success
        session()->flash('success', 'Customer Baru Berhasil di Buat!');

        return redirect('customers');
    }

    public function edit(Customer $customer)
    {
        $hospitals = Hospital::select(['id', 'name', 'city'])->orderBy('name', 'asc')->where('name', '!=', '')->get();
        return view('customers.edit', compact('customer', 'hospitals'));
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $attr = $request->all();
        $attr['hospital_id'] = request('hospital');
        $customer->update($attr);

        // alert success
        session()->flash('success', 'Customer Berhasil di Update!');

        return redirect('customers');
    }
}
