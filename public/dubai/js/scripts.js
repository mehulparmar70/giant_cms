var $ = jQuery.noConflict();
$mainHeaderHeight = $('.main-header').outerHeight();

/* Script on ready
------------------------------------------------------------------------------*/
$( document ).ready( function() {
	/* Responsive Jquery Navigation */
	$('.main-dropdown-nav, .main-dropdown-nav ul li ul').slideUp();
	if (window.matchMedia('(max-width: 991px)').matches) {
		$('.main-dropdown-nav-wrap .hamburger').click(function() {
			$(this).toggleClass('is-open');
			$('.main-dropdown-nav').slideToggle();
		});
	};
	$(document).on("click", function (event) {
		if ($(event.target).closest(".main-dropdown-nav-wrap").length === 0) {
			$('.main-dropdown-nav-wrap .hamburger').removeClass('is-open');
			$('.main-dropdown-nav').slideUp();
		}
	});
	$('.main-dropdown-nav ul li ul').parent().addClass('has-child');
	$('.main-dropdown-nav ul li.has-child').prepend('<button class="menu-open-button"><img src="assets/images/double-line-down-angle.svg" alt="down-angle">menu-open-button</button>');
	$('.menu-open-button').click( function() {
		$(this).toggleClass('child-open');
		$(this).parent().find('ul').slideToggle();
	} );
	/* header sticky */
	$(window).scroll(function() {
		if ($(this).scrollTop() > 1){
			$('.main-header').addClass("sticky");
		} else{
			$('.main-header').removeClass("sticky");
		}
	});
	if ($(window).scrollTop() > 1){
		$('.main-header').addClass("sticky");
	} else{
		$('.main-header').removeClass("sticky");
	}
	/* banner top space */
	$('.header-top-space').css('padding-top', $mainHeaderHeight);
	if ($(window).width() < 991) {
		$('.banner-slider-section, .common-inner-banner').css('margin-top', $mainHeaderHeight);
	}
	

	/* banner slider */

	// $('.banner-slider').revolution({
	// 	delay:9000,
	// 	startwidth:1170,
	// 	startheight:400,
	// 	hideThumbs:10,
	// 	lazyLoad:"on",
	// 	forceFullWidth:"on",
	// 	fullWidth:"on"
	// });

	$('.banner-slider').owlCarousel({
		loop: true,
		nav:false,
		items:1,
		animateIn: 'fadeIn', // add this
  		animateOut: 'fadeOut', // and this
	})


	/* jump to next section */
	$( '.banner-down-btn' ).on( 'click', function(e) {
		e.preventDefault();
		$( 'html, body' ).animate({ scrollTop: $($( this ).attr( 'href' )).offset().top - 80}, 500, 'linear' );
	});
	/* updates-slider */
	var updatesSlider = $('.updates-slider');
	updatesSlider.owlCarousel({
		loop:true,
		nav:true,
		navContainer: '.updates-custom-nav',
		autoplay: {
			delay: 2000,
		},
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
				dots: true,
			},
			768:{
				dots: false,
			},
			992:{
				items:3,
				dots: false,
			},
		}
	})
	$('.updates-second-prev').click(function() {
        updatesSlider.trigger('prev.owl.carousel');
    });
	$('.updates-second-next').click(function() {
        updatesSlider.trigger('next.owl.carousel');
    });
	/* products-slider */
	var productsSlider = $('.products-slider');
	productsSlider.owlCarousel({
		loop: true,
		nav:true,
		dots: false,
		navContainer: '.products-custom-nav',
		autoplay: {
			delay: 2000,
		},
		responsive:{
			0:{
				items:1
			},
			576:{
				items:2
			},
			992:{
				items:3
			}
		}
	})
	/* product-detail-slider */
	$(function () {
		var productDetailSlider = $('.product-detail-slider');
		productDetailSlider.owlCarousel({
			nav: true,
			dots: false,
			items: 1,
			navContainer: '.product-detail-custom-nav',
			onInitialized: counter,
			onTranslated: counter,
			loop: true,
		});
	
		function counter(event) {
			var items = event.item.count; // Total number of items
			var index = (event.item.index - event.relatedTarget._clones.length / 2) % items;
	
			// Correct the index for looping
			if (index < 0) {
				index += items;
			}
			index += 1; // Convert to 1-based index
	
			// Update the counter display
			$('.product-slider-counter').html(index + " / " + items);
		}
	});
	
	
	// $(function(){
	// 	var productDetailSlider = $('.product-detail-slider');
	// 	productDetailSlider.owlCarousel({
	// 		nav:true,
	// 		dots: false,
	// 		items: 1,
	// 		navContainer: '.product-detail-custom-nav',
	// 		onInitialized: counter,
	// 		onTranslated: counter,
	// 		loop: true,
	// 		// autoplay: {
	// 		// 	delay: 2000,
	// 		// },
	// 	});
	// 	function counter(event) {
	// 		var items = event.item.count;
	// 		var item  = event.item.index - 1;
	// 		if(item > items) { item = item - items }
	// 		$('.product-slider-counter').html(item+"/"+items)
	// 	}
	// });
	/* footer slider */
	var footerTopSlider = $('.footer-top-row');
	footerTopSlider.owlCarousel({
		nav:true,
		dots: false,
		mouseDrag: false,
		autoHeight: true,
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			// 1200:{
			// 	items:5,
			// },
		}
	})
	var footerBottomSlider = $('.footer-bottom-row');
	footerBottomSlider.owlCarousel({
		nav:true,
		dots: false,
		mouseDrag: false,
		autoHeight: true,
		responsive:{
			0:{
				items:1,
				loop:true,
				autoplay: {
					delay: 2000,
				},
			},
			575:{
				items:2,
				loop:true,
				autoplay: {
					delay: 2000,
				},
			},
			992:{
				items:3,
			},
		}
	});
	/* about-content-height */
	shareAboutBox = $('.share-about-box').outerHeight();
	shareAboutBtn = $('.share-about-btn').outerHeight();
	$('.about-middle-contect-inner').css('height', shareAboutBox-shareAboutBtn-33+69);
	lineclamp();
	/* button tag insert for animation */
	setTimeout(function () {
		$(".btn:not(.dropdown-toggle), .owl-prev, .owl-next, .breadcrumb-back, .pagination li a").addClass("btn-animation");
		$(".btn-animation").prepend("<strong></strong><strong></strong><strong></strong><strong></strong>");
		$(".owl-prev, .owl-next, .breadcrumb-back, .pagination li a").prepend("<strong></strong><strong></strong><strong></strong><strong></strong>");
	}, 200);

	// Select all elements with the class 'theme-stroke-heading .letters'
	$('.theme-stroke-heading .letters').each(function() {
		var $textWrapper = $(this);

		// Split each character into a span, adding an extra class if it's inside the <span>
		$textWrapper.html($textWrapper.html().replace(/(<\/?span[^>]*>)|(\S)/g, function(match, p1, p2) {
			if (p2) {
				// Check if we are inside the <span> tag
				var insideSpan = $textWrapper.find('span').length > 0 && $textWrapper.find('span').contents().filter(function() {
					return this.nodeType === 3 && this.nodeValue === p2;
				}).length > 0;
				
				return `<span class='letter'>${p2}</span>`;
			}
			// Keep the original <span> tags
			return p1 || '';
		}));

		// Function to play the animation
		function playAnimation() {
			anime.timeline({ loop: false })
			.add({
				targets: $textWrapper.find('.letter').toArray(),
				scale: [0, 1],
				duration: 1500,
				elasticity: 600,
				delay: (el, i) => 45 * (i + 1)
			}).add({
				targets: $textWrapper.get(0),
				opacity: 1,
				duration: 1000,
				easing: "easeOutExpo",
				delay: 1000
			});
		}

		// Add hover event listeners using jQuery
		$textWrapper.on('mouseenter', playAnimation);
	});

	/* fancybox */
	if ($("[data-fancybox]").length > 0) {
		Fancybox.bind("[data-fancybox]", {
			// Your custom options
		});
	}

	  

	$(document).ready(function() {
		$('[data-fancybox="gallery"]').fancybox({
		  // Enable History for clean URLs
		  hash: false, // Prevents default hash-based navigation
		  afterShow: function(instance, current) {
			// Update the URL based on the image title
			let imageTitle = current.opts.$orig.attr('data-slug') || 'image';
			let cleanUrl = window.location.origin + window.location.pathname + '/' + imageTitle.replace(/\s+/g, '-').toLowerCase();
			window.history.pushState(null, null, cleanUrl);
		  },
		  afterClose: function() {
			// Revert to the original URL when the Fancybox is closed
			window.history.pushState(null, null, window.location.pathname);
		  }
		});
	  });

	  
	setInterval(function () {
		$(".boxnav__item--next").click();
	}, 5000);

	$(".products-box-img.has-slider").owlCarousel({
		nav:false,
		dots: false,
		mouseDrag: false,
		items:1,
		loop:true,
		animateOut: 'fadeOut',
		animateIn: 'fadeIn',
		autoplay: {
			delay: 2000,
		}
	});
	
} );

