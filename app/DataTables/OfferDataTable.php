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
            ->editColumn('demo.description', function (Offer $offer) {
                if ($offer->slug) {
                    return view('offers.partials.demodescription', [
                        'offer' => $offer
                    ]);
                }
            })
            ->editColumn('progressbar', function (Offer $offer) {
                return view('progress.partials.progress', [
                    'offer' => $offer
                ]);
            })
            ->editColumn('action', function (Offer $offer) {
                if ($offer->slug) {
                    return view('offers.partials.action', [
                        'offer' => $offer
                    ]);
                }
            })
            ->editColumn('customer.hospitals.name', function (Offer $offer) {
                return $offer->customer->hospitals->first()->name ?? $offer->customer->name;
            })
            ->editColumn('invoices.orders.references', function (Offer $offer) {
                $orders = $offer->invoices->last()->orders;
                $references = array();
                foreach ($orders as $order) :
                    $references[] = $order->references;
                endforeach;
                return join(" & ", array_unique($references));
            })
            ->editColumn('offer_date', function (Offer $offer) {
                return date('d-m-Y', strtotime($offer->offer_date));
            })
            ->editColumn('invoices.tax.price_po', function (Offer $offer) {
                return $offer->invoices->last()->tax->price_po ?? '';
            })
            ->editColumn('invoices.tax.dpp', function (Offer $offer) {
                return $offer->invoices->last()->tax->dpp ?? '';
            })
            ->editColumn('invoices.tax.ppn', function (Offer $offer) {
                return $offer->invoices->last()->tax->ppn ?? '';
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
            ->with(['customer.hospitals', 'author', 'invoices.orders', 'progress.demo', 'invoices.tax'])
            ->when($this->from && $this->to, function ($query) { //query untuk filter periode from ~ to.
                return $query->whereBetween('offer_date', [$this->from, $this->to]);
            })
            ->when(!auth()->user()->isAdmin(), function ($query) { //jika bukan admin, tampilkan hanya penawaran milik masing2 sales.
                return $query->where('user_id', auth()->id());
            })
            ->when($this->complete, function ($query) { // menu penawaran berhasil.
                return $query->whereHas('progress', function ($query) {
                    return $query->where('progress', 100);
                });
            })
            ->when($this->approval, function ($query) { //menu approve penawaran.
                return $query->whereNull('offers.is_approved');
            })
            ->when($this->approval_po, function ($query) { //menu approval purchase order.
                return $query->whereHas('progress', function ($query) {
                    return $query->where('progress', 99);
                });
            })
            ->when($this->trash, function ($query) { //menu restore.
                return $query->onlyTrashed();
            })
            ->whereNotNull('offer_no') //hanya tampilkan penawaran resmi, bukan funnel plan.
            ->latest(); //order berdasarkan data terbaru.
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
            ->language([
                'processing' => '<div class="spinner">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>',
                'loadingRecords' => '<div class="spinner">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>',
            ])
            ->columns($this->getColumns());
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
            Column::make('DT_RowIndex')
                ->title('No.')
                ->orderable(false)
                ->searchable(false)
                ->width(20),

            // action button (approve/reject)
            Column::computed('action')
                ->searchable(false)
                ->orderable(false)
                ->printable(false)
                ->exportable(false)
                ->width(20),

            // no.penawaran
            Column::make('offer_no')
                ->title('No. Penawaran'),

            // customer
            Column::make('customer.hospitals.name')
                ->title('Customer/Rumah Sakit')
                ->orderable(false),
            Column::make('customer.name')->title('Customer')
                ->orderable(false)
                ->visible(false)
                ->printable(false)
                ->exportable(false),

            // progress
            Column::computed('progressbar')
                ->title('Progress')
                ->searchable(false)
                ->orderable(false)
                ->printable(false)
                ->exportable(false),


            // tanggal penawaran
            Column::make('offer_date')
                ->title('Tgl. Penawaran')
                ->width(50),

            // progress searchable
            Column::make('progress.progress')
                ->searchable(true)
                ->printable(false)
                ->exportable(false)
                ->visible(false),

            Column::make('progress.detail')
                ->title('Keterangan')
                ->orderable(false),

            // nama sales
            Column::make('author.name')->title('Sales')
                ->orderable(false),

            // referensi
            Column::make('invoices.orders.references')->title('Referensi')
                ->searchable(true)
                ->orderable(false),

            // harga purchase order (PO)
            Column::make('invoices.tax.price_po')
                ->title('Nilai Kontrak'),

            // dpp
            Column::make('invoices.tax.dpp')
                ->title('DPP'),

            // dpp
            Column::make('invoices.tax.ppn')
                ->title('PPN'),

            Column::computed('demo.description')
                ->title('Demo')
                ->orderable(false)
                ->searchable(false),
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
