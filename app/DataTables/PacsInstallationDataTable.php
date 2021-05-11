<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\PacsInstallation;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PacsInstallationDataTable extends DataTable
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
            ->editColumn('action', function (PacsInstallation $pacsInstallation) {
                return view('pacs.installation.partials.action', [
                    'pacsInstallation' => $pacsInstallation
                ]);
            })
            ->addColumn('pdf', function (PacsInstallation $pacsInstallation) {
                return view('pacs.installation.partials.pdf', [
                    'pacsInstallation' => $pacsInstallation,
                ]);
            })
            ->editColumn('engineers.technician.name', function (PacsInstallation $pacsInstallation) {
                $technicians = $pacsInstallation->engineers;
                $names = array();
                foreach ($technicians as $technician) :
                    $names[] = $technician->technician->name;
                endforeach;
                return join(" & ", array_unique($names));
            })
            ->editColumn('start_installation_date', function (PacsInstallation $pacsInstallation) {
                return $pacsInstallation->start_installation_date->format('d-M-Y');
            })
            ->editColumn('training_date', function (PacsInstallation $pacsInstallation) {
                return $pacsInstallation->training_date->format('d-M-Y');
            })
            ->editColumn('handover_date', function (PacsInstallation $pacsInstallation) {
                return $pacsInstallation->handover_date->format('d-M-Y');
            })
            ->editColumn('finish_installation_date', function (PacsInstallation $pacsInstallation) {
                return $pacsInstallation->finish_installation_date->format('d-M-Y');
            })
            ->editColumn('warranty_start', function (PacsInstallation $pacsInstallation) {
                return $pacsInstallation->warranty_start->format('d-M-Y');
            })
            ->editColumn('warranty_end', function (PacsInstallation $pacsInstallation) {
                return $pacsInstallation->warranty_end->format('d-M-Y');
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \PacsInstallation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PacsInstallation $model)
    {
        return $model->newQuery()
            ->with(['hospital', 'engineers.technician', 'author', 'stakeholder'])
            ->latest()
            ->when($this->hospital, function ($query) {
                return $query->whereHas('hospital', function ($query) {
                    return $query->where('slug', $this->hospital);
                });
            });
        // ->when($this->hospital, function($query){

        // });
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
                ->searchable(false),

            //action
            Column::computed('action')
                ->title('Action')
                ->exportable(false),

            //nama RS
            Column::computed('hospital.name')
                ->title('Nama RS'),

            // anydesk server
            Column::make('anydesk_server')
                ->title('Anydesk Server'),

            Column::make('anydesk_workstation')
                ->title('Anydesk Workstation'),

            //alamat RS
            Column::make('hospital.address')
                ->title('Alamat RS'),

            //Kota
            Column::make('hospital.city')
                ->title('Kota'),

            //Tanggal Instalasi
            Column::make('start_installation_date')
                ->title('Tanggal Instalasi'),

            //Tanggal Training'
            Column::make('training_date')
                ->title('Tanggal Training'),

            //Tanggal Serah Terima
            Column::make('handover_date')
                ->title('Tanggal Serah terima'),

            //Tanggal Selesai Instalasi
            Column::make('finish_installation_date')
                ->title('Tanggal Selesai Instalasi'),

            //Tanggal Dimulai Garansi
            Column::make('warranty_start')
                ->title('Tgl Dimulai Garansi'),

            //Tanggal Akhir Garansi
            Column::make('warranty_end')
                ->title('Tgl Akhir Garansi'),



            //email RS
            Column::make('hospital.email')
                ->title('Email RS'),

            //enginer
            Column::computed('engineers.technician.name')
                ->title('Pacs Enginer'),

            //Nama Petugas IT
            Column::make('stakeholder.it_hospital_name')
                ->title('IT Hospital Name'),

            //Nomor Hp IT
            Column::make('stakeholder.phone_it')
                ->title('IT Phone'),

            //Alamat Email IT
            Column::make('stakeholder.email_it')
                ->title('Email IT'),

            //Nama Radiographer
            Column::make('stakeholder.radiographer_name')
                ->title('Radiographer Name'),

            //Nomor Hp Radiographer
            Column::make('stakeholder.phone_radiographer')
                ->title('Radiographer Phone'),

            //Email Radiographer
            Column::make('stakeholder.email_radiographer')
                ->title('Email Radiographer'),

            //Nama Dokter
            Column::make('stakeholder.radiology_name')
                ->title('Radiology Physc Name'),

            //No HP DOkter Radiology]
            Column::make('stakeholder.phone_radiology')
                ->title('Radiology Physc Phone'),

            //Email Dokter Radiology
            Column::make('stakeholder.email_radiology')
                ->title('Radiology Email'),

            //Keterangan
            Column::make('stakeholder.user_note')
                ->title('User Note'),

            //upload
            Column::computed('pdf')
                ->title('File')
                ->width(10),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PacsInstallation_' . date('YmdHis');
    }
}
