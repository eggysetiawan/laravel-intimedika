<div class="container">
    <div class="row justify-content-end mb-4">


        <div class="col-md-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="search" wire:model="query" class="form-control" placeholder="Cari Rumah Sakit - Kota"
                    autocomplete="off">
            </div>
        </div>

    </div>


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabel Instalasi Pacs</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <a href="#!" class="btn btn-outline-success" wire:click.prevent="exportExcel">Export to Excel</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="icheck-primary">
                            <input type="checkbox" wire:model="selectPageRows">
                        </th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Kota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pacsInstallations as $installation)
                        <tr>
                            <td class="icheck-primary d-inline">
                                <input type="checkbox" wire:model="selectedRows" id="{{ $installation->id }}"
                                    value="{{ $installation->id }}">
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $installation->hospital->name }}</td>
                            <td>{{ $installation->hospital->city }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                @if ($pacsInstallations->hasMorePages())
                    <button class="btn btn-primary btn-block" wire:click.prevent="loadMore">
                        Load more!
                    </button>
                @endif
            </div>
        </div>


    </div>
</div>
