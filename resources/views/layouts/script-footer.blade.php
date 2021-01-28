<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
{{-- select2 --}}
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

{{-- Bootstrap Switch --}}

<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>


<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

@if (session()->has('success'))
    <script>
        $(document).ready(function() {
            $(document).Toasts('create', {
                class: 'bg-success bot-left',
                position: 'bottomLeft',
                fixed: true,
                title: 'Berhasil!',
                autohide: true,
                delay: 5500,
                // subtitle: 'Subtitle',
                body: "{{ session()->get('success') }}"
            }).delay(200).slideUp(300).fadeIn(400);
        });

    </script>
@endif

@if (session()->has('error'))
    <script>
        $(document).ready(function() {
            $(document).Toasts('create', {
                class: 'bg-danger bot-left',
                position: 'bottomLeft',
                fixed: true,
                title: 'Something wrong!',
                autohide: true,
                delay: 3500,
                subtitle: 'Subtitle',
                body: "{{ session()->get('error') }}"
            })
        });

    </script>

@endif

{{-- dark mode --}}
{{-- <script>
    function myFunction() {
        var element = document.getElementById("body");
        element.classList.toggle("dark-mode");
    }

</script> --}}

<script>
    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked', false));
    });

</script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

</script>

<script>
    $(function() {


        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd-mm-yyyy', {
            'placeholder': 'dd-mm-yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()




        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })



    })

</script>
