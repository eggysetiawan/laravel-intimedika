<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

{{-- select2 --}}
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<!-- Ekko Lightbox -->
<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
{{-- fast click --}}
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>

{{-- Bootstrap Switch --}}
<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>


<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>



@if (session()->has('success'))

    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right top-rights",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            setTimeout(function() {
                toastr.success("{{ session()->get('success') }}")
            }, 550);
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
    function myFunction() {
        var x = document.getElementById("pin");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>

<script>
    function myFunctionConfirm() {
        var x = document.getElementById("pin_confirmation");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>

<script>
    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })

</script>

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
