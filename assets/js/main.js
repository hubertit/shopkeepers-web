(function ($) {
  ("use strict");
  ////////////////////////////////////////////////////
  // 01. PreLoader Js
  $(window).on('load', function () {
    $("#loading").fadeOut(500);
  });
  // meanmenu
  $("#mobile-menu").meanmenu({
    meanMenuContainer: ".mobile-menu",
    meanScreenWidth: "991",
  });
  // cart quantity

  // cart-plus-minus
  $(".cart-plus-minus").append('<div class="qtybutton minus">-</div><div class="qtybutton plus">+</div>');

  $(".cart-plus-minus").on("click", ".qtybutton.plus, .qtybutton.minus", function () {
    // Get current quantity values
    var qty = $(this).closest(".cart-plus-minus").find(".qty");
    var val = parseFloat(qty.val());
    var max = parseFloat(qty.attr("max"));
    var min = parseFloat(qty.attr("min"));
    var step = parseFloat(qty.attr("step"));

    // Change the value if plus or minus
    if ($(this).is(".plus")) {
      if (max && max <= val) {
        qty.val(max);
      }
      else {
        qty.val(val + step).trigger("change");
      }
    }
    else {
      if (min && min >= val) {
        qty.val(min);
      }
      else if (val > 1) {
        qty.val(val - step).trigger("change");
      }
    }
  });

  // 55. Cart Plus Minus Js
  $('.cart-minus').click(function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $('.cart-plus').click(function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });

  // var num = 1;
  // $('.epix-quantity-form input, .epix-p-quantity input').val(num);
  // $('.epix-quantity-form .plus, .epix-p-quantity .epix-price-increment').on('click',function() {
  //   num+=1;
  //   $('.epix-quantity-form input, .epix-p-quantity input').val(num);
  // })
  // $('.epix-quantity-form .minus, .epix-p-quantity .epix-price-decrement').on('click',function() {
  //   if(num>1) {
  //     num-=1;
  //     $('.epix-quantity-form input, .epix-p-quantity input').val(num);
  //   } else {
  //     num = 1;
  //     $('.epix-quantity-form input, .epix-p-quantity input').val(num);
  //   }
  // })

  // window scroll
  $(window).on("scroll", function () {
    var scroll = $(window).scrollTop();
    if (scroll < 245) {
      $(".header-sticky").removeClass("sticky");
    } else {
      $(".header-sticky").addClass("sticky");
    }
  });

  // nice select
  $("select").niceSelect();

  // mainSlider
  function mainSlider() {
    var BasicSlider = $(".slider-active");
    BasicSlider.on("init", function (e, slick) {
      var $firstAnimatingElements = $(".single-slider:first-child").find(
        "[data-animation]"
      );
      doAnimations($firstAnimatingElements);
    });
    BasicSlider.on(
      "beforeChange",
      function (e, slick, currentSlide, nextSlide) {
        var $animatingElements = $(
          '.single-slider[data-slick-index="' + nextSlide + '"]'
        ).find("[data-animation]");
        doAnimations($animatingElements);
      }
    );
    BasicSlider.slick({
      autoplay: false,
      autoplaySpeed: 10000,
      dots: false,
      fade: true,
      arrows: false,
      responsive: [
        { breakpoint: 767, settings: { dots: false, arrows: false } },
      ],
    });

    function doAnimations(elements) {
      var animationEndEvents =
        "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
      elements.each(function () {
        var $this = $(this);
        var $animationDelay = $this.data("delay");
        var $animationType = "animated " + $this.data("animation");
        $this.css({
          "animation-delay": $animationDelay,
          "-webkit-animation-delay": $animationDelay,
        });
        $this.addClass($animationType).one(animationEndEvents, function () {
          $this.removeClass($animationType);
        });
      });
    }
  }
  mainSlider();
  /*------------------------------------
        Slider
  --------------------------------------*/
  if (jQuery(".slider-active-2").length > 0) {
    let sliderActive1 = ".slider-active-2";
    let sliderInit1 = new Swiper(sliderActive1, {
      // Optional parameters
      slidesPerView: 1,
      slidesPerColumn: 1,
      paginationClickable: true,
      loop: false,
      effect: "fade",

      autoplay: {
        delay: 5000,
      },

      // If we need pagination
      pagination: {
        el: ".swiper-paginations",
        // dynamicBullets: true,
        clickable: true,
      },

      // Navigation arrows
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },

      a11y: false,
    });

    function animated_swiper(selector, init) {
      let animated = function animated() {
        $(selector + " [data-animation]").each(function () {
          let anim = $(this).data("animation");
          let delay = $(this).data("delay");
          let duration = $(this).data("duration");

          $(this)
            .removeClass("anim" + anim)
            .addClass(anim + " animated")
            .css({
              webkitAnimationDelay: delay,
              animationDelay: delay,
              webkitAnimationDuration: duration,
              animationDuration: duration,
            })
            .one(
              "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
              function () {
                $(this).removeClass(anim + " animated");
              }
            );
        });
      };
      animated();
      // Make animated when slide change
      init.on("slideChange", function () {
        $(sliderActive1 + " [data-animation]").removeClass("animated");
      });
      init.on("slideChange", animated);
    }

    animated_swiper(sliderActive1, sliderInit1);
  }

  /* magnificPopup img view */
  $(".popup-image").magnificPopup({
    type: "image",
    gallery: {
      enabled: true,
    },
  });

  /* magnificPopup video view */
  $(".popup-video").magnificPopup({
    type: "iframe",
  });

  // Data-background
  $("[data-background]").each(function () {
    $(this).css(
      "background-image",
      "url(" + $(this).attr("data-background") + ")"
    );
  });

  $("[data-bg-color]").each(function () {
    $(this).css("background-color", $(this).attr("data-bg-color"));
  });
  $("[data-width]").each(function () {
    $(this).css("width", $(this).attr("data-width"));
  });

  // isotop

  // isotop activation
  $(".portfolio_area").imagesLoaded(function () {
    // init Isotope
    var $grid = $(".portfolio_items").isotope({
      itemSelector: ".portfolio_item",
      percentPosition: true,
      masonry: {
        // use outer width of grid-sizer for columnWidth
        columnWidth: 1,
      },
    });

    // filter items on button click
    $(".portfolio_nav").on("click", "button", function () {
      var filterValue = $(this).attr("data-filter");
      $grid.isotope({ filter: filterValue });
    });
  });

  //for menu active class
  $(".portfolio_nav button").on("click", function (event) {
    $(this).siblings(".active").removeClass("active");
    $(this).addClass("active");
    event.preventDefault();
  });

  // scrollToTop
  $.scrollUp({
    scrollName: "scrollUp", // Element ID
    topDistance: "300", // Distance from top before showing element (px)
    topSpeed: 300, // Speed back to top (ms)
    animation: "fade", // Fade, slide, none
    animationInSpeed: 200, // Animation in speed (ms)
    animationOutSpeed: 200, // Animation out speed (ms)
    scrollText: '<i class="icofont icofont-long-arrow-up"></i>', // Text for element
    activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
  });

  // WOW active
  new WOW().init();

  //Adding class on visibility

  $.fn.visible = function (partial) {
    var $t = $(this),
      $w = $(window),
      viewTop = $w.scrollTop(),
      viewBottom = viewTop + $w.height(),
      _top = $t.offset().top,
      _bottom = _top + $t.height(),
      compareTop = partial === true ? _bottom : _top,
      compareBottom = partial === true ? _top : _bottom;

    return compareBottom <= viewBottom && compareTop >= viewTop;
  };

  $.fn.visible = function (partial) {
    var $t = $(this),
      $w = $(window),
      viewTop = $w.scrollTop(),
      viewBottom = viewTop + $w.height(),
      _top = $t.offset().top,
      _bottom = _top + $t.height(),
      compareTop = partial === true ? _bottom : _top,
      compareBottom = partial === true ? _top : _bottom;

    return compareBottom <= viewBottom && compareTop >= viewTop;
  };

  $(window).on("scroll", function (event) {
    $(".scale-img-animation-left").each(function (i, el) {
      var el = $(el);
      if (el.visible(true)) {
        el.addClass("img-animation-left");
      } else {
        el.removeClass("img-animation-left");
      }
    });
    $(".scale-img-animation-right").each(function (i, el) {
      var el = $(el);
      if (el.visible(true)) {
        el.addClass("img-animation-right");
      } else {
        el.removeClass("img-animation-right");
      }
    });

    $(".top_right_visible").each(function (i, el) {
      var el = $(el);
      if (el.visible(true)) {
        el.addClass("top_right_visible_animation");
      } else {
        el.removeClass("top_right_visible_animation");
      }
    });

    $(".width_visible").each(function (i, el) {
      var el = $(el);
      if (el.visible(true)) {
        el.addClass("width_visible_animation");
      } else {
        el.removeClass("width_visible_animation");
      }
    });
  });
  //   product carousel
  const swiper = new Swiper(".d-product-active", {
    // Optional parameters
    slidesPerView: 4,
    spaceBetween: 30,
    loop: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 3,
      },
      1200: {
        slidesPerView: 3,
      },
      1400: {
        slidesPerView: 4,
      },
    },
  });
  //   product active
  const product = new Swiper(".product-active", {
    // Optional parameters
    slidesPerView: 5,
    spaceBetween: 30,
    loop: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination-product",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next-product",
      prevEl: ".swiper-button-prev-product",
    },

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 3,
      },
      1200: {
        slidesPerView: 4,
      },
      1400: {
        slidesPerView: 5,
      },
    },
  });
  const testimoinal_active = new Swiper(".testimonial-active", {
    // Optional parameters
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination-product",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next-product",
      prevEl: ".swiper-button-prev-product",
    },

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    }
  });
  // category shop active
  const category = new Swiper(".c-shop-active", {
    // Optional parameters
    slidesPerView: 6,
    spaceBetween: 30,
    loop: true,
    navigation: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination-category",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    observer: true,
    observeParents: true,

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 3,
      },
      1200: {
        slidesPerView: 5,
      },
      1400: {
        slidesPerView: 6,
      },
    },
  });
  const accessories = new Swiper(".accessories-active", {
    // Optional parameters
    slidesPerView: 3,
    spaceBetween: 10,
    loop: true,
    navigation: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination-category",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".accessories-button-next-1",
      prevEl: ".accessories-button-prev-1",
    },
    observer: true,
    observeParents: true,

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      576: {
        slidesPerView: 3,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
      992: {
        slidesPerView: 1,
      },
      1200: {
        slidesPerView: 3,
      },
      1400: {
        slidesPerView: 3,
      },
    },
  });
  const product_tab = new Swiper(".tab-product-active", {
    // Optional parameters
    slidesPerView: 5,
    spaceBetween: 0,
    loop: true,
    navigation: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination-category",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".accessories-button-next-1",
      prevEl: ".accessories-button-prev-1",
    },
    observer: true,
    observeParents: true,

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      1200: {
        slidesPerView: 5,
        spaceBetween: 30,
      },
      1400: {
        slidesPerView: 5,
      },
    },
  });
  const trending_tab = new Swiper(".trending-active", {
    // Optional parameters
    slidesPerView: 4,
    spaceBetween: 0,
    loop: true,
    navigation: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination-category",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".accessories-button-next-1",
      prevEl: ".accessories-button-prev-1",
    },
    observer: true,
    observeParents: true,

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      1200: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      1400: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
    },
  });

  //   brand active
  const swiper2 = new Swiper(".brand-active", {
    // Optional parameters
    slidesPerView: 5,
    spaceBetween: 0,
    loop: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    },
    breakpoints: {
      0: {
        slidesPerView: 3,
        spaceBetween: 0,
      },
      576: {
        slidesPerView: 3,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 4,
      },
      1200: {
        slidesPerView: 5,
      },
      1400: {
        slidesPerView: 5,
      },
    },
  });
  //   offer active
  const offer = new Swiper(".offer-active", {
    // Optional parameters
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    },
  });
  const offer2 = new Swiper(".offer-active-2", {
    // Optional parameters
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next-1",
      prevEl: ".swiper-button-prev-1",
    },

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    },
  });
  //   featured active
  const featured = new Swiper(".featured-active", {
    // Optional parameters
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination",
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-prev2",
      prevEl: ".swiper-button-next2",
    },

    // And if we need scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
    },
  });

  // header sidebar menu
  $(".sidebar-menu-toggle").on("click", function () {
    $(".side-info").addClass("visible-h-sidebar");
    $(".offcanvas-overlay").addClass("overlay-open");
  });
  $(".side-info-close,.offcanvas-overlay").on("click", function () {
    $(".side-info").removeClass("visible-h-sidebar");
    $(".offcanvas-overlay").removeClass("overlay-open");
  });
  $(".side-info-close").on("click", function () {
    $(".h-sidebar-overlay").removeClass("h-sidebar-visible");
  });

  //range slider activation

  $("#slider-range").slider({
    range: true,

    min: 0,

    max: 500,

    values: [75, 300],

    slide: function (event, ui) {
      $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
    },
  });
  // zoom slider
  $(".zoom-img-hover").elevateZoom({
    constrainType: "height",
    constrainSize: 274,
    zoomType: "lens",
    containLensZoom: true,
    gallery: "gallery_01",
    cursor: "pointer",
    galleryActiveClass: "active",
  });

  $("#amount").val(
    "$" +
    $("#slider-range").slider("values", 0) +
    " - $" +
    $("#slider-range").slider("values", 1)
  );
  ////////////////////////////////////////////////////
  // 23. Show Login Toggle Js
  $("#showlogin").on("click", function () {
    $("#checkout-login").slideToggle(900);
  });

  ////////////////////////////////////////////////////
  // 24. Show Coupon Toggle Js
  $("#showcoupon").on("click", function () {
    $("#checkout_coupon").slideToggle(900);
  });

  ////////////////////////////////////////////////////
  // 25. Create An Account Toggle Js
  $("#cbox").on("click", function () {
    $("#cbox_info").slideToggle(900);
  });

  ////////////////////////////////////////////////////
  // 26. Shipping Box Toggle Js
  $("#ship-box").on("click", function () {
    $("#ship-box-info").slideToggle(1000);
  });
  $(".epix-side-dropdown ul li a,.epix-side-dropdown button").on(
    "click",
    function () {
      $(".epix-side-dropdown ul").slideToggle();
    }
  );
})(jQuery);

