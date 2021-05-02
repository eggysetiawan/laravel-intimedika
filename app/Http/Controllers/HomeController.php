<?php

namespace App\Http\Controllers;

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
            'filter_days' => 366, // show only transactions for last 30 days
            'filter_period' => 'month', // show only transactions for this week
        ];
        $chart1 = new LaravelChart($chart_options);


        // Teten Sutendi
        $chart_options = [
            'chart_title' => 'Penjualan Teten per Bulan',
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
                ['name' => 'Last Year', 'condition' => 'sales_name = "Teten Sutendi" AND year = 2020', 'color' => 'blue', 'fill' => true],
                ['name' => 'This Year', 'condition' => 'sales_name = "Teten Sutendi" AND year = 2021', 'color' => 'green', 'fill' => true],
            ],

            'filter_field' => 'offer_date',
            'filter_days' => 366, // show only transactions for last 30 days
            'filter_period' => 'month', // show only transactions for this week
        ];
        $chart2 = new LaravelChart($chart_options);

        // M Saidi
        $chart_options = [
            'chart_title' => 'Penjualan M.Saidi per Bulan',
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
                ['name' => 'Last Year', 'condition' => 'sales_name = "Muhammad Saidi" AND year = 2020', 'color' => 'blue', 'fill' => true],
                ['name' => 'This Year', 'condition' => 'sales_name = "Muhammad Saidi" AND year = 2021', 'color' => 'green', 'fill' => true],
            ],

            'filter_field' => 'offer_date',
            'filter_days' => 366, // show only transactions for last 30 days
            'filter_period' => 'month', // show only transactions for this week
        ];
        $chart3 = new LaravelChart($chart_options);

        // Eka Ariandi
        $chart_options = [
            'chart_title' => 'Penjualan Eka Ariandi per Bulan',
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
                ['name' => 'Last Year', 'condition' => 'sales_name = "Eka Ariandi" AND year = 2020', 'color' => 'blue', 'fill' => true],
                ['name' => 'This Year', 'condition' => 'sales_name = "Eka Ariandi" AND year = 2021', 'color' => 'green', 'fill' => true],
            ],

            'filter_field' => 'offer_date',
            'filter_days' => 366, // show only transactions for last 30 days
            'filter_period' => 'month', // show only transactions for this week
        ];
        $chart4 = new LaravelChart($chart_options);

        // Fahmi Fadli
        $chart_options = [
            'chart_title' => 'Penjualan Fahmi per Bulan',
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
                ['name' => 'Last Year', 'condition' => 'sales_name = "M. Fahmi Fadli" AND year = 2020', 'color' => 'blue', 'fill' => true],
                ['name' => 'This Year', 'condition' => 'sales_name = "M. Fahmi Fadli" AND year = 2021', 'color' => 'green', 'fill' => true],
            ],

            'filter_field' => 'offer_date',
            'filter_days' => 366, // show only transactions for last 30 days
            'filter_period' => 'month', // show only transactions for this week
        ];
        $chart5 = new LaravelChart($chart_options);


        return view('home', compact('chart1', 'chart2', 'chart3', 'chart4', 'chart5'));
    }
}
