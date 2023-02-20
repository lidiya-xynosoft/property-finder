 <!-- ARCHIVES JS -->
 <script src="{{ asset('frontend/findhouse/js/jquery-3.5.1.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/rangeSlider.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/tether.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/moment.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/mmenu.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/mmenu.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/aos.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/aos2.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/animate.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/slick.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/fitvids.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/jquery.waypoints.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/typed.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/jquery.counterup.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/imagesloaded.pkgd.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/isotope.pkgd.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/smooth-scroll.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/lightcase.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/search.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/owl.carousel.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/jquery.magnific-popup.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/ajaxchimp.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/newsletter.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/jquery.form.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/jquery.validate.min.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/searched.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/forms-2.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/map-style2.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/range.js') }}"></script>
 <script src="{{ asset('frontend/findhouse/js/color-switcher.js') }}"></script>
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
 <script>
     var typed = new Typed('.typed', {
         strings: ["House ^2000", "Apartment ^2000", "Plaza ^4000"],
         smartBackspace: false,
         loop: true,
         showCursor: true,
         cursorChar: "|",
         typeSpeed: 50,
         backSpeed: 30,
         startDelay: 800
     });
 </script>

 <script>
     $('.slick-lancers').slick({
         infinite: false,
         slidesToShow: 4,
         slidesToScroll: 1,
         dots: true,
         arrows: false,
         adaptiveHeight: true,
         responsive: [{
             breakpoint: 1292,
             settings: {
                 slidesToShow: 2,
                 slidesToScroll: 2,
                 dots: true,
                 arrows: false
             }
         }, {
             breakpoint: 993,
             settings: {
                 slidesToShow: 2,
                 slidesToScroll: 2,
                 dots: true,
                 arrows: false
             }
         }, {
             breakpoint: 769,
             settings: {
                 slidesToShow: 1,
                 slidesToScroll: 1,
                 dots: true,
                 arrows: false
             }
         }]
     });
 </script>

 <script>
     $('.job_clientSlide').owlCarousel({
         items: 2,
         loop: true,
         margin: 30,
         autoplay: false,
         nav: true,
         smartSpeed: 1000,
         slideSpeed: 1000,
         navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
         dots: false,
         responsive: {
             0: {
                 items: 1
             },
             991: {
                 items: 3
             }
         }
     });
 </script>

 <script>
     $('.style2').owlCarousel({
         loop: true,
         margin: 0,
         dots: false,
         autoWidth: false,
         autoplay: true,
         autoplayTimeout: 5000,
         responsive: {
             0: {
                 items: 2,
                 margin: 20
             },
             400: {
                 items: 2,
                 margin: 20
             },
             500: {
                 items: 3,
                 margin: 20
             },
             768: {
                 items: 4,
                 margin: 20
             },
             992: {
                 items: 5,
                 margin: 20
             },
             1000: {
                 items: 7,
                 margin: 20
             }
         }
     });
 </script>

 <script>
     $(".dropdown-filter").on('click', function() {

         $(".explore__form-checkbox-list").toggleClass("filter-block");

     });
 </script>

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
