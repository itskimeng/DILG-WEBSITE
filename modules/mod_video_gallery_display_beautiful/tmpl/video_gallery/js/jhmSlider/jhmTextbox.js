var jhmTextbox;

;(function($) {

    jhmTextbox = function(base, opt) {

        var textboxContent = [],
            arrTextboxHeight = [],
            textboxHeight,
            pagination,
            paginationBottom,
            isSetPaginationBottom = false;

		/**
         * Function: initOutsideTextbox
         */
        base.initOutsideTextbox = function()
        {
            if(! opt.textboxOutside) return;
            
            base.$el.css('background',opt.background); // set background to root element

            base.$jhmWrapper.append('<div class="jhm-outside-textbox jhm-position-sticky-bottom"></div>');
            base.$outsideTextbox = base.$jhmWrapper.children('.jhm-outside-textbox');

            base.$slides.each(function (index,slide) {
                var textbox = $(this).find('.jhm-textbox-inner');

                if(textbox.length > 0)
                {
                    textbox.children('.jhm-textbox-content')
                        .attr('class','jhm-textbox-content')
                        .removeAttr('style')
                        .css({
                            'box-sizing': 'border-box',
                            'background': 'none'
                        });

                    textboxContent[index] = textbox.html();

                    $(this).children('.jhm-textbox').remove();
                }
                else
                {
                    textboxContent[index] = false;
                }                
            });
        }


        /**
         * Function: initOutsideTextboxHeight
         */
        base.initOutsideTextboxDimension = function()
        {
            if(! opt.textboxOutside) return;

            base.$slides.each(function (index,slide) {
                base.$outsideTextbox.html(textboxContent[index]);
                var activeTextboxContent = base.$outsideTextbox.children('.jhm-textbox-content');
                
                arrTextboxHeight[index] = activeTextboxContent.outerHeight();
            });

            base.$outsideTextbox.html(''); // set to empty
            textboxHeight = Math.max.apply(Math,arrTextboxHeight); // get max height

            // apply bullet pagination position
            if(! isSetPaginationBottom) setPaginationBottom();
            
            if(opt.pagination == 'bullet')
            {
                pagination.css({
                    'bottom': parseInt(paginationBottom) + parseInt(textboxHeight) + 'px'
                });
            }
            else if(opt.pagination == 'content-horizontal')
            {
                textboxHeight = textboxHeight + parseInt(paginationBottom);
            }

            // apply size
            base.$el.height(base.jhmHeight + textboxHeight);
            base.$jhmWrapper.height(base.jhmHeight + textboxHeight);            
            
            // function setPaginationBottom
            function setPaginationBottom()
            {
                isSetPaginationBottom = true;

                // get paginationBottom
                if(opt.pagination == 'bullet')
                {                    
                    pagination = base.$pagination.parent();
                    paginationBottom = pagination.css('bottom').slice(0,-2);
                }
                else if(opt.pagination == 'content-horizontal')
                {
                    pagination = base.$pagination;
                    paginationBottom = pagination.outerHeight();
                }
            }
        }


        /**
         * Function: setOutsideTextbox
         */
        base.setOutsideTextbox = function()
        {
            if(! opt.textboxOutside) return;

            if(textboxContent[base.activeSlide])
            {
                base.$outsideTextbox.html(textboxContent[base.activeSlide]);
                var activeTextboxContent = base.$outsideTextbox.children('.jhm-textbox-content');
                var textboxBottom = textboxHeight - arrTextboxHeight[base.activeSlide];

                activeTextboxContent.css('bottom',textboxBottom + 'px');
                activeTextboxContent.hide(); // hide
                activeTextboxContent.fadeIn(opt.animationSpeed); // show animation
            }            
        }


        /**
         * Function: resizeEmContent
         */
        base.resizeEmContent = function()
        {
            var defaultPercent = 62.5;
            var newPercent = (base.originaljhmWidth / opt.width) * defaultPercent;

            base.$jhmWrapper.find('.jhm-textbox-content').css('font-size', newPercent + '%');
        }


        /**
         * Function: animateContent
         */
        base.animateContent = function(withDelay)
        {
            if(! opt.animateContent) return;

            var current = base.$currentSlide;
            var el = current.children('.jhm-textbox');

            if(el.length <= 0) return;
                
            var enabled = el.data('anim-enable');

            if(enabled.length <= 0) return;

            var animEl = '';

            $.each(enabled,function(index,value){
                animEl += value;

                if(index + 1 < enabled.length)
                {
                    animEl += ',';
                }
            });

            var animType = el.data('anim-type') ? el.data('anim-type') : 'transition.slideDownIn';
            var animDuration = el.data('anim-duration') ? el.data('anim-duration') : 1000;
            var animStagger = el.data('anim-stagger') ? el.data('anim-stagger') : 250;

            // do velocity
            if(withDelay)     
            {
                current.find(animEl).css('visibility','hidden');

                setTimeout(function() {                    
                    current.find(animEl).velocity(animType, {                        
                        duration: animDuration,
                        stagger: animStagger,
                        visibility: 'visible'
                    });
                }, 1);
            }
            else
            {
                current.find(animEl).css('visibility','hidden');
                current.find(animEl).velocity(animType, {
                    delay: opt.animationSpeed,
                    duration: animDuration,
                    stagger: animStagger,
                    visibility: 'visible'
                });
            }
        }
    }
})(jQuery);