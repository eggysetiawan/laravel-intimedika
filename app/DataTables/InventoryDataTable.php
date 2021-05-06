<?php

namespace App\DataTables;

use App\Inventory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InventoryDataTable extends DataTable
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
            ->editColumn('action', function (Inventory $inventory) {
                return view('inventories.partials.action', [
                    'inventory' => $inventory
                ]);
            })
            ->editColumn('purchase_date', function (Inventory $inventory) {
                return date('d-M-Y', strtotime($inventory->purchase_date));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Inventory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inventory $model)
    {
        return $model->newQuery()
            ->with(['department', 'author'])
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
            ->setTableId('inventory-table')
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
                ->width(30),

            // nama barang
            Column::make('item')
                ->title('Nama Barang'),

            // quantity
            Column::make('quantity')
                ->title('Qty'),

            // service tag
            Column::make('service_tag')
                ->title('Service Tag'),

            // serial number
            Column::make('serial_number')
                ->title('Serial Number'),

            // Tanggal Pembelian
            Column::make('purchase_date')
                ->title('Tgl. Pembelian'),

            // type
            Column::make('type')
                ->title('Jenis'),

            // Lokasi
            Column::make('location')
                ->title('Lokasi'),

            // nama pengguna
            Column::make('user')
                ->title('Nama Pengguna'),

            // Divisi/department
            Column::make('department.name')
                ->title('Divisi'),

            // Keterangan
            Column::make('note')
                ->title('Keterangan')




        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Inventory_' . date('YmdHis');
    }
}
