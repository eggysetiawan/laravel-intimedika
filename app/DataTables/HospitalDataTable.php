<?php

namespace App\DataTables;

use App\Hospital;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class HospitalDataTable extends DataTable
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
            ->editColumn('action', function (Hospital $hospital) {
                return view('hospitals.partials.action', [
                    'hospital' => $hospital
                ]);
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
        return $model->query()
            ->where('name' , '!=', '')
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
                    ->setTableId('hospital-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        'stateSave' => true,
                    ])
                    ->dom('Bfrtip')
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
            Column::make('DT_RowIndex')->title('No.')->orderable(false)->searchable(false),
            Column::make('name')->title('Rumah Sakit'),
            Column::make('address')->title('Alamat'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Hospital_' . date('YmdHis');
    }
}
