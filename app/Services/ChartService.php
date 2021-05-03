<?php

namespace App\Services;

use App\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ChartService
{

    public function all_sales_chart()
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
        return new LaravelChart($chart_options);
    }

    public function sales_chart($sales)
    {

        $chart_options = [
            'chart_title' => 'Penjualan ' . $sales->name . ' per bulan',
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
                ['name' => 'Last Year', 'condition' => 'user_id = ' . $sales->id . ' AND year = 2020', 'color' => 'blue', 'fill' => true],
                ['name' => 'This Year', 'condition' => 'user_id = ' . $sales->id . '  AND year = 2021', 'color' => 'green', 'fill' => true],
            ],

            'filter_field' => 'offer_date',
            'filter_days' => 364, // show only transactions for last 30 days
            'filter_period' => 'month', // show only transactions for this week
        ];
        return new LaravelChart($chart_options);
    }
}
