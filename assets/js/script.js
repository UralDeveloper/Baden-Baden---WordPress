window.onscroll = function () { scrollFunction() };
function scrollFunction() {
    if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
        document.querySelector('.header').classList.add('scrolled');
    } else {
        document.querySelector('.header').classList.remove('scrolled');
    }
}

let accommodation_slider = new Swiper('.accommodation-slider', {
    rewind: true,
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
        rewind: true,
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
    rewind: true,
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
    script.src = "https://api-maps.yandex.ru/2.1/?apikey=36c289c4-0f45-44b4-984c-b9358615a099&lang=ru_RU";
    script.onload = function () {
        ymaps.ready(initMap);
    };
    document.head.appendChild(script);
}

function initMap() {
    var map = new ymaps.Map("map", { center: [55.751574, 37.573856], zoom: 5 });

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
            } else {
                console.warn("Не найдено:", address);
            }
        }).catch(err => console.error("Ошибка:", err));
    });
}

document.addEventListener("DOMContentLoaded", loadYandexMap);