<?php

namespace App\DataTables;

use App\Offer;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OfferDataTable extends DataTable
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
            ->editColumn('action', function (Offer $offer) {
                if ($offer->slug) {
                    return view('offers.partials.action', [
                        'offer' => $offer
                    ]);
                }
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Offer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Offer $model)
    {
        if ($this->from && $this->to) :
            $from = $this->from;
            $to = $this->to;
        else :
            $from = $model->select('created_at')->orderBy('created_at', 'asc')->first()->created_at;
            $to = date('Y-m-d H:i:s');
        endif;

        return $model->query()
            ->with('customer', 'author')
            ->whereBetween('offer_date', [$from, $to])
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
            ->setTableId('offer-table')
            ->minifiedAjax()
            ->parameters([
                'dom'          => 'Blfrtip',
                'buttons'      => ['export', 'print'],
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
            Column::computed('action'),
            Column::make('customer.name')->title('Customer'),
            Column::make('budget')->title('Dana'),
            Column::make('author.name')->title('Sales'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Offer_' . date('YmdHis');
    }
}
