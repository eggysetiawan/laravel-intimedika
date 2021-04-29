@if ($invoice->notPaid())
    <div class="row justify-content-end">
        <div class="col-md-12">
            {{-- <a href="{{ route('payments.update', $invoice->tax->id) }}" class="btn btn-success float-right"
                title="Update status pembayaran.">
                <i class="fas fa-check-circle"></i> Sudah bayar.
            </a> --}}

            <form action="{{ route('payments.update', $invoice->tax->id) }}" method="POST">
                @csrf
                @method('patch')
                <button class="btn btn-success float-right" title="Update status pembayaran."
                    onclick="return confirm('Apakah anda yakin?')">
                    <i class="fas fa-check-circle"></i> Sudah bayar.
                </button>
            </form>
        </div>
    </div>
@endif
