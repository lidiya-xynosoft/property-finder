  <!-- ARCHIVES JS -->
  <script src="{{ asset('frontend/findhouse/js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('frontend/findhouse/js/popper.min.js') }}"></script>
  <script src="{{ asset('frontend/findhouse/js/jquery-ui.js') }}"></script>
  {{-- <script src="{{ asset('frontend/findhouse/js/tether.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('frontend/findhouse/js/moment.js') }}"></script> --}}
  <script src="{{ asset('frontend/findhouse/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/findhouse/js/mmenu.min.js') }}"></script> 
 <script src="{{ asset('frontend/findhouse/js/mmenu.js') }}"></script>
  {{-- <script src="{{ asset('frontend/findhouse/js/swiper.min.js') }}"></script>
  <script src="{{ asset('frontend/findhouse/js/swiper.js') }}"></script> --}}
  {{-- <script src="{{ asset('frontend/findhouse/js/slick.min.js') }}"></script>
  <script src="{{ asset('frontend/findhouse/js/slick2.js') }}"></script> --}}
  <script src="{{ asset('frontend/findhouse/js/fitvids.js') }}"></script>
  {{-- <script src="{{ asset('frontend/findhouse/js/jquery.waypoints.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('frontend/findhouse/js/jquery.counterup.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('frontend/findhouse/js/imagesloaded.pkgd.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('frontend/findhouse/js/isotope.pkgd.min.js') }}"></script> --}}
  <script src="{{ asset('frontend/findhouse/js/smooth-scroll.min.js') }}"></script>
  <script src="{{ asset('frontend/findhouse/js/lightcase.js') }}"></script>
  {{-- <script src="{{ asset('frontend/findhouse/js/search.js') }}"></script> --}}
  <script src="{{ asset('frontend/findhouse/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('frontend/findhouse/js/ajaxchimp.min.js') }}"></script>
  <script src="{{ asset('frontend/findhouse/js/newsletter.js') }}"></script>
  <script src="{{ asset('frontend/findhouse/js/jquery.validate.min.js') }}"></script>
  {{-- <script src="{{ asset('frontend/findhouse/js/searched.js') }}"></script> --}}
  <script src="{{ asset('frontend/findhouse/js/dashbord-mobile-menu.js') }}"></script>
  {{-- <script src="{{ asset('frontend/findhouse/js/forms-2.js') }}"></script> --}}
  <script src="{{ asset('frontend/findhouse/js/color-switcher.js') }}"></script>
  {{-- <script src="{{ asset('frontend/findhouse/js/dropzone.js') }}"></script> --}}
 <script src="{{ asset('frontend/findhouse/js/toastr.min.js') }}"></script>

 @stack('script')

  <!-- MAIN JS -->
  
  <script>
      $(".header-user-name").on("click", function() {
          $(".header-user-menu ul").toggleClass("hu-menu-vis");
          $(this).toggleClass("hu-menu-visdec");
      });
  </script>
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
