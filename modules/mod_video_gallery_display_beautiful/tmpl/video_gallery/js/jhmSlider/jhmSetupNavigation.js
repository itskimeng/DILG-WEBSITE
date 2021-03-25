var jhmSetupNavigation;

;(function($) {

    jhmSetupNavigation = function(base, opt) {

        var btnTop;

    	/**
         * Function: setupDirectionalNav
         */
        base.setupDirectionalNav = function()
        {
            if (opt.directionalNav != 'none') 
            {
                if (opt.directionalNav == "false") {
                    return false;
                }
                
                if(opt.animation == "vertical-slide")
                {
                    var arrow_right = 'down';
                    var arrow_left = 'up';                    
                }
                else
                {
                    var arrow_right = 'right';
                    var arrow_left = 'left';                    
                }

                var directionalNavHTML = '<div class="jhm-slider-nav"><span class="jhm-arrow-' + arrow_right + '"></span><span class="jhm-arrow-' + arrow_left + '"></span></div>';
                base.$jhmWrapper.append(directionalNavHTML);
                var leftBtn = base.$jhmWrapper.children('div.jhm-slider-nav').children('span.jhm-arrow-' + arrow_left),
                    rightBtn = base.$jhmWrapper.children('div.jhm-slider-nav').children('span.jhm-arrow-' + arrow_right);
                leftBtn.click(function () {
                    base.stopSliderLock();
                    base.shift("prev");
                });
                rightBtn.click(function () {
                    base.stopSliderLock();
                    base.shift("next")
                });

                /** 
                 * autohide behaviour
                 */
                if(opt.directionalNav == 'autohide')
                {
                    var btn = base.$jhmWrapper.children('div.jhm-slider-nav').children('span');
                    var btnAnimateSpeed = 300;

                    btn.css("opacity", opt.directionalNavHideOpacity);

                    base.$jhmWrapper.mouseenter(function(){
                        
                        btn.stop( true, true );

                        btn.animate({
                            "opacity": opt.directionalNavShowOpacity
                        }, btnAnimateSpeed);
                    });
                    base.$jhmWrapper.mouseleave(function(){

                        btn.stop( true, true );
                        
                        btn.animate({
                            "opacity": opt.directionalNavHideOpacity
                        }, btnAnimateSpeed);
                    });
                }
            }
        }


        /**
         * Function: setNavPosition
         */
        base.setNavPosition = function()
        {
            if(opt.directionalNav == 'none') return;
            
            var btn = base.$jhmWrapper.children('div.jhm-slider-nav').children('span');

            if(opt.animation == "vertical-slide")
            {
                var downBtn = base.$jhmWrapper.children('div.jhm-slider-nav').children('span.jhm-arrow-down');
                var downBtnBottom = downBtn.css('bottom').slice(0,-2);

                if(opt.pagination == 'content-horizontal')
                {
                    var pagination = base.$pagination
                    var bottom = parseInt(pagination.outerHeight()) + parseInt(downBtnBottom);
                }                

                // down nav arrow
                downBtn.css('bottom', bottom + 'px');
                btn.css('left', ((base.jhmWidth / 2) - (btn.width() / 2)) + 'px');
            }
            else
            {
                var downRight = base.$jhmWrapper.children('div.jhm-slider-nav').children('span.jhm-arrow-right');

                // pagination content-vertical
                if(opt.pagination == 'content-vertical')
                {
                    downRight.css({
                        'right': opt.paginationContentWidth + 'px'
                    })
                }

                btnTop = ((base.jhmHeight / 2) - (btn.height() / 2)) + 'px';

                btn.css({
                    'top': btnTop
                })
            }
        }
    }

})(jQuery);