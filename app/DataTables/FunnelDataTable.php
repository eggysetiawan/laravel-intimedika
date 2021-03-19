<?php

namespace App\DataTables;

use App\Funnel;
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
            ->editColumn('date', function (Funnel $funnel) {
                return date('d-m-Y', strtotime($funnel->date));
            })
            ->editColumn('description', function (Funnel $funnel) {
                return view('funnels.partials.description', [
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
                'dom'          => "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>rtip",
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
            // action
            Column::computed('action')
                ->title('<i class="fas fa-cogs"></i>')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->width(50)
                ->addClass('text-center'),

            // No.
            Column::make('DT_RowIndex')
                ->title('No.')
                ->orderable(false)
                ->searchable(false)
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

            // keterangan
            Column::computed('description')
                ->title('Keterangan')
                ->orderable(false),

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
