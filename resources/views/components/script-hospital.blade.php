<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        window.initSelectHospitalDrop = () => {
            $('#hospital').select2({
                placeholder: 'Pilih Rumah Sakit',
                allowClear: true,
                ajax: {
                    url: "{{ route('hospitals.select') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };

                    },

                    cache: true
                }
            })
        }
        initSelectHospitalDrop();
        $('#hospital').on('change', function(e) {
            // livewire.emit('selectedHospital', e.target.value)
            // livewire.emit('selectedHospitalVisited', e.target.value)

        });

        window.livewire.on('select2', () => {
            initSelectHospitalDrop();

        });

    });

</script>
