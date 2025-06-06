// window.onscroll = function () { scrollFunction() };
// function scrollFunction() {
//     if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
//         document.querySelector('.header').classList.add('scrolled');
//     } else {
//         document.querySelector('.header').classList.remove('scrolled');
//     }
// }

(function(w) {
    // Получаем элемент по идентификатору и берем значение атрибута data-travelLine-id
    const travelSection = document.querySelector('#travelline');
    const contextId = travelSection.dataset.travelline;
    
    // console.log(travelSection.dataset.travelline);
    

    var q = [
        ["setContext", contextId, "ru"],   // Используем динамический контекст
        ["embed", "search-form", {
            container: "tl-search-form"
        }]
    ];
    

    var h = ["ru-ibe.tlintegration.ru", "ibe.tlintegration.ru", "ibe.tlintegration.com"];
    var t = w.travelline = (w.travelline || {}),
        ti = t.integration = (t.integration || {});
    ti.__cq = ti.__cq ? ti.__cq.concat(q) : q;
    if (!ti.__loader) {
        ti.__loader = true;
        var d = w.document,
            c = d.getElementsByTagName("head")[0] || d.getElementsByTagName("body")[0];
        
        function e(s, f) {
            return function() {
                w.TL || (c.removeChild(s), f())
            };
        }
        
        (function l(h) {
            if (0 === h.length) return;
            var s = d.createElement("script");
            s.type = "text/javascript";
            s.async = !0;
            s.src = "https://" + h[0] + "/integration/loader.js";
            s.onerror = s.onload = e(s, function() {
                l(h.slice(1, h.length))
            });
            c.appendChild(s);
        })(h);
    }
})(window);

let accommodation_slider = new Swiper('.accommodation-slider', {
    loop: true,
    autoplay: {
        delay: 4000,
    },
    slidesPerView: 1,
    spaceBetween: 12,
});

document.querySelectorAll('.whoceTers-slider').forEach(slider => {
    let perPage = 1;
    if (slider.querySelector('.swiper-slide.photoSize-1x1')) {
        perPage = 3;
    }
    new Swiper(slider, {
        loop: true,
        autoplay: {
            delay: 4000,
        },
        slidesPerView: parseInt(perPage, 10),
        spaceBetween: 12,
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            720: {
                slidesPerView: parseInt(perPage, 10),
            }
        }
    });
});

let galleryCarousel_swiper = new Swiper('.galleryCarousel-carousel', {
    loop: true,
    autoplay: {
        delay: 4000,
    },
    slidesPerView: 1,
    spaceBetween: 12,
});

