(function($) {

    "use strict";

    $('.js-example-basic-single').select2();

    $( "#datepicker" ).datepicker({
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

    $(document).ready(function () {

        /* Slicknav */
        $('#nav').slicknav();

        $('.gal-photo').magnificPopup({
            gallery: {
              enabled: true
            },
            type: 'image'
        });

        $('.gal-video').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });

        // Slider
        $('.slide-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 0,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            dots: true,
            nav: true,
            navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });

        $('.slide-carousel').on('translate.owl.carousel', function () {
            $('.text-animated h1').removeClass('fadeInDown animated').hide();
            $('.text-animated p').removeClass('fadeInUp animated').hide();
            $('.text-animated li').removeClass('fadeInUp animated').hide();
        });

        $('.slide-carousel').on('translated.owl.carousel', function () {
            $('.text-animated h1').addClass('fadeInDown animated').show();
            $('.text-animated p').addClass('fadeInUp animated').show();
            $('.text-animated li').addClass('fadeInUp animated').show();
        });

        $('.testimonial-2').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            margin: 20,
            mouseDrag: true,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            nav: true,
            navText: ["<i class='fa fa-angle-double-left'></i>", "<i class='fa fa-angle-double-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        });

        $('.partner').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            margin: 20,
            mouseDrag: true,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            nav: true,
            navText: ["<i class='fa fa-angle-double-left'></i>", "<i class='fa fa-angle-double-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });

        $('.photo-list').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            mouseDrag: true,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            nav: false,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
        
        /* Scroll-Top */
        $(".scroll").hide();
        $(window).on('scroll',function () {
            if ($(this).scrollTop() > 300) {
                $(".scroll").fadeIn();
            } else {
                $(".scroll").fadeOut();
            }
        });

        $(".scroll").on('click',function () {
            $("html, body").animate({
                scrollTop: 0,
            }, 550)
        });
        
        $('.page-banner').parallax("70%", 0.3);

        $('.collapse').collapse();

    });

})(jQuery);