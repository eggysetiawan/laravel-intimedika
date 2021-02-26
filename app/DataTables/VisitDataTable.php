<?php

namespace App\DataTables;

use App\Visit;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VisitDataTable extends DataTable
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
            ->editColumn('customer.hospitals.name', function (Visit $visit) {
                return $visit->customer->hospitals->first()->name ?? '';
            })
            ->editColumn('plans.date', function (Visit $visit) {
                return $visit->plans->last()->date ?? '';
            })
            ->editColumn('plans.description', function (Visit $visit) {
                return $visit->plans->last()->description ?? '';
            })
            ->editColumn('result', function (Visit $visit) {
                if ($visit->slug) {
                    return view('visits.partials.result', [
                        'visit' => $visit
                    ]);
                }
            })
            ->editColumn('action', function (Visit $visit) {
                return view('visits.partials.action', [
                    'visit' => $visit
                ]);
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Visit $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Visit $model)
    {
        return $model->newQuery()
            ->with(['customer.hospitals', 'author', 'plans'])
            ->when(!$this->plan, function ($query) {
                return $query->where('is_visited', 1);
            })
            ->when($this->plan, function ($query) {
                return $query->where('is_visited', 0);
            })
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->when($this->trash, function ($query) {
                return $query->onlyTrashed();
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
            ->setTableId('visit-table')
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
        if ($this->plan) :
            return $this->visitplan();
        else :
            return $this->visits();
        endif;
    }

    protected function visits()
    {
        return [
            // No.
            Column::make('DT_RowIndex')
                ->title('No.')
                ->orderable(false)
                ->searchable(false),

            Column::computed('action')
                ->searchable(false)
                ->orderable(false)
                ->printable(false)
                ->exportable(false),

            // hospital
            Column::make('customer.hospitals.name')
                ->title('Rumah Sakit')
                ->orderable(false),

            // nama customer
            Column::make('customer.name')
                ->title('Nama Customer')
                ->orderable(false),


            // hp customer
            Column::make('customer.mobile')
                ->title('Hp/Telepon')
                ->orderable(false),


            // email customer
            Column::make('customer.email')
                ->title('Email')
                ->orderable(false),


            // jabatan
            Column::make('customer.role')
                ->title('Jabatan')
                ->orderable(false),


            // request
            Column::make('request')
                ->title('Permintaan')
                ->searchable(true)
                ->orderable(false),

            // result
            Column::make('result')
                ->title('Permintaan')
                ->visible(false),
            Column::computed('result')
                ->title('Hasil Kunjungan')
                ->orderable(false)
                ->searchable(false)
                ->printable(false),

            // sales
            Column::make('author.name')
                ->title('Sales')
                ->orderable(false),
        ];
    }
    protected function visitplan()
    {
        return [
            // No.
            Column::make('DT_RowIndex')
                ->title('No.')
                ->orderable(false)
                ->searchable(false),

            Column::computed('action')
                ->searchable(false)
                ->orderable(false)
                ->printable(false)
                ->exportable(false),

            // hospital
            Column::make('customer.hospitals.name')
                ->title('Rumah Sakit')
                ->orderable(false),

            // sales
            Column::make('author.name')
                ->title('Sales')
                ->orderable(false),

            // tanggal
            Column::make('plans.date')
                ->title('Tanggal'),

            // keterangan
            Column::make('plans.description')
                ->title('Keterangan')
                ->orderable(false),

            // nama customer
            Column::make('customer.name')
                ->title('Nama Customer')
                ->orderable(false),


            // hp customer
            Column::make('customer.mobile')
                ->title('Hp/Telepon')
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
        return 'IPI_Kunjungan_' . date('YmdHis');
    }
}
