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
            ->orderBy('name', 'asc')
            ->get();
        $attr = [
            'routes' => 'offers.create-cust',
            'icon' => 'RS',
            'color' => 'bg-maroon',
        ];
        return view('offers.create', [
            'offer' => new Offer(),
            'customers' => $customers,
            'attr' => $attr,
        ]);
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
        return view('offers.create', [
            'offer' => new Offer(),
            'customers' => $customers,
            'attr' => $attr
        ]);
    }
}
