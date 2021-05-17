<?php

namespace App\Http\Controllers;

use App\User;
use App\Services\ChartService;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Penjualan Sales per Bulan',
            'chart_type' => 'line',
            'report_type' => 'group_by_string',
            'model' => 'App\OrderChart',
            'date_format' => 'Y-m-d',
            'group_by_field' => 'offer_date', //represent $order->invoice->offer->offer_date
            'group_by_period' => 'month',
            'continuous_time' => true,
            'aggregate_function' => 'sum',
            'aggregate_field' => 'price',


            'conditions'            => [
                ['name' => 'Last Year', 'condition' => 'year = 2020', 'color' => 'blue', 'fill' => true],
                ['name' => 'This Year', 'condition' => 'year = 2021', 'color' => 'green', 'fill' => true],
            ],

            'filter_field' => 'offer_date',
            'filter_days' => 364, // show only transactions for last 30 days
            'filter_period' => 'month', // show only transactions for this week
        ];
        $chart1 = new LaravelChart($chart_options);



        $allsales = User::query()
            ->where('position', 'sales')
            ->whereHas('charts')
            ->get();
        $charts = [];

        foreach ($allsales as $sales) {
            $charts[] = (new ChartService())->sales_chart($sales);
        }

        $user = auth()->user();
        $name = $user->name;
        $offers = $user->offers[0]->invoices[0]->orders[0]->price ?? '0';
        $targets = $user->targets[0]->target ?? '0';

        $percentage = $offers == 0 || $targets == 0 ? '0' : $offers / $targets * 100;

        return view('home', compact('chart1', 'charts', 'name', 'offers', 'percentage', 'targets'));
    }
}
