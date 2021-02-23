<form action="{{ route('approval.offers', $offer->slug) }}" method="POST">
    @csrf
    @method('patch')
    <div class="btn-group form-control-plaintext">
        <button class="btn btn-success btn-sm" name="approval" type="submit" value="1"
            onclick="return confirm('apakah anda yakin?')">Approve.</button>
        <button class="btn btn-danger btn-sm" name="approval" value="2"
            onclick="return confirm('apakah anda yakin?')">Reject.</button>
    </div>
</form>
