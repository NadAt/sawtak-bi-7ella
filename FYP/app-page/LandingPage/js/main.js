(function () {
    "use strict";


    jQuery(document).ready(function ($) {

        new WOW().init();
        $("#owl-example").owlCarousel({
            items: 3,
            itemsDesktop:[1199,3],
            itemsDesktopSmall:[979,2],
            itemsTablet: [768,1],
            autoPlay: true,
            pagination: false,
            navigation: true,
            navigationText: ["<i class='fa fa-angle-left'>", "<i class='fa fa-angle-right'>"]
        });
        $("a.smooth-scroll").bind("click", function(event){
            var $anchor = $(this);
            var headerH = "";
            $("html, body")
                .stop()
                .animate({
                    scrollTop: $($anchor.attr("href"))
                        .offset()
                        .top - headerH + "px"
                }, 1200, "easeOutCirc");

            event.preventDefault();

        });
/* sticky menu*/
        $(".navi").sticky({
            topSpacing:0
        });
        //jquery scroll spy
        $("body").scrollspy({
            target: ".navbar-collapse",
            offset: 95
        });
    });


    jQuery(window).load(function () {


    });


}(jQuery));
