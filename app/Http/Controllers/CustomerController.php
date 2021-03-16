<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DataTables\CustomerDataTable;
use App\Hospital;
use Illuminate\Support\Str;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('customers.index');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }
    public function create()
    {
        return view('customers.create', [
            'customer' => new Customer(),
            'hospitals' => Hospital::selectHospitalLimit()
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
        $hospitals = Hospital::selectHospitalLimit();
        return view('customers.edit', compact('customer', 'hospitals'));
        // return 'hola';
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $attr = $request->all();
        $attr['hospital_id'] = request('hospital');
        $customer->update($attr);

        // alert success
        session()->flash('success', 'Customer Berhasil di Update!');

        return redirect('customers');
    }
}
