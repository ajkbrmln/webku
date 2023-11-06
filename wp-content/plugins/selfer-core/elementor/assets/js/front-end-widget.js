(function ($) {
	"use strict";
	/* ---------------------------------------------
	 Progress Bar
	--------------------------------------------- */
	var WidgetSelferProgressbarHandler = function( $scope, $ ) {
		$(".progress").each(function(){
		    var $this = $(this);
		    $this.find(".ts-progress-value").text( $this.attr("data-progress-width") );
		    $this.isInViewport(function(status) {
		        if (status === "entered") {
		            $this.find(".progress-bar").width( $this.attr("data-progress-width") );
		            $this.find(".ts-progress-value").css("left", $this.attr("data-progress-width"));
		        }
		    });
		});
	};

	/* ---------------------------------------------
	 Testimonial Carousel
	--------------------------------------------- */
	var WidgetSelferTestimonialCarouselHandler = function( $scope, $ ) {
		var carousel_elem = $scope.find('.testimonial-carousel');

		if (carousel_elem.length > 0) {
			
		var settings = carousel_elem.data('settings'),
		    carousel_item = settings['testimonials_item'],
		    carousel_loop = settings['testimonials_carousel_loop'],
		    carousel_gap = settings['testimonials_carousel_gap'],
		    carousel_nav = settings['nav_enable'],
		    dots_enable = settings['dots_enable'],
		    carousel_autoplay = settings['autoplay_speed'];

			carousel_elem.owlCarousel({
				loop: (carousel_loop === true) ? true : false,
				nav: carousel_nav,
				dots: dots_enable,
				navText: ['<i class="gra-arrow-left"</i>', '<i class="gra-arrow-right"></i>'],
				autoplay: (carousel_autoplay == true) ? true : false,
				margin: (carousel_gap !== '') ? carousel_gap : 30,
				responsive:{
					280:{
						items: 1
					},
					480 : {
						items: 1
					},
					768 : {
					   items: 1
					},
					1200 : {
					   items: (carousel_item !== "") ? carousel_item : 1,
					}
				}
			});	
		}
	};

	/* ---------------------------------------------
	 Service Carousel
	--------------------------------------------- */
	var WidgetSelferServiceCarouselHandler = function( $scope, $ ) {
		var serviceCarousel = $('.service-carousel');
		if(serviceCarousel.length) {		
			var	settings = serviceCarousel.data('settings'),
				service_item = settings['service_slider_item'],
				service_item_gap = settings['service_slider_carousel_gap'],
				service_item_loop = settings['service_slider_carousel_loop'],
				service_item_autoplay = settings['service_slider_carousel_autoplay'];
			serviceCarousel.owlCarousel({
				loop: (service_item_loop == true) ? true : false,
				nav: true,
				autoplay: (service_item_autoplay == true) ? true : false,
				margin: (service_item_gap) ? service_item_gap :  0,
				navText: ['<i class="gra-arrow-left"</i>', '<i class="gra-arrow-right"></i>'],
				responsive:{
					280:{
						items: 1
					},
					480 : {
						items: 1
					},
					768 : {
					   items: 2
					},
					1200 : {
					   items: (service_item) ? service_item : 4,
					}
				}
			});
		}
	};

	/* ---------------------------------------------
	 Portfolio
	--------------------------------------------- */
	var WidgetSelferPortfolioHandler = function( $scope, $ ) {
		$(window).on('load', function() {
			var IsoGriddoload = $('.ts-gallery');
			IsoGriddoload.isotope({
				itemSelector: '.ts-gallery > .gallery-items-main',
				percentPosition: true,
			});	
		});

		var $service_link = $('.ts-title-arrow-portfolio-ajax');

		$service_link.on('click', function() {
			var post_id = $(this).attr("data-rel"); //this is the post id

			$.ajax({
			    url: selfer.ajaxurl,
			    type: 'GET',
			    data: {
			        action: 'selfer_portfolio_ajax_content',
			        post_id: post_id
			    },
			    dataType: "html",
			    contentType: 'application/html; charset=utf-8',
			    beforeSend: function() {
			    	$('#portfolio-modal-container').html('');
		           	$('#portfolio-modal-container').append('<div class="spinner-content text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
		       	},
			    success: function(data) {
			        $('#portfolio-modal-container').html(data);
			    },
			    error: function(data) {
			        console.log('No Portfolio');
			    }
			});
		});
	};

	/* ---------------------------------------------
	 Nav Menu
	--------------------------------------------- */
	var WidgetselferNavMenu = function() {
		var $submenuIndicator = $('.selfer-nav-menu-main li .selfer-nav-menu-dropdown');
		$submenuIndicator.prev().append('<span class="sub-arrow"><i></i></span>');

		var $submenu = $('.selfer-nav-menu-dropdown.selfer-nav-menu-container').find('li').has('.sub-menu');
		$submenu.prepend("<span class='expend-dropdown'><i class='menu-arrow fas fa-plus'></i></span>");
		var $mobileSubMenuOpen = $(".expend-dropdown");
		$mobileSubMenuOpen.each(function() {
			var $self = $(this);
			$self.on("click", function(e) {
				e.stopImmediatePropagation();
			    $self.siblings(".sub-menu").slideToggle("slow");
			    $self.children(".menu-arrow").toggleClass("menu-extend");
			});
		});

		var dropdownMenu = $('.selfer-menu-toggle');
		dropdownMenu.on('click', function(e) {
			$(this).toggleClass('elementor-active');
		});


		var desktopHamburger = $('.hamburger-menu.hamburger-elementor');
		desktopHamburger.on('click', function(e) {
			e.preventDefault();
			$('.selfer-nav-menu-hamburger').toggleClass('menu-show');
			$('.hamburger-menu').toggleClass('is-active');
			$(".ef-background").addClass("animated").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
				$("html").toggleClass("is-scroll-disabled");
			    $(this).removeClass("animated");
			});
		});

		var closeHamburger = $('.selfer-nav-menu-hamburger .hamburger-close');
		closeHamburger.on('click', function() {
			$('.selfer-nav-menu-hamburger').removeClass('menu-show');
			$('.hamburger-menu').removeClass('is-active');
			$(".ef-background").addClass("animated").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
				$("html").removeClass("is-scroll-disabled");
			    $(this).removeClass("animated");
			});
		});

		var $hamburgerSubmenuIndicator = $('.selfer-nav-menu-hamburger li .selfer-nav-menu-dropdown');
		$hamburgerSubmenuIndicator.prev().append('<span class="sub-arrow"><i></i></span>');

		$('.selfer-nav-menu-hamburger .selfer-nav-menu li').each(function() {
			var $this = $(this);
			if( $this.find('.sub-menu') ) {
				$this.find('a').on('click', function(e) {
					e.preventDefault();
					$(this).siblings(".sub-menu").slideToggle("slow");
				} );
			}
		});

		//Full width dropdown

	};

	/* ---------------------------------------------
	 Portfolio Carousel Gallery
	--------------------------------------------- */
	var WidgetSelferBackgroundHandeler = function( $scope, $ ) {
		$("[data-bg-color], [data-bg-image], [data-bg-particles]").each(function() {
		    var $this = $(this);

		    if( $this.hasClass("ts-separate-bg-element") ){
		        $this.append('<div class="ts-background">');

		        // Background Color

		        if( $("[data-bg-color]") ){
		            $this.find(".ts-background").css("background-color", $this.attr("data-bg-color") );
		        }

		        // Particles

		        if( $this.attr("data-bg-particles-line-color") || $this.attr("data-bg-particles-dot-color") ){
		            $this.find(".ts-background").append('<div class="ts-background-particles">');
		            $(".ts-background-particles").each(function () {
		                var lineColor = $this.attr("data-bg-particles-line-color");
		                var dotColor = $this.attr("data-bg-particles-dot-color");
		                var parallax = $this.attr("data-bg-particles-parallax");
		                $(this).particleground({
		                    density: 15000,
		                    lineWidth: 0.2,
		                    lineColor: lineColor,
		                    dotColor: dotColor,
		                    parallax: parallax,
		                    proximity: 200
		                });
		            });
		        }

		        // Background Image

		        if( $this.attr("data-bg-image") !== undefined ){
		            $this.find(".ts-background").append('<div class="ts-background-image">');
		            $this.find(".ts-background-image").css("background-image", "url("+ $this.attr("data-bg-image") +")" );
		            $this.find(".ts-background-image").css("background-size", $this.attr("data-bg-size") );
		            $this.find(".ts-background-image").css("background-position", $this.attr("data-bg-position") );
		            $this.find(".ts-background-image").css("opacity", $this.attr("data-bg-image-opacity") );

		            $this.find(".ts-background-image").css("background-size", $this.attr("data-bg-size") );
		            $this.find(".ts-background-image").css("background-repeat", $this.attr("data-bg-repeat") );
		            $this.find(".ts-background-image").css("background-position", $this.attr("data-bg-position") );
		            $this.find(".ts-background-image").css("background-blend-mode", $this.attr("data-bg-blend-mode") );
		        }

		        // Parallax effect

		        if( $this.attr("data-bg-parallax") !== undefined ){
		            $this.find(".ts-background-image").addClass("ts-parallax-element");
		        }
		    }
		    else {

		        if(  $this.attr("data-bg-color") !== undefined ){
		            $this.css("background-color", $this.attr("data-bg-color") );
		            if( $this.hasClass("btn") ) {
		                $this.css("border-color", $this.attr("data-bg-color"));
		            }
		        }

		        if( $this.attr("data-bg-image") !== undefined ){
		            $this.css("background-image", "url("+ $this.attr("data-bg-image") +")" );

		            $this.css("background-size", $this.attr("data-bg-size") );
		            $this.css("background-repeat", $this.attr("data-bg-repeat") );
		            $this.css("background-position", $this.attr("data-bg-position") );
		            $this.css("background-blend-mode", $this.attr("data-bg-blend-mode") );
		        }

		    }
		});

		$("body").imagesLoaded( function() {
		    $("body").addClass("loading-done");
		    $(".ts-animate-hero-items .ts-bubble-border").each(function(){
		        var $this = $(this);
		        var $active = $(this).find(".active");

		        $this.width( $this.find(".active").outerWidth() );
		        $this.height( $this.find(".active").outerHeight() );

		        setTimeout(function(){
		            $(".ts-animate-hero-items .ts-bubble-border").addClass("in");
		            setInterval(function(){
		                $this.find(".active").addClass("out");
		                setTimeout(function(){
		                    $this.find(".active").removeClass("active out");
		                    if( $active.next().length ) {
		                        $active.next().addClass("active");
		                        $active = $active.next();
		                    }
		                    else {
		                        $active = $this.find(".ts-title-rotate span:first");
		                        $active.addClass("active");
		                    }
		                    $this.width( $this.find(".active").outerWidth() );
		                    $this.height( $this.find(".active").outerHeight() );

		                }, 800);
		            }, 3000);
		        }, 500);
		    });
		    $("[data-animate]").scrolla({
		        mobile: true
		    });
		});
	};

	/* ---------------------------------------------
	 Portfolio Carousel Gallery
	--------------------------------------------- */
	var WidgetServiceAjaxHandler = function( $scope, $ ) {
		
		var $service_link = $('.ts-link-arrow-effect, .ts-title-arrow-ajax');

		$service_link.on('click', function() {
			var post_id = $(this).attr("data-rel"); //this is the post id

			$.ajax({
			    url: selfer.ajaxurl,
			    type: 'GET',
			    data: {
			        action: 'selfer_service_ajax_content',
			        post_id: post_id
			    },
			    dataType: "html",
			    contentType: 'application/html; charset=utf-8',
			    beforeSend: function() {
			    	$('#post-modal-container').html('');
		           	$('#post-modal-container').append('<div class="spinner-content"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
		       	},
			    success: function(data) {
			        $('#post-modal-container').html(data);
			    },
			    error: function(data) {
			        console.log('No Service');
			    }
			});
		});
	};

	var WidgetcounterItem = function() {
		$(".ts-promo-numbers").each(function () {
            $(this).isInViewport(function(status) {
                if (status === "entered") {
                    for( var i=0; i < document.querySelectorAll(".odometer").length; i++ ){
                        var el = document.querySelectorAll('.odometer')[i];
                        el.innerHTML = el.getAttribute("data-odometer-final");
                    }
                }
            });
        });
	};

	/* ---------------------------------------------
	 Initialize Elementor Front Script
	--------------------------------------------- */
	$(window).on('elementor/frontend/init', function () {
		// Progress Bar
		elementorFrontend.hooks.addAction('frontend/element_ready/slefer-progressbar.default', WidgetSelferProgressbarHandler);
		// Testimonial Carousel
		elementorFrontend.hooks.addAction('frontend/element_ready/slefer-testimonials.default', WidgetSelferTestimonialCarouselHandler);
		// Service Carousel
		elementorFrontend.hooks.addAction('frontend/element_ready/slefer-service.default', WidgetSelferServiceCarouselHandler);
		// Portfolio Carousel
		elementorFrontend.hooks.addAction('frontend/element_ready/slefer-portfolio.default', WidgetSelferPortfolioHandler);
		// Carousel Script
		elementorFrontend.hooks.addAction('frontend/element_ready/selfer-banner.default', WidgetSelferBackgroundHandeler);
		// Nav Menu Script
		elementorFrontend.hooks.addAction('frontend/element_ready/selfer-nav-menu.default', WidgetselferNavMenu);

		elementorFrontend.hooks.addAction('frontend/element_ready/slefer-service.default', WidgetServiceAjaxHandler);
		
		elementorFrontend.hooks.addAction('frontend/element_ready/selfer-counter.default', WidgetcounterItem);

		elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
			//Global Content
			$(".ts-bubble-border").each(function () {
				var $this = $(this);
				$this.prepend("<i></i><i></i><i></i><i></i><i></i>");
			});
	
			$(".ts-bubble-border").each(function () {
				var $this = $(this);
				$this.isInViewport(function(status) {
					if (status === "entered") {
						$this.addClass("in");
					}
					else if (status === "leaved") {
						$this.removeClass("in");
					}
				});
			});
		} );
	});
})(jQuery);