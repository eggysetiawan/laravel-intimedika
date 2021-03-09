<?php

namespace App\Http\Controllers;

use App\Modality;
use App\DataTables\OfferDataTable;
use App\Http\Requests\OfferRequest;
use App\{Offer, Order, Customer};
use App\Events\OfferCreated;
use App\Http\Requests\UpdateOfferRequest;

class OfferController extends Controller
{
    public function index(OfferDataTable $dataTable, Offer $offer)
    {
        return $dataTable->render('offers.index', [
            'approval' => 0,
            'offer_approval_count' => $offer
                ->with(['customer.hospitals', 'author', 'invoices.orders', 'progress.demo', 'invoices.tax'])
                ->whereNull('is_approved')
                ->count(),
        ]);
    }

    public function trash(OfferDataTable $dataTable)
    {
        return $dataTable->with([
            'trash' => true,
        ])
            ->render('offers.index', [
                'approval' => 0,
                'tableHeader' => 'Penawaran (Dihapus)',
            ]);
    }

    public function create()
    {
        $customers = Customer::with('hospitals')
            ->orderBy('name', 'asc')
            ->get();

        if (!request('count')) :
            $offers = Offer::with('customer', 'author')
                ->latest()
                ->paginate(5);
            return view('offers.index', compact('offers'));
        else :
            return view('offers.create', [
                'offer' => new Offer(),
                'customers' => $customers,
                'modalities' => Modality::orderBy('name', 'asc', 'price')->get(),
                'count' => request('count'),
                'max' => Offer::where(function ($query) {
                    $maxYear = $query->max('offer_date');
                    return $query->where('offer_date', $maxYear);
                })
                    ->max('offer_no'),
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

        $attr['year'] = $tahun;
        $attr['offer_no'] = 'Q-' . $queue . '/IPI/' . $initial . '/' . $bln . '/' . $tahun;
        $attr['slug'] = 'Q-' . $queue . '-IPI-' . $initial . '-' . $bln . '-' . $tahun;


        $date = date('Y-m-d', strtotime($request->date));
        $attr['offer_date'] = $date;
        $attr['customer_id'] = request('customer');
        $offer = auth()->user()->offers()->create($attr);

        // to invoices table
        $invoice = $offer->invoices()->create([
            'date' => $date,
        ]);

        // to offer_progress table
        $offer->progress()->create([
            'progress' => 30,
            'progress_date' => $date,
            'status' => 'On Progress',
        ]);

        foreach ($request->modality as $i => $v) {
            // to table orders
            Order::insert([
                'invoice_id' => $invoice->id,
                'modality_id' => $request->modality[$i],
                'price' => str_replace(".", "", $request->price[$i]),
                'references' => $request->references[$i],
                'created_at' => $date,
                'updated_at' => $date,
            ]);
            // alert success
        }

        // send mail to admin via event & listener
        event(new OfferCreated($offer));


        session()->flash('success', 'Penawaran telah berhasil dibuat!');
        return redirect('offers');
    }

    public function edit(Offer $offer)
    {
        $customers = Customer::with('hospitals')
            ->orderBy('name', 'asc')
            ->get();
        $modalities = Modality::orderBy('name', 'asc', 'price')->get();

        return view('offers.edit', compact('offer', 'customers', 'modalities'));
    }

    public function destroy(Offer $offer)
    {
        $this->authorize('delete', $offer);
        $offer->delete();

        session()->flash('success', 'data telah berhasil di hapus!');
        return redirect('offers');
    }
}
