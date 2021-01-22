<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Customer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with('customer', 'author')
            ->latest()
            ->paginate(5);

        return view('offers.index', compact('offers'));
    }

    public function create()
    {
        $customers = Customer::whereHas('hospitals')
            ->select(['id', 'name'])
            ->orderBy('name', 'asc')
            ->get();
        return view('offers.create', [
            'offer' => new Offer(),
            'customers' => $customers,
            'routes' => 'offers.create-cust',
        ]);
    }
    public function createCust()
    {
        $customers = Customer::doesntHave('hospitals')
            ->select(['id', 'name'])
            ->orderBy('name', 'asc')
            ->get();
        return view('offers.create', [
            'offer' => new Offer(),
            'customers' => $customers,
            'routes' => 'offers.create',
        ]);
    }
}
