;(function($) {

    "use strict";

    var initLightGallery = function($scope) {
        const galleries = $scope.find('.tf-list-gallery');
        if (typeof lightGallery === 'function') {
            galleries.each(function() {
                lightGallery(this, {
                    selector: '.item-gallery',
                    speed: 500
                });
            });
        } else {
            console.error('lightGallery is not a function');
        }
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/tf-gallery.default', initLightGallery);
    });

})(jQuery);
