<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Hospital;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\DataTables\CustomerDataTable;
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
        ]);
    }
    public function create2()
    {
        return view('customers.create', [
            'customer' => new Customer(),
            'nohospital' => '1',
            'create' => true
        ]);
    }

    public function store(CustomerRequest $request)
    {
        DB::transaction(function () use ($request) {
            $attr = $request->all();
            dd($request->hospital);
            // assignt name to slug (slug = name-role)
            $attr['slug'] = Str::slug(request('name') . ' ' . request('role'));
            $nohospital = (@request('hospital') == 'false') ? true : false;

            if ($nohospital) {
                auth()->user()->customers()->create($attr);
            }

            if (!$nohospital) {
                $customer = auth()->user()->customers()->create($attr);
                $customer->hospitals()->attach(request('hospital'));
            }
        });

        session()->flash('success', 'Customer Baru Berhasil di Buat!');
        return redirect('customers');
    }

    public function edit(Customer $customer)
    {
        $hospitals = Hospital::selectHospitalLimit();

        if ($customer->doesntHave('hospitals')) {
            $nohospital = true;
        } else {
            $customer->load('hospitals');
            $nohospital = false;
        }


        $create = null;

        return view('customers.edit', compact('customer', 'hospitals', 'nohospital', 'create'));
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
