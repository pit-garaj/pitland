$(document).ready(function(){
  const main = new Swiper('.header-slider-main', config('.header-banners-nav__prev', '.header-banners-nav__next'));
  const additional = new Swiper('.header-slider-additional', config('.header-banners-nav__prev', '.header-banners-nav__next', 8000));

  function config(prev, next, delay = 5000) {
    return {
      grabCursor: true,
      loop: true,

      autoplay: {
        delay: delay,
        disableOnInteraction: false,
      },

      effect: "creative",
      creativeEffect: {
        prev: {
          shadow: true,
          translate: ["-20%", 0, -1],
        },
        next: {
          translate: ["100%", 0, 0],
        },
      },

      // Navigation arrows
      navigation: {
        prevEl: prev,
        nextEl: next,
      },
    };
  }
});
