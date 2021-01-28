<?php

namespace App\DataTables;

use App\Hospital;
use Yajra\DataTables\Html\Column;
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
        if ($this->from && $this->to) :
            $from = $this->from;
            $to = $this->to;
        else :
            $from = $model->select('created_at')->orderBy('created_at', 'asc')->first()->created_at;
            $to = date('Y-m-d H:i:s');
        endif;

        return $model->query()
            ->whereBetween('created_at', [$from, $to])
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
            ->minifiedAjax()
            ->parameters([
                'dom'          => 'Blfrtip',
                'buttons'      => ['export'],
                'order'   => [[0, 'desc']],
                'lengthMenu' => [
                    [10, 100, 1000, 5000, 10000],
                    ['10', '100', '1000', '5000', '10000']
                ],
            ])
            ->columns($this->getColumns())
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
        return 'IPI | Daftar Rumah Sakit _' . date('YmdHis');
    }
}
