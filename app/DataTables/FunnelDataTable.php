<?php

namespace App\DataTables;

use App\Funnel;
use App\Offer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FunnelDataTable extends DataTable
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
            ->editColumn('action', function (Funnel $funnel) {
                if ($funnel->slug) {
                    return view('funnels.partials.action', [
                        'funnel' => $funnel
                    ]);
                }
            })
            ->editColumn('progressbar', function (Funnel $funnel) {
                return view('funnels.partials.progress', [
                    'funnel' => $funnel
                ]);
            })
            ->editColumn('offer.customer.hospitals.name', function (Funnel $funnel) {
                return $funnel->offer->customer->hospitals->first()->name ?? $funnel->offer->customer->name;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Funnel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Funnel $model)
    {
        return $model->newQuery()
            ->with(['offer.customer.hospitals', 'offer.author', 'offer' => function ($query) {
                return $query->whereNull('offer_no');
            }])
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
            ->setTableId('funnel-table')
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
    </div>'
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
            Column::make('DT_RowIndex')->title('No.')->orderable(false)->searchable(false),

            // action button (approve/reject)
            Column::computed('action')
                ->searchable(false)
                ->orderable(false)
                ->printable(false)
                ->exportable(false)
                ->width(10),

            // customer
            Column::make('offer.customer.hospitals.name')
                ->title('Customer/Rumah Sakit')
                ->orderable(false),
            Column::make('offer.customer.name')->title('Customer')
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
            Column::make('date')->title('Tanggal'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Funnel_' . date('YmdHis');
    }
}
