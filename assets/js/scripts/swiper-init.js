/**
 * Swiper Slider Initialization
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize main slider
    const mainSlider = document.querySelector('.swiper-main');
    if (mainSlider) {
        new Swiper('.swiper-main', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            }
        });
    }

    // Initialize testimonial slider
    const testimonialSlider = document.querySelector('.swiper-testimonials');
    if (testimonialSlider) {
        new Swiper('.swiper-testimonials', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
        });
    }

    // Initialize gallery slider
    const gallerySlider = document.querySelector('.swiper-gallery');
    if (gallerySlider) {
        new Swiper('.swiper-gallery', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                }
            }
        });
    }

    // Initialize any other sliders with class .swiper
    const otherSliders = document.querySelectorAll('.swiper:not(.swiper-main):not(.swiper-testimonials):not(.swiper-gallery)');
    otherSliders.forEach(function(slider) {
        new Swiper(slider, {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        });
    });
});