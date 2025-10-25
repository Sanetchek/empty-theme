jQuery(function ($) {
    const $slider = $('.testimonials__slider');

    $slider.slick({
        infinite: true,
        variableWidth: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        swipeToSlide: true,
        centerMode: false,
        arrows: true,
        prevArrow: $('.testimonials__nav-btn--prev'),
        nextArrow: $('.testimonials__nav-btn--next'),
        speed: 600,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    centerMode: true,
                }
            }
        ]
    });
});
