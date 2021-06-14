<div class="container">
    <div class="row justify-content-end mb-4">


        <div class="col-md-4">
            <input type="text" wire:model="query" class="form-control" placeholder="Search people . . ">
        </div>
        <div class="col-md-4">
            <input type="text" wire:model="query" class="form-control" placeholder="Search people . . ">
        </div>
    </div>


    <div class="card">
        <div class="card-body">
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
            @dump($selectedRows)
            <div class="mt-3">
                @if ($pacsInstallations->hasMorePages())
                    <button class="btn btn-primary btn-block" wire:click.prevent="loadMore">Load more!</button>
                @endif
            </div>
        </div>


    </div>
</div>
