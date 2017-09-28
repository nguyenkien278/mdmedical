(function($) {
    "use strict";

    // variables inicials
    var alcada = $(window).height() - 40;
    var amplada = $(window).width() - 40;

    var lastAnimation = 0;
    var animationTime = 1200; // in ms
    var quietPeriod = 100; // in ms, time after animation to ignore mousescroll

    var temps1 = 600; // 600
    var temps2 = 600; // 600

    var easingType = "easeInOutCubic";

    // calculem l'alçada quan reescalem
    $(window).resize(function () {
        alcada = $(window).height() - 40;
        amplada = $(window).width() - 40;
        if($(window).width() > 1024){
            $('body').addClass('scrollviewed');
            showScrollview();
        }
        else
        {
            hideScrollview();
            $('body').removeClass('scrollviewed');
        }
    });

    $(window).on("load", function () {
        if($(window).width() > 1024){
            $('body').addClass('scrollviewed');
            showScrollview();
        }
    });

    function showScrollview(){
        $('.overlay').click(function (e) {
            hideFooter();
        });

        // Aliniem els numeros al centre.
        /*
        $('.numbers').css({
            marginTop: -$('.numbers').height() / 2 + 'px'
        });
        */

        // click per la fletxa
        $('.header-version-5 .iw-nav-menu a').click(function (e) {
            e.preventDefault();
            var target = $(this).attr('href');
            if(target){
                var module = $(target).closest('.module');
                var number = $('.modules .module').index(module);

                if(number > -1){
                    $(this).closest('ul').find('li').removeClass('current');
                    $(this).closest('li').find('li').removeClass('current');
                    gotoProject(number + 1);
                }
            }
        });

        // iniciem
        //$('.modules .module:first-child').addClass('active');
        if(!$('.modules .module.active').length){
            $('.modules .module:first-child').addClass('active').css('z-index', 2);
        }
        $('.modules .module.active .container-1').css({
            "backface-visibility": "hidden",
            "-webkit-transform": "translate3d(0,0,0)",
            "-moz-transform": "translate3d(0,0,0)",
            "-ms-transform": "translate3d(0,0,0)",
            "transform": "translate3d(0,0,0)"
        });

        $('.modules .module.active .container-2').css({
            "backface-visibility": "hidden",
            "-webkit-transform": "translate3d(0,0,0)",
            "-moz-transform": "translate3d(0,0,0)",
            "-ms-transform": "translate3d(0,0,0)",
            "transform": "translate3d(0,0,0)"
        });

        $('.modules .module.active').css({
            "opacity": "1"
        });

        $('.modules .module:not(.active)').css({
            "opacity": "0"
        });

        $('.modules .module:not(.active) .container-1').css({
            "backface-visibility": "hidden",
            "-webkit-transform": "translate3d(0px, " + alcada + "px, 0px)",
            "-moz-transform": "translate3d(0px, " + alcada + "px, 0px)",
            "-ms-transform": "translate3d(0px, " + alcada + "px, 0px)",
            "transform": "translate3d(0px, " + alcada + "px, 0px)"
        });

        $('.modules .module:not(.active) .container-2').css({
            "backface-visibility": "hidden",
            "-webkit-transform": "translate3d(0px, -" + (alcada * 0.9) + "px, 0px)",
            "-moz-transform": "translate3d(0px, -" + (alcada * 0.9) + "px, 0px)",
            "-ms-transform": "translate3d(0px, -" + (alcada * 0.9) + "px, 0px)",
            "transform": "translate3d(0px, -" + (alcada * 0.9) + "px, 0px)"
        });

        $('.modules .module .page').css({
            "background-color": "#fff"
        });
        $('.modules .module:not(.active) .page').css({
            "opacity": "0"
        });


        // 1. és mòbil?
        /*if (isMobile.any) {
            console.log("tablet");

            // protegim els enllaços del viewcase del TouchMove
            $('body').on('click', '.viewcase a', function (e) {});

            // posem el touchMove
            $("#contents-main").bind('touchmove', function (e) {
                e.preventDefault();
            });

            $("#contents-main").swipe({
                //Generic swipe handler for all directions
                swipeUp: function (event, direction, distance, duration, fingerCount, fingerData) {
                    if ($('.modules .module.active').next('div').length) {
                        nextProject(temps1, temps2, 40);
                    } else {
                        showFooter(0);
                    }
                },
                swipeDown: function (event, direction, distance, duration, fingerCount, fingerData) {
                    if (!$('.module:first-child').hasClass('active')){
                        if ($('.modules .module.active').prev('div').length) {
                            prevProject(temps1, temps2, 40);
                        } else {
                            hideFooter();
                        }
                    }
                },
                threshold: 0
            });

            // l'overlay té el mateix comportament que el #contents-main perquè al footer ens tapa
            $(".overlay").swipe({
                //Generic swipe handler for all directions
                swipeUp: function (event, direction, distance, duration, fingerCount, fingerData) {
                    if ($('.modules .module.active').next('div').length) {
                        nextProject(temps1, temps2, 40);
                    } else {
                        showFooter(0);
                    }
                },
                swipeDown: function (event, direction, distance, duration, fingerCount, fingerData) {
                    if ($('.modules .module.active').prev('div').length) {
                        prevProject(temps1, temps2, 40);
                    } else {
                        hideFooter();
                    }
                },
                threshold: 0
            });

        } else {
            //console.log("no mobile");
            $('body').bind('mousewheel', showScrollviewMain);
        }
        */
        $('body').bind('mousewheel', showScrollviewMain);
    }

    function showScrollviewMain(e){
        var timeNow = new Date().getTime();
        // change this to deltaX/deltaY depending on which
        // scrolling dir you want to capture
        var deltaOfInterest = e.deltaY;
        if (deltaOfInterest == 0) {
            // event.preventDefault();
            return;
        }

        // Cancel scroll if currently animating or within quiet period
        if (timeNow - lastAnimation < quietPeriod + animationTime) {
            e.preventDefault();
            return;
        }

        if (deltaOfInterest < 0) {
            //console.log("abaix");
            lastAnimation = timeNow;
            if ($('.modules .module.active').next('div').length) {
                nextProject(temps1, temps2, 0);
            } else {
                showFooter(0);
            }
        } else {
            if (!$('.module:first-child').hasClass('active')) {
                //console.log("no estic al primer. canvio de projecte");
                lastAnimation = timeNow;
                if ($('.modules .module.active').prev('div').length) {
                    prevProject(temps1, temps2, 0);
                } else {
                    hideFooter();
                }
            }
        }
    }

    function hideScrollview(){
        $('.modules .module').attr('style', '');
        $('.modules .module .page').attr('style', '');
        //$('.modules .module.active .content > div').removeClass('visible');
        $('body').unbind('mousewheel', showScrollviewMain);
    }

    // funcions
    function showFooter(mobile) {
        $('.overlay').css({
            "display": "block",
            transform: "translate3d(0, -" + ($('footer .footer-inner > div').outerHeight() + mobile) + "px, 0)",
        });

        $('#contents-main').animate({
            top: "-" + ($('footer .footer-inner > div').outerHeight()) + "px"
        }, {
            duration: 300,
            easing: easingType
        });

        $('.overlay').animate({
            opacity: "0.75",
        }, {
            duration: 300,
            easing: easingType
        });

        $('.modules .module.active').removeClass('active');
    }

    function hideFooter() {
        //console.log("hide footer");

        $('#contents-main').animate({
            top: "0px"
        }, {
            duration: 300,
            easing: easingType
        });

        $('.overlay').animate({
            opacity: "0",
            transform: "translate3d(0, 0, 0)"
        }, {
            duration: 300,
            easing: easingType,
            complete: $('.overlay').css({
                "display": "none"
            })
        });

        $('.modules .module:last-child').addClass('active');
    }

    function nextProject(temps1, temps2, mobile, numbers) {

        var active = $('.modules .module.active');
        if(active.find('.iwe-speaker-block.style6').length){
            var numberSections = $('.ms-left').find('.ms-section').length;
            var leftIndex = $('.ms-left .ms-section.active').index();
            if(leftIndex < numberSections - 1){
                $.fn.multiscroll.moveSectionDown();
                return;
            }
        }

        if (!numbers) {
            var next = $('.modules .module.active').next('div');
        } else {
            var next = $('.modules .module:nth-child(' + numbers + ')');
        }

        active.find('.container-1').css({
            "-webkit-transform": "translate3d(0px, -" + (alcada + mobile) + "px, 0px)",
            "-moz-transform": "translate3d(0px, -" + (alcada + mobile) + "px, 0px)",
            "-ms-transform": "translate3d(0px, -" + (alcada + mobile) + "px, 0px)",
            "transform": "translate3d(0px, -" + (alcada + mobile) + "px, 0px)",

            "-webkit-transition": temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
            "-moz-transition": temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
            "-ms-transition": temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
            "transition": temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms"
        });

        active.find('.container-2').css({
            "-webkit-transform": "translate3d(0px, " + ((alcada + mobile) * 0.9) + "px, 0px)",
            "-moz-transform": "translate3d(0px, " + ((alcada + mobile) * 0.9) + "px, 0px)",
            "-ms-transform": "translate3d(0px, " + ((alcada + mobile) * 0.9) + "px, 0px)",
            "transform": "translate3d(0px, " + ((alcada + mobile) * 0.9) + "px, 0px)",

            "-webkit-transition": temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
            "-moz-transition": temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
            "-ms-transition": temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
            "transition": temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms"
        });

        setTimeout(function(){
            if (!numbers) {
                $('.numbers li.active').removeClass('active').next('li').addClass('active');
            } else {
                $('.numbers li.active').removeClass('active');
                $('.numbers li:nth-child(' + numbers + ')').addClass('active');
            }

            active.css({
                "z-index": "1",
                "opacity": "0",
            });
            next.css({
                "opacity": "1",
                "z-index": "2"
            });
            next.find('.page').css({
                "opacity": "1"
            });

            next.find('.container-1').css({
                "-webkit-transform": "translate3d(0px, 0, 0px)",
                "-moz-transform": "translate3d(0px, 0px, 0px)",
                "-ms-transform": "translate3d(0px, 0px, 0px)",
                "transform": "translate3d(0px, 0px, 0px)",

                "-webkit-transition": temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "-moz-transition": temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "-ms-transition": temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "transition": temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)"
            });

            next.find('.container-2').css({

                "-webkit-transform": "translate3d(0px, 0, 0px)",
                "-moz-transform": "translate3d(0px, 0px, 0px)",
                "-ms-transform": "translate3d(0px, 0px, 0px)",
                "transform": "translate3d(0px, 0px, 0px)",


                "-webkit-transition": temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "-moz-transition": temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "-ms-transition": temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "transition": temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)"
            });
        }, temps1*0.95);

        setTimeout(function(){
            active.css({
                'z-index': ''
            });
            active.removeClass('active');
            next.addClass('active');
            //$('.modules .module.active .content > div').addClass('visible');
            //$('.modules .module.active').find('.animate').addClass('visible');
            if ($('body').hasClass('about')) {
                $('.modules .module.active').find('.anim').addClass('startAnimation');
            }
        }, (temps1*0.95)+temps2);
    }

    function prevProject(temps1, temps2, mobile, numbers) {

        var active = $('.modules .module.active');

        if(active.find('.iwe-speaker-block.style6').length){
            //var numberSections = $('.ms-right').find('.ms-section').length;
            var leftIndex = $('.ms-left .ms-section.active').index();
            if(leftIndex >= 1 ){
                $.fn.multiscroll.moveSectionUp();
                return;
            }
        }

        if (!numbers) {
            var prev = $('.modules .module.active').prev('div');
        } else {
            var prev = $('.modules .module:nth-child(' + numbers + ')');
        }

        active.find('.container-1').css({

            "-webkit-transform": "translate3d(0px, " + (alcada + mobile) + "px, 0px)",
            "-moz-transform": "translate3d(0px, " + (alcada + mobile) + "px, 0px)",
            "-ms-transform": "translate3d(0px, " + (alcada + mobile) + "px, 0px)",
            "transform": "translate3d(0px, " + (alcada + mobile) + "px, 0px)",

            "-webkit-transition": "-webkit-transform "+temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
            "-moz-transition": "-moz-transform "+temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
            "-ms-transition": "-ms-transform "+temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
            "transition": "transform "+temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
        });

        active.find('.container-2').css({
            "-webkit-transform": "translate3d(0px, -" + ((alcada + mobile) * 0.9) + "px, 0px)",
                "-moz-transform": "translate3d(0px, -" + ((alcada + mobile) * 0.9) + "px, 0px)",
                "-ms-transform": "translate3d(0px, -" + ((alcada + mobile) * 0.9) + "px, 0px)",
                "transform": "translate3d(0px, -" + ((alcada + mobile) * 0.9) + "px, 0px)",

                "-webkit-transition": "-webkit-transform "+temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
                "-moz-transition": "-moz-transform "+temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
                "-ms-transition": "-ms-transform "+temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
                "transition": "transform "+temps1+"ms cubic-bezier(0.5, 0.15, 0.17, 1) 0ms",
        });

        setTimeout(function(){
            if (!numbers) {
                $('.numbers li.active').removeClass('active').prev('li').addClass('active');
            } else {
                $('.numbers li.active').removeClass('active');
                $('.numbers li:nth-child(' + numbers + ')').addClass('active');
            }
            active.css({
                "z-index": "1",
                "opacity": "0",
            });

            prev.css({
                "opacity": "1",
                "z-index": "2"
            });

            prev.find('.page').css({
                "opacity": "1"
            });

            prev.find('.container-1').css({
                "-webkit-transform": "translate3d(0px, 0px, 0px)",
                "-moz-transform": "translate3d(0px, 0px, 0px)",
                "-ms-transform": "translate3d(0px, 0px, 0px)",
                "transform": "translate3d(0px, 0px, 0px)",

                "-webkit-transition": "-webkit-transform "+temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "-moz-transition": "-moz-transform "+temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "-ms-transition": "-ms-transform "+temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "transition": "transform "+temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)"
            });

            prev.find('.container-2').css({
                "-webkit-transform": "translate3d(0px, 0px, 0px)",
                "-moz-transform": "translate3d(0px, 0px, 0px)",
                "-ms-transform": "translate3d(0px, 0px, 0px)",
                "transform": "translate3d(0px, 0px, 0px)",

                "-webkit-transition": "-webkit-transform "+temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "-moz-transition": "-moz-transform "+temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "-ms-transition": "-ms-transform "+temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)",
                "transition": "transform "+temps2+"ms cubic-bezier(0.5, 0.15, 0.17, 1)"
            });
        }, temps1*0.95);

        setTimeout(function(){
            active.css({
                'z-index': ''
            });
            active.removeClass('active');
            prev.addClass('active');
        }, (temps1*0.95)+temps2);

    }

    window.gotoProject = function(num) {
        num = num;
        var activeProject = $('.modules .module.active').index() + 1;
        if (num != activeProject) {
            if (num > activeProject) {
                nextProject(temps1, temps2, 0, num);
            } else {
                prevProject(temps1, temps2, 0, num);
            }
        }
    }
})(jQuery);
