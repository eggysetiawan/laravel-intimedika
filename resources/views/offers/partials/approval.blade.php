<div class="card-body">

    <div class="btn-group">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvalModal">
            Approve all
        </button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal">
            Reject all
        </button>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h5 class="modal-title" id="exampleModalLabel">
                    @if (request()->segment(1) == 'offers')
                        Approve Penawaran
                    @elseif(request()->segment(1) == 'progresses')
                        Approve Purchase Order
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="@if (request()->segment(1) == 'offers') {{ route('approval.all-offers') }}
            @else
                {{ route('approval.all-purchase') }} @endif
                " method="POST" class=" justify-content-center">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group">
                        @empty(auth()->user()->pin)

                            <a href="{{ route('pins.create') }}" class="btn btn-success form-control-plaintext">Setup
                                Pin</a>
                        @else
                            <label for="pin">Masukkan Pin</label>
                            <input type="password" size="4" maxlength="4" name="pin"
                                class="form-control @error('pin') is-invalid @enderror">
                            @error('pin')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        @endempty

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="approval" class="btn bg-teal" value="1" @empty(auth()->user()->pin)
                            disabled
                        @endempty>Approve All</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">
                    @if (request()->segment(1) == 'offers')
                        Reject Penawaran
                    @elseif(request()->segment(1) == 'progresses')
                        Reject Purchase Order
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="@if (request()->segment(1) == 'offers') {{ route('approval.all-offers') }}
            @else
                {{ route('approval.all-purchase') }} @endif
                " method="POST" class=" justify-content-center">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pin">Masukkan Pin</label>
                        <input type="password" size="4" maxlength="4" name="pin" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="approval" class="btn btn-danger" value="2">Reject All</button>
                </div>
            </form>
        </div>
    </div>
</div>
