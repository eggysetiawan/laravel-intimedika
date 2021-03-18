<!-- Modal -->
<div class="modal fade" id="approveModal{{ $offer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h5 class="modal-title" id="exampleModalLabel">Approve Penawaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('approval.offers', $offer->slug) }}" method="POST" class=" justify-content-center">
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
                                class="form-control @error('pin') is-invalid @enderror" autofocus>
                        @endempty
                        @error('pin')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="approval" class="btn bg-teal" value="1" @empty(auth()->user()->pin)
                            disabled
                        @endempty>Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="rejectModal{{ $offer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Reject Penawaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('approval.offers', $offer->slug) }}" method="POST" class=" justify-content-center">
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
                    <button type="submit" name="approval" class="btn bg-danger" value="2" @empty(auth()->user()->pin)
                            disabled
                        @endempty>Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>



{{-- approve purchase order --}}
<!-- Modal -->
<div class="modal fade" id="approvePurchase{{ $offer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h5 class="modal-title" id="exampleModalLabel">Approve Purchase Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('approval.progress', $offer->slug) }}" method="POST"
                class=" justify-content-center">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group">
                        @empty(auth()->user()->pin)

                            <a href="{{ route('pins.create') }}" class="btn btn-success form-control-plaintext">Setup
                                Pin</a>
                        @else
                            <label for="pin">Masukkan Pin</label>
                            <input type="password" size="4" maxlength="4" name="pin" class="form-control" autofocus>
                        @endempty

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="approval" class="btn bg-teal" value="1" @empty(auth()->user()->pin)
                            disabled
                        @endempty>Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="rejectPurchase{{ $offer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Reject Purchas Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('approval.progress', $offer->slug) }}" method="POST"
                class=" justify-content-center">
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
                    <button type="submit" name="approval" class="btn bg-danger" value="2" @empty(auth()->user()->pin)
                            disabled
                        @endempty>Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>

@error('pin')
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'error',
                title: 'Pin yang anda masukkan salah!',
                text: 'Silahkan coba lagi.',
            });
        });

    </script>

@enderror
