(function ($) {
    "use strict";
	
	var $window = $(window); 
	var $body = $('body'); 

	/* Preloader Effect */
	$window.on('load', function(){
		$(".preloader").fadeOut(600);
	});

	/* Sticky Header */	
	if($('.active-sticky-header').length){
		$window.on('resize', function(){
			setHeaderHeight();
		});

		function setHeaderHeight(){
	 		$("header.main-header").css("height", $('header .header-sticky').outerHeight());
		}	
	
		$window.on("scroll", function() {
			var fromTop = $(window).scrollTop();
			setHeaderHeight();
			var headerHeight = $('header .header-sticky').outerHeight()
			$("header .header-sticky").toggleClass("hide", (fromTop > headerHeight + 100));
			$("header .header-sticky").toggleClass("active", (fromTop > 600));
		});
	}	
	
	/* Slick Menu JS */
	$('#menu').slicknav({
		label : '',
		prependTo : '.responsive-menu',
		beforeOpen: function(){
			$('body').addClass('mobile-menu-open');
		},
		beforeClose: function(){
			$('body').removeClass('mobile-menu-open');
		}
	});

	if($("a[href='#top']").length){
		$(document).on("click", "a[href='#top']", function() {
			$("html, body").animate({ scrollTop: 0 }, "slow");
			return false;
		});
	}

	/* Hero Slider Layout JS */
	if ($('.hero-slider-layout .hero-main-swiper').length) {
		new Swiper('.hero-slider-layout .hero-main-swiper', {
			slidesPerView: 1,
			speed: 900,
			spaceBetween: 0,
			loop: true,
			autoplay: {
				delay: 5500,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.hero-pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.hero-slider-next',
				prevEl: '.hero-slider-prev',
			},
		});
	}

	/* Home Trust Strip Swiper */
	if ($('.trust-strip-swiper').length) {
		const trustStripSwiper = new Swiper('.trust-strip-swiper', {
			slidesPerView: 2,
			slidesPerGroup: 1,
			spaceBetween: 14,
			speed: 700,
			loop: true,
			grabCursor: true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
				pauseOnMouseEnter: true,
			},
			breakpoints: {
				992: {
					slidesPerView: 4,
					slidesPerGroup: 1,
					spaceBetween: 22,
				},
			},
		});

		trustStripSwiper.on('resize', function () {
			this.update();
		});
	}

	/* Home Patient Feedback Swiper */
	if ($('.home-patient-feedback-swiper').length) {
		const patientFeedbackSwiper = new Swiper('.home-patient-feedback-swiper', {
			slidesPerView: 1.12,
			spaceBetween: 16,
			speed: 650,
			loop: true,
			grabCursor: true,
			autoplay: {
				delay: 4500,
				disableOnInteraction: false,
				pauseOnMouseEnter: true,
			},
			navigation: {
				nextEl: '.home-patient-feedback-next',
				prevEl: '.home-patient-feedback-prev',
			},
			breakpoints: {
				576: {
					slidesPerView: 1.35,
					spaceBetween: 18,
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				1200: {
					slidesPerView: 3,
					spaceBetween: 22,
				},
				1400: {
					slidesPerView: 4,
					spaceBetween: 24,
				},
			},
		});

		patientFeedbackSwiper.on('resize', function () {
			this.update();
		});
	}

	/* Video Feedback Reels Swiper */
	function initVideoFeedbackThumbnails(root) {
		const scope = root || document;

		scope.querySelectorAll('.video-feedback-thumb-media').forEach(function (video) {
			if (video.dataset.posterReady === '1') {
				return;
			}

			video.dataset.posterReady = '1';

			const showFrame = function () {
				if (!video.duration || Number.isNaN(video.duration)) {
					return;
				}

				video.currentTime = Math.min(0.5, Math.max(0.1, video.duration * 0.05));
			};

			video.addEventListener('loadedmetadata', showFrame, { once: true });
			video.addEventListener('seeked', function () {
				video.pause();
			}, { once: true });
			video.addEventListener('error', function () {
				video.classList.add('is-poster-error');
			}, { once: true });
		});
	}

	if ($('.video-feedback-swiper').length) {
		const videoFeedbackSwiper = new Swiper('.video-feedback-swiper', {
			slidesPerView: 1.15,
			spaceBetween: 16,
			speed: 650,
			grabCursor: true,
			watchOverflow: true,
			navigation: {
				nextEl: '.video-feedback-next',
				prevEl: '.video-feedback-prev',
			},
			breakpoints: {
				576: {
					slidesPerView: 1.6,
					spaceBetween: 18,
				},
				768: {
					slidesPerView: 2.2,
					spaceBetween: 20,
				},
				992: {
					slidesPerView: 3,
					spaceBetween: 22,
				},
				1200: {
					slidesPerView: 4,
					spaceBetween: 24,
				},
			},
		});

		videoFeedbackSwiper.on('resize', function () {
			this.update();
		});

		videoFeedbackSwiper.on('slideChange', function () {
			resetAllVideoFeedbackReels();
		});

		initVideoFeedbackThumbnails(document.querySelector('.video-feedback-section'));
	}

	initVideoFeedbackThumbnails(document);

	function resetVideoFeedbackReel($reel) {
		$reel.removeClass('is-playing');
		$reel.find('.video-feedback-reel-player').empty().attr('aria-hidden', 'true');
	}

	function resetAllVideoFeedbackReels() {
		$('.video-feedback-reel.is-playing').each(function () {
			resetVideoFeedbackReel($(this));
		});
	}

	$(document).on('click', '.video-feedback-play', function (event) {
		event.preventDefault();
		event.stopPropagation();

		const $reel = $(this).closest('.video-feedback-reel');

		if ($reel.hasClass('is-playing')) {
			return;
		}

		resetAllVideoFeedbackReels();

		const embedUrl = $reel.data('embed-url');
		const isDirectVideo = String($reel.data('direct-video')) === '1';
		const $player = $reel.find('.video-feedback-reel-player');

		if (!embedUrl) {
			return;
		}

		if (isDirectVideo) {
			$player.html(
				'<video src="' + embedUrl + '" controls autoplay playsinline></video>'
			);
		} else {
			$player.html(
				'<iframe src="' + embedUrl + '" title="Patient video feedback" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen loading="lazy"></iframe>'
			);
		}

		$player.attr('aria-hidden', 'false');
		$reel.addClass('is-playing');
	});

	/* Patient Feedback Read More */
	$(document).on('click', '.home-feedback-read-more', function () {
		const card = $(this).closest('.home-feedback-card');
		const isExpanded = card.hasClass('is-expanded');

		card.toggleClass('is-expanded', !isExpanded);
		$(this).text(isExpanded ? 'Read more' : 'Read less');
		$(this).attr('aria-expanded', !isExpanded);
	});

	/* Home Gallery Mobile Swiper */
	if ($('.home-gallery-mobile-swiper').length) {
		const galleryMobileSwiper = new Swiper('.home-gallery-mobile-swiper', {
			slidesPerView: 1.08,
			spaceBetween: 16,
			speed: 650,
			loop: true,
			grabCursor: true,
			centeredSlides: true,
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
				pauseOnMouseEnter: true,
			},
			pagination: {
				el: '.home-gallery-mobile-pagination',
				clickable: true,
			},
		});

		galleryMobileSwiper.on('resize', function () {
			this.update();
		});
	}

	/* Book Appointment Modal */
	if ($('#bookAppointmentModal').length) {
		$('#bookAppointmentForm').on('submit', function (event) {
			event.preventDefault();

			if (!this.checkValidity()) {
				event.stopPropagation();
				$(this).addClass('was-validated');
				return;
			}

			$('.book-appointment-form-wrap').addClass('d-none');
			$('.book-appointment-success').removeClass('d-none');
		});

		$('#bookAppointmentModal').on('hidden.bs.modal', function () {
			const form = document.getElementById('bookAppointmentForm');

			form.reset();
			$(form).removeClass('was-validated');
			$('.book-appointment-form-wrap').removeClass('d-none');
			$('.book-appointment-success').addClass('d-none');
		});
	}

	/* Contact Page Form */
	if ($('#contactPageForm').length) {
		$('#contactPageForm').on('submit', function (event) {
			event.preventDefault();

			const form = this;
			const $form = $(form);
			const $submit = $form.find('.contact-message-submit');
			const $submitText = $form.find('.contact-message-submit-text');
			const $submitLoader = $form.find('.contact-message-submit-loader');
			const $error = $('.contact-message-error');

			if (!form.checkValidity()) {
				event.stopPropagation();
				$form.addClass('was-validated');
				return;
			}

			$error.addClass('d-none').text('');
			$submit.prop('disabled', true);
			$submitText.addClass('d-none');
			$submitLoader.removeClass('d-none');

			$.ajax({
				url: $form.attr('action'),
				method: 'POST',
				data: $form.serialize(),
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
					'Accept': 'application/json',
				},
				success: function (response) {
					if (response.message) {
						$('.contact-message-success-text').text(response.message);
					}

					$form.addClass('d-none');
					$('.contact-message-success').removeClass('d-none');
				},
				error: function (xhr) {
					let message = 'Something went wrong. Please try again.';

					if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
						const errors = xhr.responseJSON.errors;
						message = Object.values(errors).map(function (items) {
							return items[0];
						}).join(' ');
					} else if (xhr.responseJSON && xhr.responseJSON.message) {
						message = xhr.responseJSON.message;
					}

					$error.removeClass('d-none').text(message);
				},
				complete: function () {
					$submit.prop('disabled', false);
					$submitText.removeClass('d-none');
					$submitLoader.addClass('d-none');
				}
			});
		});
	}

	/* Skill Bar */
	if ($('.skills-progress-bar').length) {
		$('.skills-progress-bar').waypoint(function() {
			$('.skillbar').each(function() {
				$(this).find('.count-bar').animate({
				width:$(this).attr('data-percent')
				},2000);
			});
		},{
			offset: '70%'
		});
	}

	/* Youtube Background Video JS */
	if ($('#herovideo').length) {
		var myPlayer = $("#herovideo").YTPlayer();
	}

	/* Init Counter */
	if ($('.counter').length) {
		$('.counter').counterUp({ delay: 6, time: 3000 });
	}

	/* Image Reveal Animation */
	if ($('.reveal').length) {
        gsap.registerPlugin(ScrollTrigger);
        let revealContainers = document.querySelectorAll(".reveal");
        revealContainers.forEach((container) => {
            let image = container.querySelector("img");
            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: container,
                    toggleActions: "play none none none"
                }
            });
            tl.set(container, {
                autoAlpha: 1
            });
            tl.from(container, 1, {
                xPercent: -100,
                ease: Power2.out
            });
            tl.from(image, 1, {
                xPercent: 100,
                scale: 1,
                delay: -1,
                ease: Power2.out
            });
        });
    }

	/* Text Effect Animation */
	if ($('.text-anime-style-1').length) {
		let staggerAmount 	= 0.05,
			translateXValue = 0,
			delayValue 		= 0.5,
		   animatedTextElements = document.querySelectorAll('.text-anime-style-1');
		
		animatedTextElements.forEach((element) => {
			let animationSplitText = new SplitText(element, { type: "chars, words" });
				gsap.from(animationSplitText.words, {
				duration: 1,
				delay: delayValue,
				x: 20,
				autoAlpha: 0,
				stagger: staggerAmount,
				scrollTrigger: { trigger: element, start: "top 85%" },
				});
		});		
	}
	
	if ($('.text-anime-style-2').length) {				
		let	 staggerAmount 		= 0.03,
			 translateXValue	= 20,
			 delayValue 		= 0.1,
			 easeType 			= "power2.out",
			 animatedTextElements = document.querySelectorAll('.text-anime-style-2');
		
		animatedTextElements.forEach((element) => {
			let animationSplitText = new SplitText(element, { type: "chars, words" });
				gsap.from(animationSplitText.chars, {
					duration: 1,
					delay: delayValue,
					x: translateXValue,
					autoAlpha: 0,
					stagger: staggerAmount,
					ease: easeType,
					scrollTrigger: { trigger: element, start: "top 85%"},
				});
		});		
	}
	
	if ($('.text-anime-style-3').length) {		
		let	animatedTextElements = document.querySelectorAll('.text-anime-style-3');
		
		 animatedTextElements.forEach((element) => {
			//Reset if needed
			if (element.animation) {
				element.animation.progress(1).kill();
				element.split.revert();
			}

			element.split = new SplitText(element, {
				type: "lines,words,chars",
				linesClass: "split-line",
			});
			gsap.set(element, { perspective: 400 });

			gsap.set(element.split.chars, {
				opacity: 0,
				x: "50",
			});

			element.animation = gsap.to(element.split.chars, {
				scrollTrigger: { trigger: element,	start: "top 90%" },
				x: "0",
				y: "0",
				rotateX: "0",
				opacity: 1,
				duration: 1,
				ease: Back.easeOut,
				stagger: 0.02,
			});
		});		
	}

	/* Parallaxie js */
	/* var $parallaxie = $('.parallaxie');
	if($parallaxie.length && ($window.width() > 991))
	{
		if ($window.width() > 768) {
			$parallaxie.parallaxie({
				speed: 0.55,
				offset: 0,
			});
		}
	} */

	/* Zoom Gallery screenshot */
	$('.gallery-items').magnificPopup({
		delegate: 'a.gallery-popup-image',
		type: 'image',
		closeOnContentClick: false,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom',
		image: {
			verticalFit: true,
		},
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true,
			duration: 300, // don't foget to change the duration also in CSS
			opener: function(element) {
			  return element.find('img');
			}
		}
	});

	/* Contact form validation */
	var $contactform = $("#contactForm");
	$contactform.validator({focus: false}).on("submit", function (event) {
		if (!event.isDefaultPrevented()) {
			event.preventDefault();
			submitForm();
		}
	});

	function submitForm(){
		/* Ajax call to submit form */
		$.ajax({
			type: "POST",
			url: "form-process.php",
			data: $contactform.serialize(),
			success : function(text){
				if (text === "success"){
					formSuccess();
				} else {
					submitMSG(false,text);
				}
			}
		});
	}

	function formSuccess(){
		$contactform[0].reset();
		submitMSG(true, "Message Sent Successfully!")
	}

	function submitMSG(valid, msg){
		if(valid){
			var msgClasses = "h4 text-success";
		} else {
			var msgClasses = "h4 text-danger";
		}
		$("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
	}
	/* Contact form validation end */

	/* Appointment form validation */
	var $appointmentForm = $("#appointmentForm");
	$appointmentForm.validator({focus: false}).on("submit", function (event) {
		if (!event.isDefaultPrevented()) {
			event.preventDefault();
			submitappointmentForm();
		}
	});

	function submitappointmentForm(){
		/* Ajax call to submit form */
		$.ajax({
			type: "POST",
			url: "form-appointment.php",
			data: $appointmentForm.serialize(),
			success : function(text){
				if (text === "success"){
					appointmentformSuccess();
				} else {
					appointmentsubmitMSG(false,text);
				}
			}
		});
	}

	function appointmentformSuccess(){
		$appointmentForm[0].reset();
		appointmentsubmitMSG(true, "Message Sent Successfully!")
	}

	function appointmentsubmitMSG(valid, msg){
		if(valid){
			var msgClasses = "h3 text-success";
		} else {
			var msgClasses = "h3 text-danger";
		}
		$("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
	}
	/* Appointment form validation end */

	/* Animated Wow Js */	
	new WOW().init();

	/* Popup Video */
	if ($('.popup-video').length) {
		$('.popup-video').magnificPopup({
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: true
		});
	}
	
})(jQuery);