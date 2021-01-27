<?php

namespace App\Http\Controllers;

use App\{Offer, Order, Invoice, Customer};
use App\Modality;
use App\Http\Requests\OfferRequest;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $offers = Offer::with('customer', 'author')
            ->get();

        if ($request->ajax()) {
            return datatables()
                ->of($offers)
                ->addIndexColumn()
                ->editColumn('offer_no', function ($item) {
                    return '<a href="'.route('invoices.order', $item->slug).'">'.$item->offer_no.'</a>';
                })
                ->rawColumns(['action', 'time_passed', 'offer_no'])
                ->make(true);
        }

        return view('offers.index');
    }

    public function create()
    {
        $customers = Customer::whereHas('hospitals')
            ->orderBy('name', 'asc')
            ->get();
        $attr = [
            'routes' => 'offers.create-cust',
            'icon' => 'RS',
            'color' => 'bg-maroon',
        ];
        if (!request('count')) :
            $offers = Offer::with('customer', 'author')
                ->latest()
                ->paginate(5);
            return view('offers.index', compact('offers'));
        else :
            return view('offers.create', [
                'offer' => new Offer(),
                'customers' => $customers,
                'attr' => $attr,
                'modalities' => Modality::orderBy('name', 'asc', 'price')->get(),
                'count' => request('count'),
            ]);
        endif;
    }
    public function createCust()
    {
        $customers = Customer::doesntHave('hospitals')
            ->select(['id', 'name'])
            ->orderBy('name', 'asc')
            ->get();
        $attr = [
            'routes' => 'offers.create',
            'icon' => 'PT',
            'color' =>  'bg-indigo',
        ];

        if (!request('count')) :
            $offers = Offer::with('customer', 'author')
                ->latest()
                ->paginate(5);
            return view('offers.index', compact('offers'));
        else :
            return view('offers.create', [
                'offer' => new Offer(),
                'customers' => $customers,
                'attr' => $attr,
                'modalities' => Modality::orderBy('name', 'asc', 'price')->get(),
                'count' => request('count'),
            ]);
        endif;
    }

    public function store(OfferRequest $request)
    {


        // convert month romawi
        $attr = $request->all();
        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

        // offer_no
        $queue = str_pad($request->queue, 3, '0', STR_PAD_LEFT);
        // acronym
        $initial = auth()->user()->initial;
        $bln = $array_bln[date('n', strtotime($request->date))];
        $tahun = date('Y', strtotime($request->date));
        $attr['offer_no'] = 'Q-' . $queue . '/IPI/' . $initial . '/' . $bln . '/' . $tahun;
        $attr['slug'] = 'Q-' . $queue . '-IPI-' . $initial . '-' . $bln . '-' . $tahun;


        $date = date('Y-m-d', strtotime($request->date));
        $attr['offer_date'] = $date;
        $attr['customer_id'] = request('customer');
        $offer = auth()->user()->offers()->create($attr);

        // to table invoices
        $invoice = Invoice::create([
            'offer_id' => $offer->id,
            'date' => $date,
        ]);

        foreach ($request->modality as $i => $v) {
            // to table orders
            Order::insert([
                'invoice_id' => $invoice->id,
                'modality_id' => $request->modality[$i],
                'price' => $request->price[$i],
                'quantity' => $request->quantity[$i],
                'references' => $request->references[$i],
            ]);
            // alert success
        }


        session()->flash('success', 'Penawaran berhasil dibuat!');
        return redirect('offers');
    }
}
