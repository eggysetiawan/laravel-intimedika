<?php

namespace App\DataTables;

use App\Advance;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AdvanceDataTable extends DataTable
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
            ->editColumn('action', function (Advance $advance) {
                if ($advance->slug) {
                    return view('advances.partials.action', [
                        'advance' => $advance
                    ]);
                }
                return '';
            })
            ->addColumn('pdf', function (Advance $advance) {
                return view('advances.partials.pdf', [
                    'advance' => $advance,
                ]);
            })
            ->editColumn('start_date', function (Advance $advance) {
                return date('d-m-Y', strtotime($advance->start_date));
            })
            ->editColumn('end_date', function (Advance $advance) {
                return date('d-m-Y', strtotime($advance->end_date));
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Advance $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Advance $model)
    {
        return $model->newQuery()
            ->with(['author', 'needs', 'hospitals'])
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
            ->setTableId('advance-table')
            ->minifiedAjax()
            ->parameters([
                'stateSave' => true,
                'dom'          => "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>rtip",
                'buttons'      => ['reload', 'reset'],
                'order'   => [[0, 'desc']],
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
                ->width(50)
                ->addClass('text-left'),

            // No.
            Column::computed('DT_RowIndex')
                ->title('No.')
                ->width(20),

            Column::computed('pdf')
                ->title('File')
                ->width(10),

            Column::make('author.name')
                ->title('Nama')
                ->exportable('false')
                ->printable('false'),

            Column::make('destination')
                ->title('Lokasi')
                ->exportable('false')
                ->printable('false'),

            Column::make('objective')
                ->title('Tujuan')
                ->exportable('false')
                ->printable('false'),

            Column::make('start_date')
                ->title('Dari')
                ->exportable('false')
                ->printable('false'),

            Column::make('end_date')
                ->title('Sampai')
                ->exportable('false')
                ->printable('false'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Advance_' . date('YmdHis');
    }
}
