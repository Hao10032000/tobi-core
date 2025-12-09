;(function($) {

    "use strict";

    var isCarouselInitialized = false;

    var projectCarousel = function() {
        if (window.innerWidth <= 991 && !isCarouselInitialized) {
            if ($().owlCarousel) {
                $('.tf-project-wrap .owl-carousel').each(function() {
                    var
                    $this = $(this),
                    item = $this.data("column"),
                    item2 = $this.data("column2"),
                    item3 = $this.data("column3"),
                    spacer = $this.data("spacer");

                    var loop = ($this.data("loop") == 'yes');
                    var bullets = ($this.data("bullets") == 'yes');
                    var auto = ($this.data("auto") == 'yes');
                    var arrow = false;

                    $this.owlCarousel({
                        loop: loop,
                        margin: spacer,
                        nav: arrow,
                        items:item,
                        slideBy: 2,
                        dots: bullets,
                        autoplay: auto,
                        autoplayTimeout: 5000,
                        smartSpeed: 850,
                        autoplayHoverPause: true,
                        responsive: {
                            0:{
                                items:item3,
                                dots: true
                            },
                            768:{
                                items:item2,
                            },
                            1000:{
                                items:item
                            }
                        }
                    });
                });

                isCarouselInitialized = true;
            }
        }
        else if (window.innerWidth > 991 && isCarouselInitialized) {
            $('.tf-project-wrap .owl-carousel').trigger('destroy.owl.carousel');
            isCarouselInitialized = false;
        }
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/tf-project.default', projectCarousel);
    });

    $(window).on('resize', function() {
        projectCarousel();
    });

})(jQuery);
