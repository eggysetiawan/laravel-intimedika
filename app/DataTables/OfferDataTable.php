<?php

namespace App\DataTables;

use App\Offer;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OfferDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('offer_no', function (Offer $offer) {
                if ($offer->slug) {
                    return view('offers.partials.offer_no', [
                        'offer' => $offer
                    ]);
                }
            })
            ->editColumn('action', function (Offer $offer) {
                if ($offer->slug) {
                    return view('offers.partials.action', [
                        'offer' => $offer
                    ]);
                }
            })
            ->editColumn('invoices.orders.references', function (Offer $offer) {
                return $offer->invoices->first()->orders->first()->references;
            })
            ->editColumn('customer.hospitals.name', function (Offer $offer) {
                return $offer->customer->hospitals->first()->name ?? $offer->customer->name;
            })
            ->editColumn('offer_date', function (Offer $offer) {
                return date('d/m/Y', strtotime($offer->offer_date));
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Offer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Offer $model)
    {

        return $model->query()
            ->with('customer.hospitals', 'author', 'invoices.orders')
            ->when($this->to, function ($query) {
                return $query->whereBetween('offer_date', [$this->from, $this->to]);
            })
            ->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('offer-table')
            ->minifiedAjax()
            ->parameters([
                'stateSave' => true,
                'dom'          => 'Blfrtip',
                'buttons'      => ['excel', 'print', 'reset'],
                'order'   => [[0, 'desc']],
                'lengthMenu' => [
                    [10, 25, 50, 100],
                    ['10', '25', '50', '100']
                ],
            ])
            ->columns($this->getColumns())
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // No.
            Column::make('DT_RowIndex')->title('No.')->orderable(false)->searchable(false),

            // action button (approve/reject)
            Column::computed('action')
                ->searchable(false)
                ->orderable(false)
                ->printable(false)
                ->exportable(false),

            // no.penawaran
            Column::make('offer_no')
                ->title('No. Penawaran'),

            // customer
            Column::make('customer.hospitals.name')->title('Customer/Rumah Sakit'),
            Column::make('customer.name')->title('Customer')
                ->orderable(false)
                ->visible(false),

            // tanggal penawaran
            Column::make('offer_date')->title('Tgl. Penawaran'),

            // referensi
            Column::make('invoices.orders.references')->title('Referensi')
                ->searchable(true)
                ->orderable(false),

            // nama sales
            Column::make('author.name')->title('Sales'),

        ];
    }



    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Offer_' . date('YmdHis');
    }
}
