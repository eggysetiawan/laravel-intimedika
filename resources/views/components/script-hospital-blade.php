<script>
    $(document).ready(function() {
        window.initSelectUserDrop = () => {
            $('#hospitals').select2({
                placeholder: 'Pilih Rumah Sakit',
                allowClear: true,
            });
        }
        initSelectUserDrop();
        window.livewire.on('select2', () => {
            initSelectUserDrop();
        });

    });
</script>
