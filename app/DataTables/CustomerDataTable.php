<?php

namespace App\DataTables;

use App\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
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
            ->editColumn('action', function (Customer $customer) {
                return view('customers.partials.action', [
                    'customer' => $customer
                ]);
            })
            ->editColumn('name', function (Customer $customer) {
                return $customer->hospitals->first()->name ?? $customer->name;
            })
            ->editColumn('visit.count', function (Customer $customer) {
                return view('customers.partials.count', [
                    'customer' => $customer,
                ]);
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
    {
        return $model
            ->newQuery()
            ->with(['author', 'visits', 'hospitals'])
            ->latest()
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->where('user_id', auth()->id());
            });;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('customer-table')
            ->minifiedAjax()
            ->parameters([
                'stateSave' => true,
                'dom'          => 'Blfrtip',
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
        return [
            // No.
            Column::make('DT_RowIndex')
                ->title('No.')
                ->orderable(false)
                ->searchable(false),

            // action
            Column::computed('action')
                ->searchable(false)
                ->orderable(false)
                ->printable(false)
                ->exportable(false)
                ->width(50)
                ->addClass('text-center'),

            // name
            Column::make('name')
                ->title('Rumah Sakit/Perusahaan'),
            // hp customer
            Column::make('mobile')
                ->title('Hp/Telepon')
                ->orderable(false),
            // email customer
            Column::make('email')
                ->title('Email')
                ->orderable(false),
            // jabatan
            Column::make('role')
                ->title('Jabatan')
                ->orderable(false),

            // Jumlah Kunjungan
            Column::make('visit.count')
                ->title('Kunjungan')
                ->orderable(false)
                ->searchable(false),

            // nama sales
            Column::make('author.name')
                ->title('Sales'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'IPI_Customer_' . date('YmdHis');
    }
}