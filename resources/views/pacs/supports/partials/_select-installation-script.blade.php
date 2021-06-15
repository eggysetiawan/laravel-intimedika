<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $('#pacs_installation').select2({
            ajax: {
                url: "{{ route('pacs_installations.select') }}",
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
    });

</script>
