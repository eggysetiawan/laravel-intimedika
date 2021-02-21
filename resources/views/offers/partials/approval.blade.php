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
            <div class="modal-header bg-success">
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
            <div class="modal-body">
                Apakah anda yakin ingin menyetujui semua penawaran?
            </div>
            <div class="modal-footer">
                <form action="@if (request()->segment(1) == 'offers') {{ route('approval.all-offers') }}
                @else
                    {{ route('approval.all-purchase') }} @endif
                    " method="POST" class="inline">
                    @csrf
                    @method('patch')
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-success" type="submit" name="approval" value="1">Setujui.</button>
                </form>
            </div>
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
            <div class="modal-body">
                Apakah anda yakin ingin membatalkan semua penawaran?
            </div>
            <div class="modal-footer">
                <form action="@if (request()->segment(1) == 'offers') {{ route('approval.all-offers') }}
                @else
                    {{ route('approval.all-purchase') }} @endif
                    " method="POST" class="inline">
                    @csrf
                    @method('patch')
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-success" type="submit" name="approval" value="2">Ya.</button>
                </form>
            </div>
        </div>
    </div>
</div>
