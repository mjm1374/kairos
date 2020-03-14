jQuery(document).ready(function($){'use strict';

	// Sticky Nav
	$(window).on('scroll', function(){
		if ( $(window).scrollTop() > 100 ) {
			$('.menubar').addClass('sticky-header');
		} else {
			$('.menubar').removeClass('sticky-header');
		}
	});

   /* ----------------------------------------------------------- */
   /*  Back to top
   /* ----------------------------------------------------------- */

       $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
      // scroll body to 0px on click
      $('#back-to-top').on('click',function () {
          $('#back-to-top').tooltip('hide');
          $('body,html').animate({
              scrollTop: 0
          }, 800);
          return false;
      });

      $('#back-to-top').tooltip('hide');


	// Search
	$('.icon-search-btn').on('click', function(event) {
		event.preventDefault();
		var $sitesearch = $('.site-search');
		if ($sitesearch.hasClass('show')) {
			$sitesearch.removeClass('show');
			$sitesearch.fadeOut('fast');
		}else{
			$sitesearch.addClass('show');
			$sitesearch.fadeIn('slow');
		}
	});

	$('.icon-search-btn-close').on('click', function(event) {
		event.preventDefault();

		var $sitesearch = $('.site-search');
		$sitesearch.removeClass('show');
		$sitesearch.fadeOut('fast');
	});

	/* ----------------------------------------------------------- */
	/*  Title
	/* ----------------------------------------------------------- */
	jQuery('.bizspeak-title h2,.widget h3').each(function() {
      var txt = jQuery(this).html();
      var index = txt.indexOf(' ');
      if (index == -1) {
         index = txt.length;
      }
      jQuery(this).html('<span>' + txt.substring(0, index) + '</span>' + txt.substring(index, txt.length));
   });

	/* ----------------------------------------------------------- */
	/*  Counter
	/* ----------------------------------------------------------- */

	$('.counter').counterUp({
	 delay: 10,
	 time: 1000
	});


	// Bootstrap menu magic
	$(window).resize(function() {
		if ($(window).width() < 768) {
		  $(".dropdown-toggle").attr('data-toggle', 'dropdown');
		} else {
		  $(".dropdown-toggle").removeAttr('data-toggle dropdown');
		}
	});

    $('.woocommerce-product-gallery__image a').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }
    });

});