 <!-- ARCHIVES JS -->
<!-- Jquery Core Js -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    {{-- <script src="{{ asset('backend/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script> --}}

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('backend/plugins/node-waves/waves.js') }}"></script>

     <!-- Custom Js -->
    <script src="{{ asset('backend/js/admin.js') }}"></script>

    <!-- Demo Js -->
    {{-- <script src="{{ asset('backend/js/demo.js') }}"></script> --}}

    <script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
 @stack('script')

 <script>
     @if ($errors->any())
         @foreach ($errors->all() as $error)
             toastr.error('{{ $error }}', 'Error', {
                 closeButtor: true,
                 progressBar: true
             });
         @endforeach
     @endif
 </script>
 @if(Session::has('message'))
    <script>
        toastr.success("{{ Session::get('message') }}");
    </script>
@endif
 <!-- MAIN JS -->
 {{-- <script src="{{ asset('frontend/findhouse/js/script.js') }}"></script> --}}
 <script src="{{ asset('frontend/findhouse/js/toastr.min.js') }}"></script>
 @if (Session::has('flash'))
     <script>
         (function($) {
             var flash_obj = @json(Session::get('flash'));
             var msg = flash_obj.msg;
             var type = flash_obj.type;
             toastr.options = {
                 "closeButton": false,
                 "debug": false,
                 "newestOnTop": false,
                 "progressBar": true,
                 "positionClass": "toast-bottom-right",
                 "preventDuplicates": false,
                 "onclick": null,
                 "showDuration": "5000",
                 "hideDuration": "5000",
                 "timeOut": "5000",
                 "extendedTimeOut": "1000",
                 "showEasing": "swing",
                 "hideEasing": "linear",
                 "showMethod": "fadeIn",
                 "hideMethod": "fadeOut"
             }
             if (type == 'success') {
                 toastr.success(msg);
             } else if (type == 'error') {
                 toastr.error(msg)
             } else if (type == 'info') {
                 toastr.info(msg)
             } else if (type == 'warning') {
                 toastr.warning(msg)
             } else {
                 console.log('unknown error status');
             }
         })(jQuery);
     </script>
 @endif
