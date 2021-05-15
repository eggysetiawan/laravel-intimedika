<?php

namespace App\DataTables;

use App\DailyJob;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DailyJobDataTable extends DataTable
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
            ->editColumn('action', function (DailyJob $dailyJob) {
                return view('daily_jobs.partials.action', compact('dailyJob'));
            })
            ->editColumn('date', function (DailyJob $dailyJob) {
                return $dailyJob->date->format('d-M-Y');
            })
            ->editColumn('description', function (DailyJob $dailyJob) {
                return view('daily_jobs.partials.description', compact('dailyJob'));
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \DailyJob $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DailyJob $model)
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

            //action
            Column::computed('action')
                ->title('Action')
                ->exportable(false)
                ->width(10),

            // title
            Column::make('title')
                ->title('Title'),

            // description
            Column::make('description')
                ->title('Deskripsi'),

            // date
            Column::make('date')
                ->title('Tanggal')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DailyJob_' . date('YmdHis');
    }
}