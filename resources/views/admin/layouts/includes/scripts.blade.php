<!-- jQuery -->
<script src="{{ asset('admin/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('admin/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- daterangepicker -->
<script src="{{ asset('admin/admin-lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admin/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('admin/admin-lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('admin/admin-lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('admin/admin-lte/plugins/toastr/toastr.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('admin/admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>


<!-- AdminLTE App -->
<script src="{{ asset('admin/admin-lte/dist/js/adminlte.js') }}"></script>
<script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "timeOut": "3000",
        "extendedTimeOut": "3000"
        }



        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
</script>
<script>
    @if(count($errors) > 0)
        toastr.error("{{ $errors->first() }}");
    @endif
</script>
