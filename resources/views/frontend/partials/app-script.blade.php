 <!-- ARCHIVES JS -->
 <script src="{{ asset('frontend/findhouse/js/jquery-3.5.1.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/tether.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/mmenu.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/mmenu.js') }}"></script>

 <script src="{{ asset('frontend/findhouse/js/slick.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/fitvids.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/smooth-scroll.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/lightcase.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/search.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/jquery.magnific-popup.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/ajaxchimp.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/newsletter.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/color-switcher.js') }}"></script>
 @stack('script')

 <script>
     $(window).on('scroll load', function() {
         $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
     });
 </script>

 <!-- Slider Revolution scripts -->
 <script src="{{ asset('frontend/findhouse/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
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
 <script src="{{ asset('frontend/findhouse/js/script.js') }}"></script>
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
