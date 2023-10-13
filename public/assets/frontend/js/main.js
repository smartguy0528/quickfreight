var Main = {
    /**
     *  Initialize DOM
     */
    // Initial Alert
    successMsg: $("#successMsg"),
    errorMsg: $(".errorMsg"),

    /**
     *  Initialize Functions
     */
    successAlert: function (msg) {
        Toastify({
            text: msg,
            duration: 5000,
            close:true,
            gravity:"bottom",
            position: "right",
            backgroundColor: "#01ba49",
        }).showToast();
    },

    errorAlert: function (msg) {
        Toastify({
            text: msg,
            duration: 5000,
            close:true,
            gravity:"bottom",
            position: "right",
            backgroundColor: "#ff4b4b",
        }).showToast();
    },

    /* 4. MainSlider-1 */
    mainSlider: function () {
        var BasicSlider = $('.slider-active');
        BasicSlider.on('init', function (e, slick) {
            var $firstAnimatingElements = $('.single-slider:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);
        });
        BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('.single-slider[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
            doAnimations($animatingElements);
        });
        BasicSlider.slick({
            autoplay: true,
            autoplaySpeed: 5000,
            dots: false,
            fade: true,
            arrows: false,
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }
            ]
        });

        function doAnimations(elements) {
            var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            elements.each(function () {
                var $this = $(this);
                var $animationDelay = $this.data('delay');
                var $animationType = 'animated ' + $this.data('animation');
                $this.css({
                    'animation-delay': $animationDelay,
                    '-webkit-animation-delay': $animationDelay
                });
                $this.addClass($animationType).one(animationEndEvents, function () {
                    $this.removeClass($animationType);
                });
            });
        }
    },

    // Initialize application
    init: function () {
        /* 1. Proloder */
        $(window).on('load', function () {
            $('#preloader-active').delay(450).fadeOut('slow');
            $('body').delay(450).css({
                'overflow': 'visible'
            });
        });

        /* 2. sticky And Scroll UP */
        $(window).on('scroll', function () {
            var scroll = $(window).scrollTop();
            if (scroll < 400) {
                $(".header-sticky").removeClass("sticky-bar");
                $('#back-top').fadeOut(500);
            } else {
                $(".header-sticky").addClass("sticky-bar");
                $('#back-top').fadeIn(500);
            }
        });

        // Scroll Up
        $('#back-top a').on("click", function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

        /* 3. slick Nav */
        // mobile_menu
        var menu = $('ul#navigation');
        if (menu.length) {
            menu.slicknav({
                prependTo: ".mobile_menu",
                closedSymbol: '+',
                openedSymbol: '-'
            });
        };

        /* 4. MainSlider-1 */
        // h1-hero-active
        Main.mainSlider();

        /* 5. Testimonial Active*/
        var testimonial = $('.h1-testimonial-active');
        if (testimonial.length) {
            testimonial.slick({
                dots: false,
                infinite: true,
                speed: 1000,
                autoplay: true,
                loop: true,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false,
                            arrow: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                        }
                    }
                ]
            });
        }

        /* 6. Nice Selectorp  */
        var nice_Select = $('select');
        if (nice_Select.length) {
            nice_Select.niceSelect();
        }

        /* 7. data-background */
        $("[data-background]").each(function () {
            $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
        });

        //8. Overlay
        $(".snake").snakeify({
            speed: 200
        });

        //9. Toaster alert
        // Success alert
        if(Main.successMsg.text()) {
            Main.successAlert(Main.successMsg.text());
        };

        // Error alerts
        Main.errorMsg.each(function (index, element) {
           Main.errorAlert(element.value);
        });
    }
}

Main.init();
