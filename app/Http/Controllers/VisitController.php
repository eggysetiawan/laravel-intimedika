<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Customer;
use App\Hospital;
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
    // public function add()
    // {
    //     return view('visits.create', [
    //         'visit' => new Visit(),
    //         'customers' => Customer::get(),
    //     ]);
    // }

    // pick function 1 or 2
    // function to insert data into the database (function 1)

    // public function store(Request $request)
    // {
    // validate input
    // $request->validate(
    //     [
    //         'name' => 'required',
    //         'result' => 'required',
    //     ],

    // costumizing error message (optional)
    //     [
    //         'name.required' => 'Nama wajib diisi!',
    //         'result.required' => 'Hasil kunjungan wajib diisi!',
    //     ]
    // );


    // pick 1 or 2
    // insert into table visit (1)

    // Visit::create([
    //     'name' => $request->name,
    //     'mobile' => $request->slug,
    //     'slug' => Str::slug($request->mobile),
    //     'result' => $request->result,
    // ]);

    // end insert into table visit



    // another way to insert (2)

    // $visit = $request->all();
    // $visit['slug'] = Str::slug($request->name);
    // Visit::create($visit);

    // end another way to insert

    // return redirect()->to('visits');
    // return back();
    // }

    // end function (1)



    // another way to store data into the database function (2)
    public function store()
    {
        // validate input
        $attr = $this->validateRequest();

        // assignt name to slug
        $attr['slug'] = Str::slug(request('request'));
        $attr['customer_id'] =  request('customer');
        $attr['username'] = Auth::user()->username;

        Visit::create($attr);


        // alert success
        session()->flash('success', 'Kunjungan Berhasil di Buat!');

        return redirect('visits');
        // return back();
    }

    public function add()
    {
        return view('visits.add', [
            'customer' => new Customer(),
            'hospitals' => Hospital::select(['id', 'name', 'city'])->orderBy('name', 'asc')->get(),

        ]);
    }

    public function addStore()
    {
        // validate input
        $attr = $this->validateRequest();
        $attr2 = $this->validateRequest2();

        // assignt name to slug
        $attr['slug'] = Str::slug(request('request'));
        $customers = Customer::latest('id')->first();
        $customer_id = $customers->id + 1;

        // to visits table
        $attr['customer_id'] =  $customer_id;
        $attr['username'] = Auth::user()->username;
        Visit::create($attr);

        // to customers table
        $attr2['id'] = $customer_id;
        $attr2['hospital_id'] = request('hospital');
        $attr2['slug'] = Str::slug(request('name'));
        $attr2['username'] = Auth::user()->username;
        $attr2['email'] = request('email');
        Customer::create($attr2);




        // alert success
        session()->flash('success', 'Kunjungan Baru Berhasil di Buat!');

        return redirect('visits');
        // return back();
    }

    public function edit(Visit $visit)
    {
        return view('visits.edit', compact('visit'));
    }

    public function update(Visit $visit)
    {
        $attr = $this->validateRequest();

        $visit->update($attr);

        // alert success
        session()->flash('success', 'Kunjungan Berhasil di Update!');

        return redirect('visits');
    }

    public function validateRequest()
    {
        return request()->validate(
            [
                'result' => 'required',
                'request' => 'required',
            ],
            // costumizing error message (optional)
            [
                'result.required' => 'Hasil kunjungan wajib diisi!',
                'request.required' => 'Permintaan kunjungan wajib diisi!',
            ]
        );
    }
    public function validateRequest2()
    {
        return request()->validate(
            [
                'name' => 'required',
                'mobile' => 'required',
                'role' => 'required',
            ],
            // costumizing error message (optional)
            [
                'name.required' => 'Nama wajib diisi!',
                'mobile.required' => 'Nomor Hp wajib diisi!',
            ]
        );
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();
        session()->flash('success', 'data berhasil di hapus!');
        return redirect('visits');
    }
}
