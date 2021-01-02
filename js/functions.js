var dierrewebThemeModule;

(function($) {
  "use strict";

    dierrewebThemeModule = (function() {

      var dierrewebTheme = {
        popupEffect: 'mfp-move-horizontal',
  			bootstrapTooltips: '.dierreweb-tooltip'
  		};

      return {
        init: function() {
          // MIEI
          // this.subMenu();
          //
          // this.resizeMenu();
          //
          // this.navBarSide();


          this.headerBanner();

          this.headerBuilder();

          // this.parallax();

          this.scrollTop();

          this.scrollProgress();

          this.stickyColumn();

          this.mfpPopup();

          this.blogMasonry();

          // this.blogLoadMore();

          // this.portfolioLoadMore();

  				// this.menuSetUp();
          //
  				// this.menuOffsets();
          //
  				// this.onePageMenu();
          //
  				// this.mobileNavigation();
          //
  				// this.simpleDropdown();

          this.promoPopup();

          this.contentPopup();

          this.cookiesPopup();

          this.btnsToolTips();

          this.stickyFooter();

          // this.fullScreenMenu();

          // this.searchFullScreen();

          // this.lazyLoading();

  				// this.ajaxSearch();

          this.stickySocialButtons();

          // this.animationsOffset();

          this.owlCarouselInit();

          this.woocommerceNotices();

          // this.buttonSmoothScroll();

          // this.ageVerify();

          this.imagesGalleryMasonry();

          this.imagesGalleryJustified();

          $(window).resize();
        },

        headerBanner: function () {
  				var banner_version = dierreweb_settings.header_banner_version,
    					banner_btn = dierreweb_settings.header_banner_close_btn,
    					banner_enabled =dierreweb_settings.header_banner_enabled;

  				if(Cookies.get('dierreweb_tb_banner_' + banner_version) == 'closed' || banner_btn == false || banner_enabled == false) return;
  				var banner = $('.header-banner');

  				if (!$('body').hasClass('page-template-maintenance')) {
  					$('body').addClass('header-banner-display');
  				}

  				banner.on('click', '.close-header-banner', function(e) {
  					e.preventDefault();
  					closeBanner();
  				})

  				var closeBanner = function () {
  					$('body').removeClass('header-banner-display').addClass('header-banner-hide');
  					Cookies.set('dierreweb_tb_banner_' + banner_version, 'closed', { expires: 60, path: '/' });
  				};

  			},

        headerBuilder: function() {
  				var $header = $('.header'),
    					$stickyElements = $('.sticky-row'),
    					$firstSticky = '',
    					headerHeight = $header.find('.main-header').outerHeight(),
    					$window = $(window),
    					isSticked = false,
    					adminBarHeight = $('#wpadminbar').outerHeight(),
    					stickAfter = 300

  				$stickyElements.each(function() {
  					if($(this).outerHeight() > 10) {
  						$firstSticky = $(this);
  						return false;
  					}
  				});

  				// Real header sticky option
  				if($header.hasClass('header-sticky-real')) {

  					// if no sticky rows
  					if($firstSticky.length == 0 || $firstSticky.outerHeight() < 10) return;

  					$header.addClass('header-sticky-prepared').css({
  						paddingTop: headerHeight
  					})

  					stickAfter = $firstSticky.offset().top - adminBarHeight

  				}

  				var previousScroll;

  				$window.on('scroll', function() {
  					var after = stickAfter;
  					var currentScroll = $(window).scrollTop();
  					var windowHeight = $(window).height();
  					var documentHeight = $(document).height();

  					if(currentScroll > after) {
  						stickHeader();
  					} else {
  						unstickHeader();
  					}
  				});

  				function stickHeader() {
  					if(isSticked) return
    					isSticked = true
    					$header.addClass('header-sticked')
  				}

  				function unstickHeader() {
  					if(!isSticked) return
    					isSticked = false
    					$header.removeClass('header-sticked')
  				}

  			},

        scrollTop: function() {
          var btn = $('.scrollToTop');
          $(window).scroll(function() {
            if($(window).scrollTop() > 100) {
              btn.addClass('button-show');
            } else {
              btn.removeClass('button-show');
            }
          });

          //Click event to scroll to top
  				$('.scrollToTop').on('click', function () {
  					$('html, body').animate({
  						scrollTop: 0
  					}, 800);
  					return false;
  				});
        },

        scrollProgress: function() {
          var docHeight = $(document).height(),
          windowHeight = $(window).height(),
          scrollPercent;

          $(window).scroll(function() {
            scrollPercent = $(window).scrollTop() / (docHeight - windowHeight) * 100;
          $('.progress-bar').width(scrollPercent + '%');
          });
        },

        stickyColumn: function() {
          if(!$('body').hasClass('has-sticky-sidebar') || $(window).width() <= 992) return;
          $('.sidebar-inner').stick_in_parent({
            offset_top: 150
          });
        },

        mfpPopup: function() {
          $('.wp-block-gallery').each(function() {
            $(this).magnificPopup({
    					delegate: 'a',
    					type: 'image',
    					removalDelay: 500, //delay removal by X to allow out-animation
    					tClose: dierreweb_settings.close,
    					tLoading: dierreweb_settings.loading,
    					callbacks: {
    						beforeOpen: function () {
    							this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
    							this.st.mainClass = dierrewebTheme.popupEffect;
    						}
    					},
    					image: {
    						verticalFit: true
    					},
    					gallery: {
    						enabled: true,
    						navigateByImgClick: true
    					},
    				});
          });

          $('.gallery').each(function() {
            $(this).magnificPopup({
    					delegate: '[rel="mfp"]',
    					type: 'image',
    					removalDelay: 500, //delay removal by X to allow out-animation
    					tClose: dierreweb_settings.close,
    					tLoading: dierreweb_settings.loading,
    					callbacks: {
    						beforeOpen: function () {
    							this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
    							this.st.mainClass = dierrewebTheme.popupEffect;
    						}
    					},
    					image: {
    						verticalFit: true
    					},
    					gallery: {
    						enabled: true,
    						navigateByImgClick: true
    					},
    				});
          });

          $('.open-gallery > a').magnificPopup({ // was [data-rel="mfp"]
  					type: 'image',
  					removalDelay: 500, //delay removal by X to allow out-animation
  					tClose: dierreweb_settings.close,
  					tLoading: dierreweb_settings.loading,
  					callbacks: {
  						beforeOpen: function () {
  							this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
  							this.st.mainClass = dierrewebTheme.popupEffect;
  						}
  					},
  					image: {
  						verticalFit: true
  					},
  					gallery: {
  						enabled: false,
  						navigateByImgClick: false
  					},
  				});

  				$(document).on('click', '.mfp-img', function () {
  					var mfp = jQuery.magnificPopup.instance; // get instance
  					mfp.st.image.verticalFit = !mfp.st.image.verticalFit; // toggle verticalFit on and off
  					mfp.currItem.img.removeAttr('style'); // remove style attribute, to remove max-width if it was applied
  					mfp.updateSize(); // force update of size
  				});
        },

        blogMasonry: function() {
          if(typeof ($.fn.masonry) == 'undefined' || typeof ($.fn.imagesLoaded) == 'undefined') return;
          var $container = $('.masorny-container');

          // layout Masonry after each image loads
          $container.imagesLoaded(function() {
            $container.masonry({
            	itemSelector: '.blog-design-masorny'
            });
          });
        },

        // onePageMenu: function () {
        //
  			// 	var scrollToRow = function (hash) {
  			// 		var row = $('#' + hash);
        //
  			// 		if (row.length < 1) return;
        //
  			// 		var position = row.offset().top;
        //
  			// 		$('html, body').animate({
  			// 			scrollTop: position - woodmart_settings.one_page_menu_offset
  			// 		}, 800);
        //
  			// 		setTimeout(function () {
  			// 			activeMenuItem(hash);
  			// 		}, 800);
  			// 	};
        //
  			// 	var activeMenuItem = function (hash) {
  			// 		var itemHash;
  			// 		$('.onepage-link').each(function () {
  			// 			itemHash = $(this).find('> a').attr('href').split('#')[1];
        //
  			// 			if (itemHash == hash) {
  			// 				$('.onepage-link').removeClass('current-menu-item');
  			// 				$(this).addClass('current-menu-item');
  			// 			}
        //
  			// 		});
  			// 	};
        //
  			// 	$('body').on('click', '.onepage-link > a', function (e) {
  			// 		var $this = $(this),
  			// 			hash = $this.attr('href').split('#')[1];
        //
  			// 		if ($('#' + hash).length < 1) return;
        //
  			// 		e.preventDefault();
        //
  			// 		scrollToRow(hash);
        //
  			// 		// close mobile menu
  			// 		$('.woodmart-close-side').trigger('click');
  			// 		$('.full-screen-close-icon').trigger('click');
  			// 		console.log(123);
  			// 	});
        //
  			// 	if ($('.onepage-link').length > 0) {
  			// 		$('.entry-content > .vc_section, .entry-content > .vc_row').waypoint(function () {
  			// 			var hash = $(this).attr('id');
  			// 			activeMenuItem(hash);
  			// 		}, { offset: 150 });
        //
  			// 		// $('.onepage-link').removeClass('current-menu-item');
        //
  			// 		// URL contains hash
  			// 		var locationHash = window.location.hash.split('#')[1];
        //
  			// 		if (window.location.hash.length > 1) {
  			// 			setTimeout(function () {
  			// 				scrollToRow(locationHash);
  			// 			}, 500);
  			// 		}
        //
  			// 	}
  			// },

        promoPopup: function() {
  				var promo_version = dierreweb_settings.popup_version;

  				if($('body').hasClass('page-template-maintenance') || dierreweb_settings.enable_popup != 'true' || (dierreweb_settings.promo_popup_hide_mobile == 'true' && $(window).width() < 768) || (Cookies.get('dierreweb_age_verify') != 'confirmed' && dierreweb_settings.age_verify == 'yes') ) return;

  				var popup = $('.promo-popup'),
  					shown = false,
  					pages = Cookies.get('dierreweb_shown_pages');

  				var showPopup = function () {
  					$.magnificPopup.open({
  						items: {
  							src: '.promo-popup'
  						},
  						type: 'inline',
  						removalDelay: 500, //delay removal by X to allow out-animation
  						tClose: dierreweb_settings.close,
  						tLoading: dierreweb_settings.loading,
  						callbacks: {
  							beforeOpen: function () {
  								this.st.mainClass = dierrewebTheme.popupEffect + ' promo-popup-wrapper';
  							},
  							open: function () {
  								// Will fire when this exact popup is opened
  								// this - is Magnific Popup object
  							},
  							close: function () {
  								Cookies.set('popup_' + promo_version, 'shown', { expires: 7, path: '/' });
  							}
  							// e.t.c.
  						}
  					});
  					$(document).trigger('images-loaded');
  				};

  				$('.open-newsletter').on('click', function(e) {
  					e.preventDefault();
  					showPopup();
  				})

  				if(!pages) pages = 0;

  				if(pages < dierreweb_settings.popup_pages) {
  					pages++;
  					Cookies.set('dierreweb_shown_pages', pages, { expires: 7, path: '/' });
  					return false;
  				}

  				if(Cookies.get('dierreweb_popup_' + promo_version) != 'shown') {
  					if(dierreweb_settings.popup_event == 'scroll') {
  						$(window).scroll(function () {
  							if(shown) return false;
  							if($(document).scrollTop() >= dierreweb_settings.popup_scroll) {
  								showPopup();
  								shown = true;
  							}
  						});
  					} else {
  						setTimeout(function () {
  							showPopup();
  						}, dierreweb_settings.popup_delay);
  					}
  				}
  			},

        contentPopup: function () {
  				var popup = $('.open-popup');

  				popup.magnificPopup({
  					type: 'inline',
  					removalDelay: 500, //delay removal by X to allow out-animation
  					tClose: dierreweb_settings.close,
  					tLoading: dierreweb_settings.loading,
  					callbacks: {
  						beforeOpen: function () {
  							this.st.mainClass = dierrewebTheme.popupEffect + ' content-popup-wrapper';
  						},

  						open: function () {
  							$(document).trigger('images-loaded');
  						}
  					}
  				});
  			},

        cookiesPopup: function() {
  				var cookies_version = dierreweb_settings.cookies_version;
  				if(Cookies.get('dierreweb_cookies_' + cookies_version) == 'accepted') return;
  				var popup = $('.cookies-popup');

  				setTimeout(function() {
  					popup.addClass('popup-display');
  					popup.on('click', '.cookies-accept-btn', function(e) {
  						e.preventDefault();
  						acceptCookies();
  					})
  				}, 2500);

  				var acceptCookies = function() {
  					popup.removeClass('popup-display').addClass('popup-hide');
  					Cookies.set('dierreweb_cookies_' + cookies_version, 'accepted', { expires: 60, path: '/' });
  				};
  			},

        btnsToolTips: function() {
          if($(window).width() <= 1024) return;

          var $tooltips = $('.tooltip-inner'),
  					  $bootstrapTooltips = $(dierrewebTheme.bootstrapTooltips);

          $tooltips.each(function() {
  					$(this).find('.tooltip-label').remove();
  					$(this).addClass('tltp').prepend('<span class="tooltip-label">' + $(this).text() + '</span>');
  					$(this).find('.tooltip-label').trigger('mouseover');
  				})

          $bootstrapTooltips.tooltip({
  					animation: false,
  					container: 'body',
  					trigger: 'hover',
  					title: function() {
  						return $(this).text();
  					}
  				});
        },

        stickyFooter: function() {
          if( !$('body').hasClass('has-sticky-footer-on') || $(window).width() <= 992) return;
          var $footer = $('footer'),
              $page = $('.main-page-wrapper'),
              $window = $(window);

          if($('.prefooter').length > 0) {
            $page = $('.prefooter');
          }

          var footerOffset = function() {
            $page.css({
              marginBottom: $footer.outerHeight()
            });
          };
          footerOffset();
          $window.on('resize', footerOffset);

          // Safari fix
  				var footerSafariFix = function () {
  					if(!$('html').hasClass('browser-Safari')) return;
  					var windowScroll = $window.scrollTop();
  					var footerOffsetTop = $(document).outerHeight() - $footer.outerHeight();

  					if (footerOffsetTop < windowScroll + $footer.outerHeight() + $window.outerHeight()) {
  						$footer.addClass('visible-footer');
  					} else {
  						$footer.removeClass('visible-footer');
  					}
  				};

  				footerSafariFix();
  				$window.on('scroll', footerSafariFix);
        },

        stickySocialButtons: function() {
  				$('.dierreweb-sticky-social').addClass('buttons-loaded');
  			},

        // animationsOffset: function () {
  			// 	if (typeof ($.fn.waypoint) == 'undefined') return;
        //
  			// 	$('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').waypoint(function () {
  			// 		$(this).addClass('wpb_start_animation animated')
  			// 	}, {
  			// 			offset: '100%'
  			// 		});
  			// },

        owlCarouselInit: function() {

        },

        woocommerceNotices: function() {
          if(!$('body').hasClass('has-notifications-sticky'))return;
          var notices = 'div.wpcf7-response-output, .mc4wp-alert';
          $('body').on('click', notices, function() {
            var $msg = $(this);
            hideMessage($msg);
          });
          var showAllMessages = function() {
            $notices.addClass('shown-notice');
          };
          var hideAllMessages = function() {
            hideMessage($notices);
          };
          var hideMessage = function($msg) {
            $msg.removeClass('shown-notice').addClass('hidden-notice');
          };
        },

        // buttonSmoothScroll: function () {
  			// 	$('.woodmart-button-wrapper.wd-smooth-scroll a').on('click', function(e) {
  			// 		e.stopPropagation();
  			// 		e.preventDefault();
        //
  			// 		var $button = $(this);
  			// 		var time = $button.parent().data('smooth-time');
  			// 		var offset = $button.parent().data('smooth-offset');
  			// 		var hash = $button.attr('href').split('#')[1];
        //
  			// 		var $anchor = $('#' + hash);
        //
  			// 		if ($anchor.length < 1) {
  			// 			return;
  			// 		}
        //
  			// 		var position = $anchor.offset().top;
        //
  			// 		$('html, body').animate({
  			// 			scrollTop: position - offset,
  			// 		}, time);
  			// 	});
  			// },

        // ageVerify: function () {
  			// 	if ( dierreweb_settings.age_verify != 'yes' || Cookies.get('woodmart_age_verify') == 'confirmed' ){
  			// 		return;
  			// 	}
        //
  			// 	$.magnificPopup.open({
  			// 		items: {
  			// 			src: '.age-verify'
  			// 		},
  			// 		type: 'inline',
  			// 		closeOnBgClick: false,
  			// 		closeBtnInside: false,
  			// 		showCloseBtn: false,
  			// 		enableEscapeKey: false,
  			// 		removalDelay: 500,
  			// 		tClose: woodmart_settings.close,
  			// 		tLoading: woodmart_settings.loading,
  			// 		callbacks: {
  			// 			beforeOpen: function () {
  			// 				this.st.mainClass = dierrewebTheme.popupEffect + ' promo-popup-wrapper';
  			// 			},
  			// 		}
  			// 	});
        //
  			// 	$('.age-verify-allowed').on('click', function(){
  			// 		Cookies.set('dierreweb_age_verify', 'confirmed', { expires: parseInt( dierreweb_settings.age_verify_expires ), path: '/' });
  			// 		$.magnificPopup.close();
  			// 	});
        //
  			// 	$('.age-verify-forbidden').on('click', function(){
  			// 		$('.age-verify').addClass('wd-forbidden');
  			// 	});
  			// },

        imagesGalleryMasonry: function () {
  				if (typeof($.fn.masonry) == "undefined" || typeof($.fn.imagesLoaded) == "undefined") return;
  				var $container = $(".view-masonry .blocks-gallery-grid");

  				// initialize Masonry after all images have loaded
  				$container.imagesLoaded(function() {
  					$container.masonry({
  						itemSelector: ".blocks-gallery-item"
  					});
  				});

          // var $gallery = $(".gallery");
          //
  				// // initialize Masonry after all images have loaded
  				// $gallery.imagesLoaded(function() {
  				// 	$gallery.masonry({
  				// 		itemSelector: ".gallery-item"
  				// 	});
  				// });
  			},

        imagesGalleryJustified: function() {
          // $(".gallery").each(function() {
  				// 	$(this).justifiedGallery({
          //     // selector: '.cazz',
          //     // imgSelector: 'img',
  				// 		margins: 2,
  				// 		cssAnimation: true,
          //     rowHeight: 300,
          //     captions: false
  				// 	});
  				// });

          $('.view-justified').each(function() {
  					$(this).find('.blocks-gallery-grid').justifiedGallery({
              selector:	'.blocks-gallery-item',
              imgSelector: 'img',
              margins: 2,
  						cssAnimation: true,
              rowHeight: 300,
              captions: false
  					});
  				});


        },


      }
    }());

})(jQuery);

