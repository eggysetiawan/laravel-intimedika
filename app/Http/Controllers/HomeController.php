<?php

namespace App\Http\Controllers;

use App\User;
use App\Services\ChartService;
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
        $chart1 = (new ChartService())->all_sales_chart();
        $chart = (new ChartService())->loggedInChart();

        $allsales = User::salesChart();
        $charts = [];
        foreach ($allsales as $sales) {
            $charts[] = (new ChartService())->sales_chart($sales);
        }

        $user = auth()->user();
        $offers = $user->offers[0]->invoices[0]->orders[0]->price ?? '0';
        $targets = $user->targets[0]->target ?? '0';

        $percentage = $offers == 0 || $targets == 0 ? '0' : $offers / $targets * 100;

        return view('home', compact('chart1', 'charts', 'offers', 'percentage', 'targets', 'chart'));
    }
}
