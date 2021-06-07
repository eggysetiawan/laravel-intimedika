<?php

namespace App\DataTables;

use App\Modality;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ModalityDataTable extends DataTable
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
            ->editColumn('action', function (Modality $modality) {
                return view('modalities.partials.action', [
                    'modality' => $modality
                ]);
            })
            ->editColumn('spec', function (Modality $modality) {
                return view('modalities.partials.spec', [
                    'modality' => $modality
                ]);
            })
            ->editColumn('price', function (Modality $modality) {
                return 'Rp ' . number_format($modality->price ?? NULL, 0, ',', '.');
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Modality $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Modality $model)
    {
        return $model->newQuery()
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
            // No.
            Column::make('DT_RowIndex')
                ->title('No.')
                ->orderable(false)
                ->searchable(false)
                ->width(10),
            // action
            Column::computed('action')
                ->title('<i class="fas fa-cogs"></i>')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->width(50)
                ->addClass('text-center'),


            // nama
            Column::make('name')
                ->title('Nama'),
            // model
            Column::make('model')
                ->title('Model'),
            // merk
            Column::make('brand')
                ->title('Merk'),
            // harga
            Column::make('price')
                ->title('Harga'),
            // stok
            Column::make('stock')
                ->title('Stok'),

            // referensi
            Column::make('reference')
                ->title('Referensi'),
            // referensi
            Column::computed('spec')
                ->title('Spesifikasi'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Modality_' . date('YmdHis');
    }
}
