<?php

namespace App\DataTables;

use App\Target;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TargetDataTable extends DataTable
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
            ->editColumn('action', function (Target $target) {
                return view('targets.partials.action', [
                    'target' => $target
                ]);
            })
            ->editColumn('target', function (Target $target) {
                return 'Rp ' . number_format($target->target ?? NULL, 0, ',', '.');
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Target $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Target $model)
    {
        $selectedYear = $this->selectedYear;

        return $model->newQuery()
            ->with('author')
            ->when($this->selectedYear, function ($query) use ($selectedYear) {
                return $query->where('year', $selectedYear);
            })
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->where('user_id', auth()->id());
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
            ->setTableId('target-table')
            ->minifiedAjax()
            ->parameters([
                'stateSave' => true,
                'dom'          => "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>rtip",
                'buttons'      => ['reload', 'reset'],
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

            // No.
            Column::make('DT_RowIndex')
                ->title('No.')
                ->orderable(false)
                ->searchable(false),

            // nama sales
            Column::make('author.name')
                ->title('Sales'),

            // target
            Column::make('target')
                ->title('Target')
                ->orderable('false')
                ->searchable('false'),

            // year
            Column::make('year')
                ->title('Tahun Target')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'IPI_Target_' . date('YmdHis');
    }
}
