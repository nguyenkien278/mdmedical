(function ($) {
	"use strict";

    window.iwOpenWindow = function (url) {
        window.open(url, 'sharer', 'toolbar=0,status=0,left=' + ((screen.width / 2) - 300) + ',top=' + ((screen.height / 2) - 200) + ',width=650,height=380');
        return false;
    };

    /** theme prepare data */

    function theme_init() {
       
    }
	
	function add_class_sub_menu(){
        $('ul.iw-nav-menu .number-1-column').closest('li').addClass('wrap-1-column');
        $('ul.iw-nav-menu .number-2-column').closest('li').addClass('wrap-2-column has-mega');
        $('ul.iw-nav-menu .number-3-column').closest('li').addClass('wrap-3-column has-mega');
        $('ul.iw-nav-menu .number-4-column').closest('li').addClass('wrap-4-column has-mega');
        $('ul.iw-nav-menu .number-5-column').closest('li').addClass('wrap-5-column has-mega');
        $('ul.iw-nav-menu .number-6-column').closest('li').addClass('wrap-6-column has-mega');
        $('ul.iw-nav-menu .number-7-column').closest('li').addClass('wrap-7-column has-mega');
    }
	
	function addMenuWidth(){
		$.fn.hasAttr = function(name) {  
			return this.attr(name) !== undefined;
		};
		$("ul.iw-nav-menu li ul.sub-menu li a").each(function () {
            if ($(this).hasAttr("data-width-submenu")) {
				$(this).closest('li').css('width', $(this).attr("data-width-submenu"));
			}
        });
		$("ul.iw-nav-menu > li > a").each(function () {
            if ($(this).hasAttr("data-image")) {
				var bg = $(this).attr('data-image');
				// $(this).parent('li').find('ul.sub-menu:first-child').css('background-image', $(this).attr("data-image"));
				$(this).closest('li').find('.sub-menu').first().css('background-image', 'url(' + bg + ')').addClass('sub-menu-bg');
			}
        });
		
		
		
	}
	/**
		waypoint function
	*/
	function waypoint_init() {
        // if (typeof $.fn.waypoint != 'function' || !$('body').hasClass('waypoints')) {
            // return;
        // }
        $.fn.iwAnimate = function (effect, delay) {
            var el = this;
            $(el).addClass('animate');
            setTimeout(function () {
                $(el).addClass(effect).addClass('animated');
            }, delay)
        }
       
        var init_delay = 0;
        $('.jm-solution').waypoint(function () {
            var delay = init_delay;
			
            $(this).find('.solution-item').each(function (index) {
				$(this).iwAnimate('zoomIn', 100);
                delay = delay + 300;
                $('.solution-item-inner', this).iwAnimate('zoomIn', delay + 300);
            });
        }, {
            offset: '80%',
            triggerOnce: true
        });
    }

    /**
     * Woocommerce increase/decrease quantity function
     */
    function woocommerce_init() {
        var owl = $(".product-detail .product-essential .owl-carousel");
        if(owl.length) {
            owl.owlCarousel({
                direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr',
                items: 5,
                itemsDesktopSmall: [979, 5],
                itemsTablet: [768, 4],
                itemsTabletSmall: false,
                itemsMobile: [479, 3],
                pagination: false,
                navigation: true,
                navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            });
        }
		
		// $('.quickview').each(function () {
			$('.quickview').on('click', function (e) {
				$('.product-content .quickview-box').fadeOut();
				$('.product-content .arrow-view').fadeOut();
				$(this).closest('.product-content').find('.quickview-box').fadeIn();
				$(this).closest('.product-content').find('.arrow-view').fadeIn();
				e.preventDefault();
				
				var height_el = $(this).closest('.product-content').find('.quickview-box').height();
				var top_el = $(this).closest('.product-content').find('.quickview-box').offset().top - 80;
				// alert(top_el);
				// $('body').scrollTop(top_el);
				$('html, body').animate({scrollTop:top_el}, 'slow');
				
			});
			$('.close-quickview').on('click', function (e) {
				$(this).closest('.quickview-box').fadeOut();
				$('.arrow-view').fadeOut();
			});
		// });
		
        /** Quick view product */
        // var buttonHtml = '';
        // $('.quickview').on('click', function (e) {
            // var el = this;
			// $('body').append('<div class="loadingProduct"></div>');
            // buttonHtml = $(el).html();
            // $(el).html('<i class="quickviewloading fa fa-cog fa-spin"></i>');
            // var effect = $(el).find('input').val();
            // Custombox.open({
                // target: woocommerce_params.ajax_url + '?action=load_product_quick_view&product_id=' + el.href.split('#')[1],
                // effect: effect ? effect : 'fadein',
                // loading:{
                    // delay:5000,
                    // parent:['sk-wandering-cubes'],
                    // childrens:[
                        // ['sk-cube','sk-cube1'],
                        // ['sk-cube','sk-cube2']
                    // ]
                // },
                // complete: function () {
                    // $(el).html(buttonHtml);
                    // var owl = $(".quickview-box .product-detail .product-essential .owl-carousel");
                    // owl.owlCarousel({
                        // direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr',
                        // items: 4,
                        // itemsDesktopSmall : [979, 5],
                        // itemsTablet : [768, 4],
                        // itemsTabletSmall : false,
                        // itemsMobile : [479, 3],
                        // pagination: false,
                        // navigation : true,
                        // navigationText : ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    // });
					// $('.loadingProduct').remove();
                    // $(".quickview-body .next").click(function () {
                        // owl.trigger('owl.next');
                    // });
                    // $(".quickview-body .prev").click(function () {
                        // owl.trigger('owl.prev');
                    // });
                    // $(".quickview-body .woocommerce-main-image").click(function (e) {
                        // e.preventDefault();
                    // });
                    // $(".quickview-body .owl-carousel .owl-item a").click(function (e) {
                        // e.preventDefault();
                        // if ($(".quickview-body .woocommerce-main-image img").length == 2) {
                            // $(".quickview-body .woocommerce-main-image img:first").remove();
                        // }
                        // $(".quickview-body .woocommerce-main-image img").fadeOut(function () {
                            // $(".quickview-body .woocommerce-main-image img").stop().hide();
                            // $(".quickview-body .woocommerce-main-image img:last").fadeIn();
                        // });
                        // $(".quickview-body .woocommerce-main-image").append('<img class="attachment-shop_single wp-post-image" style="display:none;" src="' + this.href + '" alt="">');

                    // })
                // },
                // close: function () {
                    // $(el).html(buttonHtml);
                // }
            // });
            // e.preventDefault();

        // });
		
		$('body').on('added_to_cart', function () {
			var data = {'action': 'mode_theme_update_mini_cart'};
			// $('.wc-forward').remove();
			$.ajax({
				url: woocommerce_params.ajax_url,
				type: 'POST',
				dataType: 'html',
				data:data,
				success: function (result) {
                    $('#mode-mini-cart').html(result);
					// $('.wc-forward').remove();
                },
				error: function( a, b, c ){ console.log(a, b, c); },
			});
		});

        // $('.add_to_wishlist').on('click', function (e) {
            // if ($(this).find('.fa-check').length) {
                // e.preventDefault();
                // return;
            // }
            // $(this).addClass('wishlist-adding');
            // $(this).find('i').removeClass('fa-star').addClass('fa-cog fa-spin');
        // });

        // $('.yith-wcwl-add-to-wishlist').appendTo('.add-to-box');
        // $('.yith-wcwl-add-to-wishlist .link-wishlist').appendTo('.add-to-box form.cart');
        // if ($('.variations_form .variations_button').length) {
            // $('.yith-wcwl-add-to-wishlist .link-wishlist').appendTo('.variations_form .variations_button');
        // }

        //trigger events add cart and wishlist
        // $('body').on('added_to_wishlist', function () {
            // $('.wishlist-adding').html('<i class="fa fa-check"></i>');
            // $('.wishlist-adding').removeClass('wishlist-adding');
        // });

        /**
         * submitProductsLayout
         */
        // window.submitProductsLayout = function (layout) {
            // $('.product-category-layout').val(layout);
            // $('.woocommerce-ordering').submit();
        // };

        $("#woo-tab-contents .box-collateral").hide(); // Initially hide all content
        $("#woo-tab-buttons li:first").attr("class","current"); // Activate first tab
        $("#woo-tab-contents .box-collateral:first").show(); // Show first tab content

        $('#woo-tab-buttons li a').click(function(e) {
            e.preventDefault();
            $("#woo-tab-contents .box-collateral").hide(); //Hide all content
            $("#woo-tab-buttons li").attr("class",""); //Reset id's
            $(this).parent().attr("class","current"); // Activate this
            $($(this).attr('href')).fadeIn(); // Show content for current tab
        });
    }

    /**
     * Carousel social footer
     */
    function carousel_init() {
        $(".owl-carousel").each(function () {
            var slider = $(this);
            var defaults = {
                direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr'
            };
            var config = $.extend({}, defaults, slider.data("plugin-options"));
            // Initialize Slider
            slider.owlCarousel(config).addClass("owl-carousel-init");
        });

        // $('.post-gallery .gallery,.post-text .gallery').each(function () {
            // var galleryOwl = $(this);
            // var classNames = this.className.toString().split(' ');
            // var column = 1;
            // $.each(classNames, function (i, className) {
                // if (className.indexOf('gallery-columns-') != -1) {
                    // column = parseInt(className.replace(/gallery-columns-/, ''));
                // }
            // });
            // galleryOwl.owlCarousel({
                // direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr',
                // items: column,
                // singleItem: true,
                // navigation: true,
                // pagination: false,
                // navigationText: ["<i class=\"fa fa-arrow-left\"></i>", "<i class=\"fa fa-arrow-right\"></i>"],
                // autoHeight: true
            // });
        // });
    }

    /**
     parallax effect */
    function parallax_init() {
        $('.iw-parallax').each(function () {
            $(this).css({
                'background-repeat': 'no-repeat',
                'background-attachment': 'fixed',
                'background-size': '100% auto',
                'overflow': 'hidden'
            }).parallax("50%", $(this).attr('data-iw-paraspeed'));
        });
        $('.iw-parallax-video').each(function () {
            $(this).parent().css({"height": $(this).attr('data-iw-paraheight'), 'overflow': 'hidden'});
            $(this).parallaxVideo("50%", $(this).attr('data-iw-paraspeed'));
        });
    };
	
	function topSearchEffect(){
		$('body').click(function() {
			if ($('.search-form-header').hasClass('show')){
				if (!$('.top-search').is(":focus")){
					$('.search-form-header').removeClass('show');
					$('.btn-show-search-form i').removeClass('fa-times').addClass('fa-search');
				}
			}
		});
		
		$(".btn-show-search-form").click(function(e) {
			e.stopPropagation();
			if ($('.search-form-header').hasClass('show')){
				$('.search-form-header').removeClass('show');
				$('i',this).removeClass('fa-times').addClass('fa-search');
			} else {
				$('.search-form-header').addClass('show');
				$('i',this).removeClass('fa-search').addClass('fa-times');
			}
		});
	}



   /*** RUN ALL FUNCTION */
	/*doc ready*/
    $(document).ready(function () {
		add_class_sub_menu();
        woocommerce_init();
        parallax_init();
        theme_init();
		waypoint_init();
        carousel_init();
        $(".fit-video").fitVids();
		topSearchEffect();
		addMenuWidth();
		
		$('.datepicker').datetimepicker({
			yearStart: 2017,
			timepicker:false,
			format:'d/m/Y',
			formatDate:'d/m/Y',
			minDate: new Date(),
		});
		$('.timepicker').datetimepicker({
			datepicker:false,
			allowTimes:['9:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00',],
			format:	'H:i',
			formatTime:	'H:i',
		});
		
		$('p:empty').remove();
		
		$('.comments-tab').iwTabs('tab');
		
		$( '.woocommerce-ordering input[type="radio"]' ).on( 'click', function() {
			$( this ).closest( 'form' ).submit();
			// $(this).attr('checked',true);
		});
		
		var ticker = function()
			{
				setTimeout(function(){
					$(".head_lines .head_line:first").animate( {marginTop: '-28px'}, 500, function()
					{
						$(this).detach().appendTo(".head_lines").removeAttr("style");	
					});
					ticker();
				}, 5000);
			};
			ticker();
		
		
		if ($('.single-lan-da-category-block').length > 0){
			var position_bottom = $('.single-lan-da-category-block').position().top + $('.single-lan-da-category-block').outerHeight() - 35;
			var position_top = $('.single-lan-da-category-block').position().top;
			
			$(document).on('scroll', function() {
				var offset_document = $(this).scrollTop();
				
				
				if (offset_document > position_bottom) {
					$('.list-icon').addClass('scrolling');
				} else {
					$('.list-icon').removeClass('scrolling');
				}
				  
				if (offset_document > position_top) {
					$('.list-icon').css('top', (offset_document - position_top + 30));
				} else {
					$('.list-icon').css('top', '20px');
				}
			});
			$('.list-icon').click(function(){
				$('html, body').animate({scrollTop:0}, 'slow');
				return false;
			});
		}
		
		$('.product-content .product-img-box .zoom').fancybox({
			helpers:  {
				thumbs : {
					width: 50,
					height: 50
				}
			}
        });

		$("select.check-last-option").change(function(){
			if($(this).val()==$(this).children().last().val()){
				// alert($(this).attr("name"));
				$(this).closest('.field-control').find('.txt_tinhtrangkhac').show();
			} else {
				$(this).closest('.field-control').find('.txt_tinhtrangkhac').hide();
			}
		});
		
		$("select.has-use").change(function(){
			if($(this).val()=='Có'){
				// alert($(this).attr("name"));
				$(this).closest('.field-control').find('.txt_tensanpham').show();
			} else {
				$(this).closest('.field-control').find('.txt_tensanpham').hide();
			}
		});
		
        
		if($('.back-to-top').length){
			$('a[href=#page-top]').click(function(){
				$('html, body').animate({scrollTop:0}, 'slow');
				return false;
			});
		}
		
		if($('select.js-selected').length){
			$('select.js-selected').select2();
		}

        //rating comment
        $('.commentratingbox').rating();
    });

	/*window loaded */
	$(window).on('load',function(){
        // Page Preloader
        $('.se-pre-con').fadeOut('slow', function () {
            $(this).remove();
        });
        parallax_init();

	});
	
	
	
	$(window).load(function(){
        if( $('#scrollbox3').length){
            $('#scrollbox3').enscroll({
                showOnHover: false,
                verticalTrackClass: 'track3',
                verticalHandleClass: 'handle3'
            });
        }
		if( $('.off-canvas-menu').length){
            $('.off-canvas-menu').enscroll({
                showOnHover: false,
                verticalTrackClass: 'track3',
                verticalHandleClass: 'handle3'
            });
        }
    });

    $(window).on('load resize',function(){
        var $h_li = $('.iw-testimonals.style1 .iw-testimonial-item:nth-child(1)').outerHeight() + $('.iw-testimonals.style1 .iw-testimonial-item:nth-child(2)').outerHeight();
        var document_with = $(document).width();
        $('#scrollbox3').css("height",+ $h_li);
    });
	
	
	

	
})(jQuery);

