<?php

namespace App\DataTables;

use App\Hospital;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HospitalDataTable extends DataTable
{
    /**
     * Build DataTable class. hanya tester
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('action', function (Hospital $hospital) {
                if ($hospital->slug) {
                    return view('hospitals.partials.action', [
                        'hospital' => $hospital
                    ]);
                }
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Hospital $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Hospital $model)
    {


        return $model->newQuery()
            ->when($this->from && $this->to, function ($query) {
                return $query->whereBetween('created_at', [$this->from, $this->to]);
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
                'dom'          => "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>rtip",
                'buttons'      => ['excel', 'print', 'reset'],
                'order'   => [1, 'desc'],
                'lengthMenu' => [
                    [10, 25, 50, 100],
                    ['10', '25', '50', '100']
                ],
            ])
            ->language([
                'processing' => '<div class="loadingio-spinner-double-ring-2u42wjzuj9"><div class="ldio-1rv8kps4nil">
                <div></div>
                <div></div>
                <div><div></div></div>
                <div><div></div></div>
                </div></div>',
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

            Column::make('DT_RowIndex')->title('No.')->orderable(false)->searchable(false),
            Column::make('name')->title('Rumah Sakit'),
            Column::make('address')->title('Alamat'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'IPI | Daftar Rumah Sakit _' . date('YmdHis');
    }
}
