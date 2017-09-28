/**
 * Created by ADMIN on 6/23/2016.
 */
/**
 * Description of iw-search-tour
 *
 * @developer truongdx
 */
(function ($) {
    $.fn.itmenuscroll = function() {
        var self = $(this);
        var total = self.find('li').length;
        var active = Math.round(total / 2);
        var item_height = self.find('li:eq(0)').height();//30
        var view_height = self.height();//150
        var active_top = (view_height/2) - (item_height/2);
        var search_form_container = $('.destination-menu-search-form .destination-search-form');

        self.find('li.active').animate({'top': active_top}, 80, function(){
            self.find('li').each(function(){
                if(!$(this).hasClass('active')){
                    var index = self.find('li').index($(this));
                    var top = active_top - ((active - index -1) * item_height);
                    $(this).css({'position' : 'absolute', 'top' : top+'px'});
                }
            });
        });

        self.on('click', 'li', function(){
            var index = self.find('li').index($(this)) + 1;
            var count = active - index;
            if(count < 0 ){
                scrolldown_menu(count);
            }
            else if(count > 0){
                scollup_menu(count);
            }
            else{
                return;
            }
            self.find('li').removeClass('active');
            $(this).addClass('active');

            search_form_container.find('.destination-field select').val($(this).data('destination-slug')).trigger("change");
            var background_image = $(this).data('destination-backgroundimg');
            if(background_image){
                var bgimage = self.closest('.intravel-destination-search').find('.intravel-destination-bgimage');
                var bgimage2 = self.closest('.intravel-destination-search').find('.intravel-destination-bgimage2');
                if(!bgimage.hasClass('transparent')){
                    bgimage2.css({'background-image' : 'url('+background_image+')'}).removeClass("transparent");
                    bgimage.addClass("transparent");
                }
                else{
                    bgimage.css({'background-image' : 'url('+background_image+')'}).removeClass("transparent");
                    bgimage2.addClass("transparent");
                }
            }
        });

        var scrolldown_menu = function(count){
            var j = 0;
            self.find('li').each(function(){
                var top = parseInt($(this).css('top')) + (count * item_height);
                $(this).css({'top' : top+'px'});
                j++;
                if(j == total){
                    for(i = 0; i < Math.abs(count); i++){
                        var top = parseInt(self.find('li:eq('+(total - 1)+')').css('top')) + item_height;
                        self.find('li:eq(0)').css({'top': top + 'px'}).insertAfter(self.find('li:eq('+(total - 1)+')'));
                    }
                }
            });
        };

        var scollup_menu = function(count){
            var j = 0;
            self.find('li').each(function(){
                var top = parseInt($(this).css('top')) + (count * item_height);
                $(this).css({'top' : top+'px'});
                j++;
                if(j == total){
                    for(i = 0; i < Math.abs(count); i++){
                        var top = parseInt(self.find('li:eq(0)').css('top')) - item_height;
                        self.find('li:eq('+(total - 1)+')').css({'top': top + 'px'}).insertBefore(self.find('li:eq(0)'));
                    }
                }
            });
        }
    };

    $(document).ready(function () {
        $(".destination-search-form .js-selected, .search-tour-style-2 .js-selected, .search-tour-style2 .iw-destination-tour .js-selected, .intravel-search-tour .js-selected").select2();
        $('.destination-menu-search-form ul').itmenuscroll();
        /*$('.destination-menu-search-form .destination-menu-item').click(function(){
            if(!$(this).hasClass('active')){
                var el_offset = $(this).offset();
                var destination_menu_offset = $('.destination-menu-search-form').offset();
                var search_form_container = $('.destination-menu-search-form .destination-search-form');
                search_form_container.hide();
                $('.destination-menu-search-form .destination-menu-item').removeClass('active');
                $(this).addClass('active');
                search_form_container.css({'top' : parseInt(el_offset.top) - parseInt(destination_menu_offset.top) + 'px'}).fadeIn();
                search_form_container.find('.destination-field select').val($(this).data('destination-slug')).trigger("change");
            }
        });
        if($('.destination-menu-search-form .destination-menu-item').hasClass('active')){
            var el_offset = $('.destination-menu-search-form .destination-menu-item.active').offset();
            var destination_menu_offset = $('.destination-menu-search-form').offset();
            var search_form_container = $('.destination-menu-search-form .destination-search-form');
            search_form_container.show();
            search_form_container.css({'top' : parseInt(el_offset.top) - parseInt(destination_menu_offset.top) + 'px'}).fadeIn();
            search_form_container.find('.destination-field select').val($(this).data('destination-slug')).trigger("change");
        }
       */
    });
})(jQuery);