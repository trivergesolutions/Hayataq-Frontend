$(document).ready(function () {
    /* ================= LANGUAGE DROPDOWN ================= */
    const locales = [
        "en-GB",
        "ar-SA",
        "zh-CN",
        "de-DE",
        "es-ES",
        "fr-FR",
        "hi-IN",
        "it-IT",
        "id-ID",
        "ja-JP",
        "ko-KR",
        "nl-NL",
        "no-NO",
        "pl-PL",
        "pt-BR",
        "sv-SE",
        "fi-FI",
        "th-TH",
        "tr-TR",
        "uk-UA",
        "vi-VN",
        "ru-RU",
        "he-IL",
    ];

    function getFlagSrc(code) {
        return code ? `https://flagsapi.com/${code}/flat/64.png` : "";
    }

    const $dropdownBtn = $("#dropdown-btn");
    const $dropdownContent = $("#dropdown-content");

    function setSelectedLocale(locale) {
        const intlLocale = new Intl.Locale(locale);
        const langName = new Intl.DisplayNames([locale], {
            type: "language",
        }).of(intlLocale.language);

        $dropdownBtn.html(`
      <span class="lang-text">${langName}</span>
      <img src="${getFlagSrc(intlLocale.region)}" class="flaglogo"/>
      <span class="arrow-down"></span>
    `);

        $dropdownContent.empty();

        $.each(locales, function (_, otherLocale) {
            if (otherLocale !== locale) {
                const loc = new Intl.Locale(otherLocale);
                const name = new Intl.DisplayNames([otherLocale], {
                    type: "language",
                }).of(loc.language);

                const $li = $(`
          <li>
            <span>${name}</span>
            <img src="${getFlagSrc(loc.region)}"/>
          </li>
        `);

                $li.on("click", function () {
                    setSelectedLocale(otherLocale);
                });

                $dropdownContent.append($li);
            }
        });
    }
    setSelectedLocale("en-GB");
    const browserLang = navigator.language.split("-")[0];
    $.each(locales, function (_, loc) {
        if (new Intl.Locale(loc).language === browserLang) {
            setSelectedLocale(loc);
        }
    });
    /* ================= DESKTOP MEGA MENU ================= */
    $(".dropdown-mega").hover(
        function () {
            $(this).find(".mega-menu-content").stop(true, true).fadeIn(200);
        },
        function () {
            $(this).find(".mega-menu-content").stop(true, true).fadeOut(200);
        },
    );
    /* ================= Search Expand ================= */
    $(document).on("click", ".search-trigger", function (e) {
        e.stopPropagation();
        $(".header-search").addClass("active");
        $(".header-search input").focus();
    });

    $(document).on("click", function (e) {
        if (!$(e.target).closest(".header-search").length) {
            $(".header-search").removeClass("active");
            $(".header-search input").val("");
        }
    });
    /* ================= PRODUCT IMAGE HOVER ================= */
    $(".product-hover-list .list-group-item").hover(function () {
        $(".product-hover-list .list-group-item").removeClass("active");
        $(this).addClass("active");

        const img1 = $(this).data("img1");
        const img2 = $(this).data("img2");
        const text1 = $(this).data("text1");
        const text2 = $(this).data("text2");

        $("#view-img-1").attr("src", img1);
        $("#view-img-2").attr("src", img2);

        $("#view-text-1").text(text1);
        $("#view-text-2").text(text2);
    });

    const $activeItem = $(".product-hover-list .list-group-item.active");
    if ($activeItem.length) {
        $("#view-img-1").attr("src", $activeItem.data("img1"));
        $("#view-img-2").attr("src", $activeItem.data("img2"));

        $("#view-text-1").text($activeItem.data("text1"));
        $("#view-text-2").text($activeItem.data("text2"));
    }

    /* ================= MOBILE NAV ================= */
    function sidemenu() {
        $(".mobile-nav").toggleClass("slidein");

        if (!$(".mobile-nav .cls-btn").length) {
            $(".mobile-nav").prepend('<div class="cls-btn"></div>');
        }
    }
    $("body").on("click", ".toggle-menu", function () {
        sidemenu();
        $(".overlay").addClass("show");
        $("html").addClass("no-scroll");
    });
    $(".mobile-nav li:has(ul)").prepend(
        '<span><i class="arw-nav bi bi-chevron-down"></i></span>',
    );
    $(".mobile-nav").on("click", "span", function (e) {
        e.stopPropagation();

        let $li = $(this).parent("li");
        let $submenu = $li.children("ul");

        $li.siblings().find("> span, > a").removeClass("actv");
        $li.siblings().find("> ul").slideUp();

        $(this).toggleClass("actv");
        $li.children("a").addClass("actv");
        $submenu.stop(true, true).slideToggle();
    });
    $("body").on("click", ".cls-btn, .overlay", function () {
        $(".mobile-nav").removeClass("slidein");
        $(".overlay").removeClass("show");
        $("html").removeClass("no-scroll");
    });
    /* ================= Industries We Serve slider ================= */
    new Swiper(".industrySlider", {
        speed: 600,
        loop: true,
        centeredSlides: false,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        slidesPerView: "auto",
        navigation: {
            nextEl: ".industry-part .next_btn",
            prevEl: ".industry-part .prev_btn",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 40,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 0,
            },
        },
    });
    /* ================= About Tab ================= */
    $(document).ready(function () {
        $(".tab-link").click(function () {
            var tab_id = $(this).attr("data-tab");
            $(".tab-link").removeClass("active");
            $(".tab-content").removeClass("current");
            $(this).addClass("active");
            $("#" + tab_id).addClass("current");
        });
    });
    /* ================= Applications of Our Tools and Equipment ================= */
    new Swiper(".applicationSwiper", {
        speed: 600,
        loop: true,
        centeredSlides: false,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        slidesPerView: "auto",
        navigation: {
            nextEl: ".all-application .next_btn",
            prevEl: ".all-application .prev_btn",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 40,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 21,
            },
        },
    });
    /* ================= contact tab ================= */
    $(document).ready(function () {
        $(".tab-item").click(function (e) {
            e.preventDefault();
            e.stopPropagation();

            let target = $(this).data("target");

            $(".tab-item").removeClass("active");
            $(this).addClass("active");

            $(".form-box").removeClass("active");
            $("#" + target).addClass("active");
        });
    });
    /* ================= Service part ================= */
    $(document).ready(function () {
        var $window = $(window);
        var $form = $(".service-form");
        var $section = $(".services");
        var $parentCol = $form.closest(".col-lg-5");

        var sideMargin = 12;
        var topGap = 20;

        var formStart = $form.offset().top;
        var sectionTop = $section.offset().top;

        $window.on("scroll resize", function () {
            var scrollTop = $window.scrollTop();
            var sectionHeight = $section.outerHeight();
            var formHeight = $form.outerHeight();

            var parentOffset = $parentCol.offset();
            var parentWidth = $parentCol.outerWidth();

            var sectionBottom = sectionTop + sectionHeight;
            var stopPoint = sectionBottom - formHeight - topGap;

            if (scrollTop > formStart - topGap && scrollTop < stopPoint) {
                $form
                    .removeClass("stopped")
                    .addClass("fixed")
                    .css({
                        width: parentWidth - sideMargin * 2,
                        left: parentOffset.left + sideMargin,
                    });
            } else if (scrollTop >= stopPoint) {
                $form
                    .removeClass("fixed")
                    .addClass("stopped")
                    .css({
                        width: parentWidth - sideMargin * 2,
                        left: "",
                    });
            } else {
                $form.removeClass("fixed stopped").css({
                    width: "",
                    left: "",
                });
            }
        });
    });
    /* ================= Search bar ================= */
    $(document).ready(function () {
        $("#search-input").on("focus", function () {
            $(".search-container").addClass("active");
        });
        $("#search-input").on("blur", function () {
            $(".search-container").removeClass("active");
        });
        $("#search-input").on("keypress", function (e) {
            if (e.which == 13) {
                let query = $(this).val();
                if (query !== "") {
                    alert("Searching for: " + query);
                }
            }
        });
    });
    /* ================= Copy Right Date Change ================= */
    $(document).ready(function () {
        var itemsToShow = 6;
        var itemsToLoad = 6;
        var $container = $("#clamshell-cutters");
        var $products = $container.find(".product-item");
        var totalItems = $products.length;
        $products.hide();
        $products.slice(0, itemsToShow).show();
        if (totalItems <= itemsToShow) {
            $container.find(".load-more").hide();
        }
        $container.find(".load-more").on("click", function (e) {
            e.preventDefault();
            var visibleItems = $container.find(".product-item:visible").length;
            $products.slice(visibleItems, visibleItems + itemsToLoad).fadeIn();
            var currentVisible = $container.find(
                ".product-item:visible",
            ).length;
            if (currentVisible >= totalItems) {
                $(this).fadeOut();
            }
        });
    });
    /* ================= Product details ================= */
    $(document).ready(function () {
        let currentIndex = 0;
        const totalImages = $(".thumb").length;
        const slideTime = 5000;
        let slideInterval;

        function startSlider() {
            $(".bar-item .fill").stop().css("width", "0%");
            $(".bar-item")
                .eq(currentIndex)
                .find(".fill")
                .animate(
                    {
                        width: "100%",
                    },
                    slideTime,
                    "linear",
                    function () {
                        nextSlide();
                    },
                );
        }
        function changeImage(index) {
            currentIndex = index;
            const newSrc = $(".thumb").eq(currentIndex).find("img").attr("src");
            $("#mainImage").fadeOut(200, function () {
                $(this).attr("src", newSrc).fadeIn(200);
            });
            $(".thumb").removeClass("active");
            $(".thumb").eq(currentIndex).addClass("active");
            $(".bar-item .fill").stop().css("width", "0%");
            $(".bar-item:lt(" + currentIndex + ") .fill").css("width", "100%");

            startSlider();
        }
        function nextSlide() {
            currentIndex++;
            if (currentIndex >= totalImages) {
                currentIndex = 0;
            }
            changeImage(currentIndex);
        }
        $(".thumb").on("click", function () {
            let index = $(this).data("index");
            changeImage(index);
        });
        startSlider();
    });
    /* ================= download pdf product details ================= */
    $(document).ready(function () {
        $(".btn.download").on("click", function (e) {
            e.preventDefault();

            const link = $("<a>")
                .attr("href", "assests/pdf/sample-local-pdf.pdf")
                .attr("download", "Catalogue.pdf");

            $("body").append(link);
            link[0].click();
            link.remove();
        });
    });
    /* ================= Product swiper ================= */
    // new Swiper(".productSwiper", {
    //     speed: 600,
    //     loop: true,
    //     centeredSlides: false,
    //     autoplay: {
    //         delay: 5000,
    //         disableOnInteraction: false,
    //     },
    //     slidesPerView: "auto",
    //     navigation: {
    //         nextEl: ".all-products .next_btn",
    //         prevEl: ".all-products .prev_btn",
    //     },
    //     breakpoints: {
    //         320: {
    //             slidesPerView: 1,
    //             spaceBetween: 40,
    //         },
    //         768: {
    //             slidesPerView: 2,
    //             spaceBetween: 20,
    //         },
    //         1200: {
    //             slidesPerView: 4,
    //             spaceBetween: 10,
    //         },
    //     },
    // });

    const productSlides = document.querySelectorAll(
        ".productSwiper .swiper-slide",
    ).length;

    new Swiper(".productSwiper", {
        speed: 600,
        loop: productSlides > 4, // agar slides 4 se zyada ho tabhi loop
        centeredSlides: false,
        autoplay:
            productSlides > 4
                ? {
                      delay: 5000,
                      disableOnInteraction: false,
                  }
                : false,
        slidesPerView: "auto",
        navigation: {
            nextEl: ".all-products .next_btn",
            prevEl: ".all-products .prev_btn",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 40,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
        },
    });
    /* ================= Copy Right Date Change ================= */
    document.getElementById("year").textContent = new Date().getFullYear();
});
