<?php

namespace App\DataTables;

use App\PacsInstallation;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnIterator;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PacsInstallationDataTable extends DataTable
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
            ->editColumn('action', function (PacsInstallation $pacsInstallation) {
                return view('pacs.installation.partials.action', [
                    'pacsinstallation' => $pacsInstallation
                ]);
            })
            ->addColumn('pdf', function (PacsInstallation $pacsInstallation) {
                return view('pacs.installation.partials.pdf', [
                    'pacsinstallation' => $pacsInstallation,
                ]);
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \PacsInstallation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PacsInstallation $model)
    {
        return $model->newQuery()
            ->with(['hospital', 'engineers', 'author']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('pacsinstallationdatatable-table')
            ->minifiedAjax()
            ->parameters([
                'stateSave' => true,
                'dom' => "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>rtip",
                'buttons' => ['reload', 'reset'],
                'order' => [0, 'desc'],
                'lengthMenu' => [
                    [10, 25, 50, 100],
                    ['10', '25', '50', '100']
                ],
                'processing' => true,
            ])
            ->columns($this->getColumns());
    }
    // {
    //     return $this->builder()
    //         ->setTableId('pacsinstallationdatatable-table')
    //         ->columns($this->getColumns())
    //         ->minifiedAjax()
    //         ->dom('Bfrtip')
    //         ->orderBy(1)
    //         ->buttons(
    //             Button::make('create'),
    //             Button::make('export'),
    //             Button::make('print'),
    //             Button::make('reset'),
    //             Button::make('reload')
    //         );
    // }

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
                ->searchable(false),

            //action
            Column::computed('action')
                ->title('Action')
                ->exportable(false),

            //nama RS
            Column::make('hospital.name')
                ->title('Nama RS'),

            //alamat RS
            Column::make('hospital.address')
                ->title('Alamat RS'),

            //Kota
            Column::make('hospital.city')
                ->title('Kota'),

            //Tanggal Instalasi
            Column::make('start_installation_date')
                ->title('Tanggal Instalasi'),

            //Tanggal Training'
            Column::make('training_date')
                ->title('Tanggal Training'),

            //Tanggal Serah Terima
            Column::make('handover_date')
                ->title('Tanggal Serah terima'),

            //Tanggal Selesai Instalasi
            Column::make('finish_installation_date')
                ->title('Tanggal Selesai Instalasi'),

            //Tanggal Dimulai Garansi
            Column::make('warranty_start')
                ->title('Tgl Dimulai Garansi'),

            //Tanggal Akhir Garansi
            Column::make('warranty_end')
                ->title('Tgl Akhir Garansi'),

            //upload
            Column::computed('pdf')
                ->title('File')
                ->width(10),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PacsInstallation_' . date('YmdHis');
    }
}