/* Script on load
------------------------------------------------------------------------------*/
$( window ).on( 'load',function() {

} );

/* Script on scroll
------------------------------------------------------------------------------*/
$( window ).on( 'scroll',function() {

} );

/* Script on resize
------------------------------------------------------------------------------*/
$( window ).on( 'resize',function() {
	if ($(window).width() < 991) {
		$('.banner-slider-section, .common-inner-banner').css('margin-top', $mainHeaderHeight);
	} else {
		$('.banner-slider-section, .common-inner-banner').css('margin-top', 0);
	}
	lineclamp();
} );

/* Script all functions
------------------------------------------------------------------------------*/
function lineclamp() {
	var lineheight = parseFloat($('.about-middle-contect-inner p').css('line-height'));
	var calc = parseInt(shareAboutBox/lineheight);
	$(".about-middle-contect-inner").css({"-webkit-line-clamp": "" + calc + ""});
}

// JavaScript to detect and redirect URLs with '#!'
document.addEventListener('DOMContentLoaded', function () {
    const currentUrl = window.location.href;

    // Check if the URL contains '#!'
    if (currentUrl.includes('#!')) {
        // Redirect to a "Page Not Found" page
        window.location.href = '/page-not-found'; // Replace '/page-not-found' with your actual 404 URL
    }
});
