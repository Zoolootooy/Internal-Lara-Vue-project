$(document).ready(function() {

    $(window).scroll(function() {
        let scroll = $(window).scrollTop();

        if (scroll >= 50) {
            $(".sticky").addClass("nav-sticky");
        } else {
            $(".sticky").removeClass("nav-sticky");
        }
    });

    $('.logout-link').on('click', function(event) {
        $('#logout-form').submit();
        event.preventDefault();
    });

    $('.navbar-nav a').on('click', function(event) {
        let $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 0
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

$(window).on('load', function () {
    $('#slider-carousel').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        video: true,
        videoWidth: '100%',
        videoHeight: 315,
        onTranslate: function() {
            $('iframe').remove();
        }
    });

    $('#team-carousel').owlCarousel({
        items: 1,
        margin: 24,
        responsive: {
            576: { items:2 },
            768: { items:3 },
            992: { items:4 }
        }
    });
});