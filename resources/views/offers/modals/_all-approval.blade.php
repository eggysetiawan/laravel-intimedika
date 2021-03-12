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
                        <label for="pin">Masukkan Pin</label>
                        <input type="password" size="4" maxlength="4" name="pin"
                            class="form-control @error('pin') is-invalid @enderror">
                        @error('pin')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="approval" class="btn bg-teal" value="1">Approve</button>
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
                        <label for="pin">Masukkan Pin</label>
                        <input type="password" size="4" maxlength="4" name="pin"
                            class="form-control @error('pin') is-invalid @enderror">
                        @error('pin')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="approval" class="btn bg-danger" value="2">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>