jQuery(window).load(function() {
	jQuery('.preloader').delay(parseInt(dierreweb_settings.preloader_delay)).addClass('preloader-hide');
	jQuery('.preloader-style').remove();
	setTimeout(function() {
		jQuery('.preloader').remove();
	}, 200);
});

jQuery(document).ready(function() {
	dierrewebThemeModule.init();
});

// subMenu: function() {
//   $('body').on('click', '.arrow-collapse', function(e) {
//     var $this = $(this);
//     if($this.closest('li').find('.collapse').hasClass('show')) {
//       $this.removeClass('active');
//     } else {
//       $this.addClass('active');
//     }
//     e.preventDefault();
//   });
// },
//
// resizeMenu: function() {
//   $(window).resize(function() {
//     var $this = $(this), w = $this.width();
//     if(w > 992) {
//       if($('.burger').hasClass('active')) {
//         $('.burger').removeClass('active');
//         $('.mobile-menu').removeClass('mobile-menu-open');
//         $('.side-menu').removeClass('side-menu-open');
//         $('.close-side').removeClass('close-side-open');
//         $('body').removeClass('overflow-hidden');
//         $('.mobile-menu').fadeOut();
//       }
//
//       if($('.mobile-menu').hasClass('active')) {
//
//       }
//     }
//   });
// },
//
// navBarSide: function() {
//   $('body').on('click', '.js-side-menu-toggle, .close-side', function(e) {
//     var $this = $(this);
//     e.preventDefault();
//     $('.side-menu').toggleClass('side-menu-open');
//     if($($this).hasClass('active')) {
//       $this.removeClass('active');
//       $('.close-side').removeClass('close-side-open');
//       $('body').removeClass('overflow-hidden');
//     } else if($($this).hasClass('close-side-open')) {
//        $this.removeClass('close-side-open');
//        $('.js-side-menu-toggle').removeClass('active');
//        $('body').removeClass('overflow-hidden');
//     } else {
//       $this.addClass('active');
//       $('.close-side').addClass('close-side-open');
//       $('body').addClass('overflow-hidden');
//     }
//   });
// },
