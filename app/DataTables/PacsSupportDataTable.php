<?php

namespace App\DataTables;

use App\PacsSupport;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PacsSupportDataTable extends DataTable
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
            ->editColumn('action', function (PacsSupport $pacsSupport) {
                return view('pacs.supports.partials.action', [
                    'pacsSupport' => $pacsSupport
                ]);
            })
            ->editColumn('installation.hospital.name', function (PacsSupport $pacsSupport) {
                return $pacsSupport->installation->hospital->name;
            })
            ->editColumn('report_date', function (PacsSupport $pacsSupport) {
                return date('d-m-Y', strtotime($pacsSupport->report_date)) ?? NULL;
            })
            ->editColumn('report_time', function (PacsSupport $pacsSupport) {
                return date('H:i', strtotime($pacsSupport->report_time)) ?? NULL;
            })
            ->editColumn('solve_date', function (PacsSupport $pacsSupport) {
                return date('d-m-Y', strtotime($pacsSupport->solve_date)) ?? NULL;
            })
            ->editColumn('solve_time', function (PacsSupport $pacsSupport) {
                return date('H:i', strtotime($pacsSupport->solve_time)) ?? NULL;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \PacsSupport $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PacsSupport $model)
    {
        return $model->newQuery()
            ->with(['installation', 'engineers', 'author'])
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
            ->setTableId('pacssupport-table')
            ->minifiedAjax()
            ->parameters([
                'stateSave' => true,
                'dom'          => "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>rtip",
                'buttons'      => ['reload', 'reset'],
                'order'   => [0, 'desc'],
                'lengthMenu' => [
                    [10, 25, 50, 100],
                    ['10', '25', '50', '100']
                ],
                'processing' => false,
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
                ->width(20),

            // Nama Rumah Sakit
            Column::computed('installation.hospital.name')
                ->title('Rumah Sakit'),

            // personel yang menghubungi
            Column::make('hospital_personel')
                ->title('Yang Menghubungi'),

            // jam pengaduan
            Column::make('report_time')
                ->title('Jam Pengaduan'),

            // tanggal pengaduan
            Column::make('report_date')
                ->title('Tanggal Pengaduan'),

            // Masalah yang diadukan
            Column::make('problem')
                ->title('Permasalahan'),

            // Penyelesaian Masalah
            Column::make('solve')
                ->title('Penyelesaian'),

            // Waktu Penyelesaian
            Column::make('solve_time')
                ->title('Jam penyelesaian'),

            // Tanggal Penyelesaian
            Column::make('solve_date')
                ->title('Tanggal Penyelesaian')



        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PacsSupport_' . date('YmdHis');
    }
}
