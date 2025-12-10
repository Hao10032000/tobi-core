(function($){

    function tf_list_image($scope){

        let $carousel = $scope.find('.tf-list-image .owl-carousel');
        if (!$carousel.length) return;

        $carousel.each(function(){

            let $c = $(this);

            let showNav   = $c.data('nav') === true || $c.data('nav') === "true";
            let margin    = parseInt($c.data('margin')) || 10;

            let itemsDesktop = parseInt($c.data('desktop')) || 4;
            let itemsTablet  = parseInt($c.data('tablet'))  || 3;
            let itemsMobile  = parseInt($c.data('mobile'))  || 2;

            $c.owlCarousel({
                loop: true,
                autoWidth: true,
                 autoplay: true,
                margin: margin,
                nav: showNav,
                navText: [
                    $scope.find('.nav-prev'),
                    $scope.find('.nav-next')
                ],
                responsive:{
                    0: { items: itemsMobile },
                    768:{ items: itemsTablet },
                    1024:{ items: itemsDesktop }
                }
            });

        });

    }

    $(window).on("elementor/frontend/init", function(){
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tf-list-image.default",
            tf_list_image
        );
    });

})(jQuery);

