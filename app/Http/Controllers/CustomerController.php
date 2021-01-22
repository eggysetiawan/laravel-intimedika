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
            $customers = Customer::with('author', 'visits', 'hospitals')
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
        return view('customers.show', compact('customer'));
    }
    public function create()
    {
        return view('customers.create', [
            'customer' => new Customer(),
            'hospitals' => Hospital::select('id', 'name', 'city')->orderBy('name', 'asc')->where('name', '!=', '')->get()
        ]);
    }
    public function create2()
    {
        return view('customers.create', [
            'customer' => new Customer(),
            'nohospital' => '1',
        ]);
    }

    public function store(CustomerRequest $request)
    {
        // validate input
        $attr = $request->all();

        // assignt name to slug (slug = name-role)
        $attr['slug'] = Str::slug(request('name') . ' ' . request('role'));
        $nohospital = (@request('hospital') == 'false') ? true : false;

        if ($nohospital) :
            auth()->user()->customers()->create($attr);

        else :
            $customer = auth()->user()->customers()->create($attr);
            $customer->hospitals()->attach(request('hospital'));
        endif;



        // alert success
        session()->flash('success', 'Customer Baru Berhasil di Buat!');

        return redirect('customers');
    }

    public function edit(Customer $customer)
    {
        $hospitals = Hospital::select(['id', 'name', 'city'])
            ->orderBy('name', 'asc')
            ->where('name', '!=', '')
            ->get();
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
