<script>
    $(document).ready(function() {
        window.initSelectUserDrop = () => {
            $('#user').select2({
                placeholder: 'Pilih User',
                allowClear: true,
            });
        }
        initSelectUserDrop();
        // $('#hospital').on('change', function(e) {
        //     livewire.emit('selectedHospitalItem', e.target.value)
        // });
        window.livewire.on('select2', () => {
            initSelectUserDrop();
        });

    });

</script>
