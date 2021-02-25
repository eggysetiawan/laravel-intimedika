<?php

namespace App\Http\Controllers;

use App\User;
use App\Modality;
use App\DataTables\OfferDataTable;
use App\Http\Requests\OfferRequest;
use App\Mail\Offer\CreateOfferEmail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewOfferNotification;
use App\{Offer, Order, Invoice, Customer, OfferProgress};
use App\Notifications\CreateOffer;
use App\Notifications\Offer\NewOfferNotification as OfferNewOfferNotification;

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

    public function completed(OfferDataTable $dataTable)
    {
        return $dataTable
            ->with([
                'complete' => true,
            ])
            ->render('offers.index', [
                'tableHeader' => 'Penawaran Berhasil',
                'approval' => 0
            ]);
    }
    public function approval(OfferDataTable $dataTable)
    {
        return $dataTable
            ->with([
                'approval' => true,
            ])
            ->render('offers.index', [
                'tableHeader' => 'Ready to Approve',
                'approval' => Offer::whereNull('is_approved')->count(),
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


        // to invoices table
        $invoice = Invoice::create([
            'offer_id' => $offer->id,
            'date' => $date,
        ]);

        // to offer_progress table
        OfferProgress::create([
            'offer_id' => $offer->id,
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

        // Mail::to("setiawaneggy@gmail.com")->send(new CreateOfferEmail($offer));
        // $admin = User::where('id', 13)->first();
        // $admin->notify(new OfferNewOfferNotification($offer));

        session()->flash('success', 'Penawaran telah berhasil dibuat!');
        return redirect('offers');
    }

    public function destroy(Offer $offer)
    {
        $this->authorize('delete', $offer);
        $offer->delete();

        session()->flash('success', 'data telah berhasil di hapus!');
        return redirect('offers');
    }
}
