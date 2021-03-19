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
            ->editColumn('plan.date', function (Visit $visit) {
                return $visit->plan->date ?? '';
            })
            ->editColumn('plan.description', function (Visit $visit) {
                return $visit->plan->description ?? '';
            })
            ->editColumn('plan.territory', function (Visit $visit) {
                return $visit->plan->territory ?? '';
            })
            ->editColumn('plan.area', function (Visit $visit) {
                return $visit->plan->area ?? '';
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
            ->editColumn('status', function (Visit $visit) {
                return view('visits.partials.status', [
                    'visit' => $visit
                ]);
            })
            ->editColumn('updated_at', function (Visit $visit) {
                return $visit->updated_at->format('d-m-Y');
            })
            ->rawColumns(['action']);
    }


    public function query(Visit $model)
    {
        return $model->newQuery()
            ->latest()
            ->with(['customer.hospitals', 'author', 'plan'])
            ->when(!$this->plan, function ($query) {
                return $query->where('is_visited', 1);
            })
            ->when($this->plan, function ($query) {
                return $query->whereHas('plan', function ($query) {
                    return $query->orderBy('date', 'asc');
                });
            })
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->when($this->trash, function ($query) {
                return $query->onlyTrashed();
            });
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
                'dom'          => "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>rtip",
                'buttons'      => ['excel', 'print', 'reset'],
                'order'   => [1, 'desc'],
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
                ->searchable(false),


            // hospital
            Column::make('customer.hospitals.name')
                ->title('Rumah Sakit')
                ->orderable(false),

            // tanggal kunjungan
            Column::make('updated_at')
                ->title('Tanggal'),

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
                ->searchable(false),


            // hospital
            Column::make('customer.hospitals.name')
                ->title('Rumah Sakit')
                ->orderable(false),



            // tanggal
            Column::make('plan.date')
                ->title('Dijadwalkan')
                ->orderable(false),

            // nama customer
            Column::make('customer.name')
                ->title('Customer')
                ->orderable(false),

            // hp customer
            Column::make('customer.mobile')
                ->title('Hp/Telepon')
                ->orderable(false),
            // aktivitas
            Column::make('plan.description')
                ->title('Aktivitas')
                ->orderable(false),
            // aktivitas
            Column::computed('status')
                ->title('Status')
                ->orderable(false)
                ->printable(false)
                ->searchable(false),

            // area
            Column::make('plan.area')
                ->title('Area')
                ->orderable(false),

            // area
            Column::make('plan.territory')
                ->title('Ruang/Bagian')
                ->orderable(false),

            // sales
            Column::make('author.name')
                ->title('Sales')
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
        if ($this->plan) :
            $filename = 'IPI_Rencana_Kunjungan_Sales_' . date('Y_m_d_His');
        else :
            $filename = 'IPI_Kunjungan_Sales_' . date('Y_m_d_His');
        endif;

        return $filename;
    }
}
