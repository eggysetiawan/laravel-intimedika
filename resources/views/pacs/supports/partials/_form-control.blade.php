<div class="card-body">
    <div class="form-group">
        <label for="pacs_installation">Pilih Rumah Sakit</label>
        <select name="pacs_installation" id="pacs_installation">
            <option selected disabled>Pilih Rumah Sakit</option>

            @foreach ($hospitals as $hospital)
                <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
            @endforeach


        </select>
    </div>
</div>
