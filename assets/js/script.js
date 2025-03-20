

let swiper_whoceTers = new Swiper('.swiper-whoceTers', {
    slidesPerView: 1,
    spaceBetween: 28,
    loop: true,
    reverseDirection: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
        pauseOnFocus: true
    },
    lazy: {
        loadPrevNext: true,  // Загружает соседние изображения
    },
});

// Если прокручено более 10px от верха страницы, .header получает класс .scrolled
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
    document.querySelector('.header').classList.add('scrolled');
  } else {
    document.querySelector('.header').classList.remove('scrolled');
  }
}