document.addEventListener("DOMContentLoaded", function () {
    let tabLinks = document.querySelectorAll("#pills-tab .nav-tab");

    tabLinks.forEach(link => {
        link.addEventListener("shown.bs.tab", function (event) {
            let targetId = event.target.getAttribute("href").replace("#", "");
            let correspondingTab = document.querySelector(`#pills-tabContent-slides #${targetId}-slide`);

            if (correspondingTab) {
                document.querySelectorAll("#pills-tabContent-slides .tab-pane").forEach(tab => {
                    tab.classList.remove("show", "active");
                });
                correspondingTab.classList.add("show", "active");
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".whoceTers").forEach(section => {
        let tabLinks = section.querySelectorAll(".nav-tab");

        tabLinks.forEach(link => {
            link.addEventListener("click", function (event) {
                event.preventDefault(); // Предотвращаем добавление #id в URL
            });

            link.addEventListener("shown.bs.tab", function (event) {
                let targetId = event.target.getAttribute("href").replace("#", "");

                let slidesContainer = section.querySelector(".whoceTers__content");
                if (!slidesContainer) return;

                let correspondingTab = slidesContainer.querySelector(`#${targetId}-slide`);

                if (correspondingTab) {
                    slidesContainer.querySelectorAll(".tab-pane").forEach(tab => {
                        tab.classList.remove("show", "active");
                    });
                    correspondingTab.classList.add("show", "active");
                }
            });
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".specialOffers .nav-tab");
    const swiperWrapper = document.querySelector(".specialOffers .swiper-wrapper");
    let swiper;
    let allSlides = Array.from(document.querySelectorAll(".specialOffers .swiper-slide-original")); // Все слайды

    // Функция создания Swiper
    function initSwiper() {
        if (swiper) {
            swiper.destroy(true, true); // Уничтожаем старый Swiper
        }

        swiper = new Swiper(".specialOffers .specialOffers__wrapper", {
            slidesPerView: 4,
            spaceBetween: 20,
            rewind: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                720: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 4,
                }

            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    }

    // Фильтрация слайдов
    function filterSlides(category) {
        swiperWrapper.innerHTML = ""; // Очищаем контейнер слайдов

        // Добавляем только те слайды, которые соответствуют категории
        allSlides.forEach(slide => {
            const slideCategory = slide.getAttribute("data-category");
            if (category === "Все" || slideCategory === category) {
                swiperWrapper.appendChild(slide); // Добавляем слайд обратно в контейнер
            }
        });

        // Ожидаем обновления DOM и затем обновляем слайдер
        setTimeout(() => {
            swiper.update();  // Полное обновление слайдера
            swiper.updateSize();  // Обновляем размер
            swiper.updateSlides();  // Обновляем количество слайдов
        }, 50); // Маленькая задержка для того, чтобы DOM успел обновиться
    }

    // Обработчик кликов по фильтрам
    filterButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const category = this.getAttribute("data-category");

            filterButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");

            filterSlides(category); // Применяем фильтр и обновляем слайдер
        });
    });

    // Инициализация Swiper при загрузке страницы
    initSwiper();
});

function loadYandexMap() {
    let script = document.createElement("script");
    script.src = "https://api-maps.yandex.ru/2.1/?apikey=b02b13e1-0fc9-4992-9a3c-fce37930b249&lang=ru_RU";
    script.onload = function () {
        ymaps.ready(initMap);
    };
    document.head.appendChild(script);
}

function initMap() {
    var map = new ymaps.Map("map", {
        center: [55.751574, 37.573856], // временный центр
        zoom: 14
    });

    let isFirst = true;

    document.querySelectorAll(".location_address").forEach(element => {
        var address = element.textContent.trim();
        console.log("Геокодируем:", address);

        ymaps.geocode(address).then(res => {
            var firstGeoObject = res.geoObjects.get(0);
            if (firstGeoObject) {
                var coords = firstGeoObject.geometry.getCoordinates();
                console.log("Добавляем маркер на", coords);

                var placemark = new ymaps.Placemark(coords, { balloonContent: address });
                map.geoObjects.add(placemark);

                // Центрируем по первому успешному адресу
                if (isFirst) {
                    map.setCenter(coords);
                    isFirst = false;
                }
            } else {
                console.warn("Не найдено:", address);
            }
        }).catch(err => console.error("Ошибка:", err));
    });
}


document.addEventListener("DOMContentLoaded", loadYandexMap);

document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = document.querySelectorAll('.dropdown-toggle');

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function (e) {
            // Отменяем открытие по клику
            if (window.innerWidth >= 992) {
                e.preventDefault();
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    let gallerySliders = document.querySelectorAll('.spaGrid__grid--mobile .swiper');

    gallerySliders.forEach((slider, index) => {
        new Swiper(slider, {
            // Настройки Swiper для каждого слайдера
            rewind: true,
            spaceBetween: 12,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false
            },
            speed: 1500,
            pagination: {
                el: `.swiper-pagination-${index}`,
                clickable: true,
            },
            navigation: {
                nextEl: `.swiper-button-next-${index}`,
                prevEl: `.swiper-button-prev-${index}`,
            },
        });
    });
});