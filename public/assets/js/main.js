/* Main js */
(function ($) {
  "use strict";

  /* Loader */
  $(window).on("load", function () {
    $(".rx-loader").fadeOut("slow");
  });

  /* Aos animation on scroll */
  AOS.init({
    once: true,
  });

  /* Fancybox lightbox */
  if (typeof $.fancybox !== 'undefined') {
    $('[data-fancybox]').fancybox({
      buttons: ['zoom', 'slideShow', 'fullScreen', 'close'],
      loop: true,
      protect: true,
      youtube: { controls: 1, showinfo: 0 },
    });
  }

  /* Scroll to fixed navigation bar */
  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
      $(".rx-header").addClass("header-fixed");
    } else {
      $(".rx-header").removeClass("header-fixed");
    }
  });

  /* Mobile menu sidebar JS */
  $(".rx-toggle-menu").on("click", function () {
    $(".rx-mobile-menu-overlay").fadeIn();
    $(".rx-mobile-menu").addClass("rx-menu-open");
  });

  $(".rx-mobile-menu-overlay, .rx-close-menu").on("click", function () {
    $(".rx-mobile-menu-overlay").fadeOut();
    $(".rx-mobile-menu").removeClass("rx-menu-open");
  });

  function ResponsiveMobilemsMenu() {
    var $msNav = $(".rx-menu-contact, .overlay-menu"),
      $msNavSubMenu = $msNav.find(".sub-menu");
    $msNavSubMenu.parent().prepend('<span class="menu-toggle"></span>');

    $msNav.on("click", "li a, .menu-toggle", function (e) {
      var $this = $(this);
      if ($this.attr("href") === "#" || $this.hasClass("menu-toggle")) {
        e.preventDefault();
        if ($this.siblings("ul:visible").length) {
          $this.parent("li").removeClass("active");
          $this.siblings("ul").slideUp();
          $this.parent("li").find("li").removeClass("active");
          $this.parent("li").find("ul:visible").slideUp();
        } else {
          $this.parent("li").addClass("active");
          $this
            .closest("li")
            .siblings("li")
            .removeClass("active")
            .find("li")
            .removeClass("active");
          $this.closest("li").siblings("li").find("ul:visible").slideUp();
          $this.siblings("ul").slideDown();
        }
      }
    });
  }

  ResponsiveMobilemsMenu();

  /* Replace all SVG images with inline SVG */
  $(document).ready(function () {
    $('img.svg-img[src$=".svg"]').each(function () {
      var $img = $(this);
      var imgURL = $img.attr("src");
      var attributes = $img.prop("attributes");
      $.get(
        imgURL,
        function (data) {
          var $svg = $(data).find("svg");
          $svg = $svg.removeAttr("xmlns:a");
          $.each(attributes, function () {
            $svg.attr(this.name, this.value);
          });
          $img.replaceWith($svg);
        },
        "xml"
      );
    });
  });

  /* Hero */
  $(".rx-slider").slick({
    rows: 1,
    dots: false,
    arrows: true,
    infinite: true,
    speed: 1000,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 9000,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          dots: false,
          arrows: false,
        },
      },
    ],
  });
  $(window).on("load resize", function () {
    setTimeout(function () {
      $(".rx-slider .slick-prev").each(function () {
        if (!$(this).find(".prev-slick-arrow").length) {
          $(this).prepend(
            '<div class="prev-slick-arrow arrow-icon"><span>&#8249;</span></div>'
          );
        }
      });
      $(".rx-slider .slick-next").each(function () {
        if (!$(this).find(".next-slick-arrow").length) {
          $(this).prepend(
            '<div class="next-slick-arrow arrow-icon"><span>&#8250;</span></div>'
          );
        }
      });
      get_prev_slick_img();
      get_next_slick_img();
    }, 100);
  });
  $(".rx-slider").on("click", ".slick-prev", function () {
    get_prev_slick_img();
  });
  $(".rx-slider").on("click", ".slick-next", function () {
    get_next_slick_img();
  });
  $(".rx-slider").on("swipe", function (event, slick, direction) {
    if (direction == "left") {
      get_prev_slick_img();
    } else {
      get_next_slick_img();
    }
  });
  $(".slick-dots").on("click", "li button", function () {
    var li_no = $(this).parent("li").index();
    if ($(this).parent("li").index() > li_no) {
      get_prev_slick_img();
    } else {
      get_next_slick_img();
    }
  });
  function get_prev_slick_img() {
    var prev_slick_img = $(".rx-slider .slick-current")
      .prev()
      .find("img")
      .attr("src");
    $(".rx-slider .prev-slick-img img").attr("src", prev_slick_img);
    $(".rx-slider .prev-slick-img").css(
      "background-image",
      "url(" + prev_slick_img + ")"
    );
    var prev_next_slick_img = $(".rx-slider .slick-current")
      .next()
      .find("img")
      .attr("src");
    $(".rx-slider .next-slick-img img").attr("src", prev_next_slick_img);
    $(".rx-slider .next-slick-img").css(
      "background-image",
      "url(" + prev_next_slick_img + ")"
    );
  }
  function get_next_slick_img() {
    var next_slick_img = $(".rx-slider .slick-current")
      .next("")
      .find("img")
      .attr("src");
    $(".rx-slider .next-slick-img img").attr("src", next_slick_img);
    $(".rx-slider .next-slick-img").css(
      "background-image",
      "url(" + next_slick_img + ")"
    );
    var next_prev_slick_img = $(".rx-slider .slick-current")
      .prev("")
      .find("img")
      .attr("src");
    $(".rx-slider .prev-slick-img img").attr("src", next_prev_slick_img);
    $(".rx-slider .prev-slick-img").css(
      "background-image",
      "url(" + next_prev_slick_img + ")"
    );
  }

  /* Amenities */
  $(".rx-amenities-slider").owlCarousel({
    loop: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    smartSpeed: 2000,
    autoplay: true,
    autoplayTimeout: 4000,
    margin: 24,
    nav: false,
    dots: true,
    responsive: {
      0: {
        items: 1,
        scroll: 1,
      },
    },
  });

  /* Testimonials */
  $(".rx-testimonials-slider").owlCarousel({
    loop: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    smartSpeed: 1000,
    autoplay: false,
    autoplayTimeout: 2500,
    margin: 24,
    nav: false,
    dots: false,
    responsive: {
      0: {
        items: 1,
        scroll: 1,
      },
    },
  });

  /* Blog */
  $(".rx-blog-slider").owlCarousel({
    loop: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    smartSpeed: 1000,
    autoplay: false,
    autoplayTimeout: 2500,
    margin: 24,
    nav: false,
    dots: false,
    responsive: {
      0: {
        items: 1,
      },
      480: {
        items: 2,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 4,
      },
    },
  });

  /* Team */
  $(".rx-team-slider").owlCarousel({
    loop: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    smartSpeed: 1000,
    autoplay: false,
    autoplayTimeout: 2500,
    margin: 24,
    nav: false,
    dots: false,
    responsive: {
      0: {
        items: 1,
      },
      421: {
        items: 2,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 4,
      },
    },
  });

  /* menu */
  $(".rx-menu-tabs-contact .inner-menu").mouseenter("click", function () {
    $(".inner-menu").removeClass("active-menu");
    $(this).addClass("active-menu");
  });
  $(".rx-menu-tabs ul.nav-tabs li button").on("click", function () {
    if ($(".rx-menutab .tab-pane").hasClass("active")) {
      $(".inner-menu").removeClass("active-menu");
      $(".rx-menu-tabs-contact .inner-menu:first-child").addClass("active-menu");
    }
  });

  /* Date */
  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    startDate: '+1d'
  });

  /* Room details slider */
  $(".room-slider-for").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: ".room-slider-nav",
  });
  $(".room-slider-nav").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: ".room-slider-for",
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 420,
        settings: {
          slidesToShow: 2,
        },
      },
    ],
  });

  /* back-to-top */
  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
      $(".back-to-top").fadeIn();
    } else {
      $(".back-to-top").fadeOut();
    }
  });

  var progressPath = document.querySelector(".back-to-top-wrap path");
  var pathLength = progressPath.getTotalLength();
  progressPath.style.transition = progressPath.style.WebkitTransition = "none";
  progressPath.style.strokeDasharray = pathLength + " " + pathLength;
  progressPath.style.strokeDashoffset = pathLength;
  progressPath.getBoundingClientRect();
  progressPath.style.transition = progressPath.style.WebkitTransition =
    "stroke-dashoffset 10ms linear";
  var updateProgress = function () {
    var scroll = $(window).scrollTop();
    var height = $(document).height() - $(window).height();
    var progress = pathLength - (scroll * pathLength) / height;
    progressPath.style.strokeDashoffset = progress;
  };
  updateProgress();
  $(window).scroll(updateProgress);
  var offset = 50;
  var duration = 550;
  jQuery(window).on("scroll", function () {
    if (jQuery(this).scrollTop() > offset) {
      jQuery(".back-to-top-wrap").addClass("active-progress");
    } else {
      jQuery(".back-to-top-wrap").removeClass("active-progress");
    }
  });
  jQuery(".back-to-top-wrap").on("click", function (event) {
    event.preventDefault();
    jQuery("html, body").animate({ scrollTop: 0 }, duration);
    return false;
  });

  /* For Directly Run */
  $(window).on("load", function () {
    setTimeout(function () {
      switch (window.location.protocol) {
        case 'file:':
          console.log(
            '%cPlease try to run using local server instead of Directly click or run for better experience. ',
            'font-size: 20px; background-color: black; color:white; margin-left: 15px; padding: 15px'
          );
          break;
        default:
      }
    }, 100);
  });

  /* Password show */
  $(".toggle-password").click(function () {
    $(this).toggleClass("ri-eye-line ri-eye-off-line");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });

   /* Tools Sidebar */
   $(".rx-tools-sidebar-toggle").on("click", function () {
    $(".rx-tools-sidebar").addClass("open-tools");
    $(".rx-tools-sidebar-overlay").fadeIn();
    $(".rx-tools-sidebar-toggle").hide();
  });
  $(".rx-tools-sidebar-overlay, .close-tools").on("click", function () {
    $(".rx-tools-sidebar").removeClass("open-tools");
    $(".rx-tools-sidebar-overlay").fadeOut();
    $(".rx-tools-sidebar-toggle").fadeIn();
  });

  /* color show */
  $(".rx-color li").on("click", function () {
    $("li").removeClass("active-color");
    $(this).addClass("active-color");
  });

  $(".color-primary").on("click", function () {
    $("#add_class").remove();
  });

  $(".color-1").on("click", function () {
    $("#add_class").remove();
    $("head").append(
      '<link rel="stylesheet" href="assets/css/color-1.css" id="add_class">'
    );
  });
  $(".color-2").on("click", function () {
    $("#add_class").remove();
    $("head").append(
      '<link rel="stylesheet" href="assets/css/color-2.css" id="add_class">'
    );
  });
  $(".color-3").on("click", function () {
    $("#add_class").remove();
    $("head").append(
      '<link rel="stylesheet" href="assets/css/color-3.css" id="add_class">'
    );
  });
  $(".color-4").on("click", function () {
    $("#add_class").remove();
    $("head").append(
      '<link rel="stylesheet" href="assets/css/color-4.css" id="add_class">'
    );
  });
  $(".color-5").on("click", function () {
    $("#add_class").remove();
    $("head").append(
      '<link rel="stylesheet" href="assets/css/color-5.css" id="add_class">'
    );
  });
  $(".color-6").on("click", function () {
    $("#add_class").remove();
    $("head").append(
      '<link rel="stylesheet" href="assets/css/color-6.css" id="add_class">'
    );
  });
  $(".color-7").on("click", function () {
    $("#add_class").remove();
    $("head").append(
      '<link rel="stylesheet" href="assets/css/color-7.css" id="add_class">'
    );
  });
  $(".color-8").on("click", function () {
    $("#add_class").remove();
    $("head").append(
      '<link rel="stylesheet" href="assets/css/color-8.css" id="add_class">'
    );
  });
  $(".color-9").on("click", function () {
    $("#add_class").remove();
    $("head").append(
      '<link rel="stylesheet" href="assets/css/color-9.css" id="add_class">'
    );
  });

  /* RTL-LTR Modes */
  $(".rx-tools-rtl .rx-tools-item").on("click", function () {
    $(".active-mode").removeClass("active-mode");
    $(this).addClass("active-mode");
  });
  $(".ltr").on("click", function () {
    $("#add_rtl").remove();
  });
  $(".rtl").on("click", function () {
    $("head").append(
      '<link rel="stylesheet" href="assets/css/rtl.css" id="add_rtl">'
    );
  });

  /*Dark Light Modes */
  $(".rx-tools-dark .rx-tools-item").on("click", function () {
    $(".active-dark-mode").removeClass("active-dark-mode");
    $(this).addClass("active-dark-mode");
  });
  $(".light").on("click", function () {
    $("#add_dark").remove();
  });
  $(".dark").on("click", function () {
    $("head").append(
      '<link rel="stylesheet" href="assets/css/dark.css" id="add_dark">'
    );
  });

  /* box Modes */
  $(".rx-tools-box div").on("click", function () {
    $("div").removeClass("active-box");
    $(this).addClass("active-box");
  });
  $(".default").on("click", function () {
    $("#add_box").remove();
  });
  $(".box-1").on("click", function () {
    $("head").append(
      '<link rel="stylesheet" href="assets/css/box-1.css" id="add_box">'
    );
  });

  /* bg */
  $(".rx-tools-bg .rx-tools-item").on("click", function () {
    $(".rx-tools-item").removeClass("active-bg");
    $(this).addClass("active-bg");
  });

  $(".bg-0").on("click", function () {
    $("body").addClass('body-bg-0').removeClass();
    $("#add_bg").remove();
  });

  $(".bg-1").on("click", function () {
    $("#add_bg").remove();
    $("body").addClass('body-bg-1').removeClass();
    $("head").append('<link rel="stylesheet" class="bg" href="assets/css/bg-1.css" id="add_bg">');
    $("body").addClass('body-bg-1');
  });

  $(".bg-2").on("click", function () {
    $("#add_bg").remove();
    $("body").addClass('body-bg-2').removeClass();
    $("head").append('<link rel="stylesheet" class="bg" href="assets/css/bg-2.css" id="add_bg">');
    $("body").addClass('body-bg-2');
  });

  $(".bg-3").on("click", function () {
    $("#add_bg").remove();
    $("body").addClass('body-bg-3').removeClass();
    $("head").append('<link rel="stylesheet" class="bg" href="assets/css/bg-3.css" id="add_bg">');
    $("body").addClass('body-bg-3');
  });

  $(".bg-4").on("click", function () {
    $("#add_bg").remove();
    $("body").addClass('body-bg-4').removeClass();
    $("head").append('<link rel="stylesheet" class="bg" href="assets/css/bg-4.css" id="add_bg">');
    $("body").addClass('body-bg-4');
  });

  $(".bg-5").on("click", function () {
    $("#add_bg").remove();
    $("body").addClass('body-bg-5').removeClass();
    $("head").append('<link rel="stylesheet" class="bg" href="assets/css/bg-5.css" id="add_bg">');
    $("body").addClass('body-bg-5');
  });

  /* Home amenities showcase */
  (function initHomeAmenities() {
    const $section = $(".home-amenities-section");
    if (!$section.length) {
      return;
    }

    let activeIndex = 0;
    let autoplayTimer = null;
    const autoplayDelay = 5000;

    function showAmenity(index) {
      const $tabs = $section.find("[data-amenity-tab]");
      const total = $tabs.length;

      if (!total) {
        return;
      }

      activeIndex = ((index % total) + total) % total;

      $section.find("[data-amenity-slide], [data-amenity-panel], [data-amenity-tab], .home-amenities-dot").removeClass("is-active");
      $section.find("[data-amenity-slide], [data-amenity-panel], [data-amenity-tab], .home-amenities-dot").attr("aria-selected", "false");

      $section.find('[data-amenity-slide="' + activeIndex + '"]').addClass("is-active");
      $section.find('[data-amenity-panel="' + activeIndex + '"]').addClass("is-active");
      $section.find('[data-amenity-tab="' + activeIndex + '"]').addClass("is-active").attr("aria-selected", "true");
    }

    function startAutoplay() {
      clearInterval(autoplayTimer);
      autoplayTimer = setInterval(function () {
        showAmenity(activeIndex + 1);
      }, autoplayDelay);
    }

    $section.on("click", "[data-amenity-tab]", function () {
      const index = parseInt($(this).attr("data-amenity-tab"), 10);
      showAmenity(index);
      startAutoplay();
    });

    $section.on("mouseenter", function () {
      clearInterval(autoplayTimer);
    });

    $section.on("mouseleave", function () {
      startAutoplay();
    });

    startAutoplay();
  })();

  /* Home testimonials showcase */
  (function initHomeTestimonials() {
    const $section = $(".home-testimonials-section");
    if (!$section.length) {
      return;
    }

    let activeIndex = 0;
    let autoplayTimer = null;
    const autoplayDelay = 6000;

    function showTestimonial(index) {
      const $slides = $section.find("[data-testimonial-slide]");
      const total = $slides.length;

      if (!total) {
        return;
      }

      activeIndex = ((index % total) + total) % total;

      $section.find("[data-testimonial-slide], .home-testimonials-dot").removeClass("is-active");
      $section.find(".home-testimonials-dot").attr("aria-selected", "false");

      $section.find('[data-testimonial-slide="' + activeIndex + '"]').addClass("is-active");
      $section.find('[data-testimonial-dot="' + activeIndex + '"]').addClass("is-active").attr("aria-selected", "true");
    }

    function startAutoplay() {
      clearInterval(autoplayTimer);
      autoplayTimer = setInterval(function () {
        showTestimonial(activeIndex + 1);
      }, autoplayDelay);
    }

    $section.on("click", "[data-testimonial-prev]", function () {
      showTestimonial(activeIndex - 1);
      startAutoplay();
    });

    $section.on("click", "[data-testimonial-next]", function () {
      showTestimonial(activeIndex + 1);
      startAutoplay();
    });

    $section.on("click", "[data-testimonial-dot]", function () {
      const index = parseInt($(this).attr("data-testimonial-dot"), 10);
      showTestimonial(index);
      startAutoplay();
    });

    $section.on("mouseenter", function () {
      clearInterval(autoplayTimer);
    });

    $section.on("mouseleave", function () {
      startAutoplay();
    });

    startAutoplay();
  })();

  /* Contact page form */
  (function initContactPageForm() {
    const $form = $("#contactPageForm");
    if (!$form.length) {
      return;
    }

    $form.on("submit", function (event) {
      event.preventDefault();

      const form = this;

      if (!form.checkValidity()) {
        event.stopPropagation();
        $form.addClass("was-validated");
        return;
      }

      const $submit = $form.find(".contact-message-submit");
      const $submitText = $form.find(".contact-message-submit-text");
      const $submitLoader = $form.find(".contact-message-submit-loader");
      const $error = $(".contact-message-error");

      $error.addClass("d-none").text("");
      $submit.prop("disabled", true);
      $submitText.addClass("d-none");
      $submitLoader.removeClass("d-none");

      $.ajax({
        url: $form.attr("action"),
        method: "POST",
        data: $form.serialize(),
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          Accept: "application/json",
        },
        success: function (response) {
          if (response.message) {
            $(".contact-message-success-text").text(response.message);
          }

          $form.addClass("d-none");
          $(".contact-message-success").removeClass("d-none");
        },
        error: function (xhr) {
          let message = "Something went wrong. Please try again.";

          if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
            message = Object.values(xhr.responseJSON.errors).map(function (items) {
              return items[0];
            }).join(" ");
          } else if (xhr.responseJSON && xhr.responseJSON.message) {
            message = xhr.responseJSON.message;
          }

          $error.removeClass("d-none").text(message);
        },
        complete: function () {
          $submit.prop("disabled", false);
          $submitText.removeClass("d-none");
          $submitLoader.addClass("d-none");
        },
      });
    });

    $(".contact-message-reset").on("click", function () {
      const form = document.getElementById("contactPageForm");

      if (form) {
        form.reset();
        $form.removeClass("was-validated d-none");
      }

      $(".contact-message-success").addClass("d-none");
      $(".contact-message-error").addClass("d-none").text("");
    });
  })();

})(jQuery);
