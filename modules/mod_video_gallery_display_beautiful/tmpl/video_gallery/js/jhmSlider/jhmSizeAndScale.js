var jhmSizeAndScale;

;(function($) {

    jhmSizeAndScale = function(base, opt) {
		
        /**
         * Function: setupScaleImage
         */
        base.setupScaleImage = function(imageDom)
        {
            // if carousel
            // if(opt.carousel) var sliderWidth = base.jhmWidth * opt.carouselWidth / 100;
            // else var sliderWidth = base.jhmWidth;
            var sliderWidth = base.jhmWidth;

            // scaleImage
            if(opt.scaleImage)
            {
                imageDom.each(function(index){
                    
                    var width = sliderWidth;
                    var height = base.getImgHeight(width,index,imageDom.length);
                    var slideHeight = $(this).parent().height();

					if(base.jhmHeight > height) 
                    {


                        var curImgWidth = base.getImgWidth(base.jhmHeight,index,imageDom.length);
                        var curDiffWidth = (curImgWidth - sliderWidth) * -1;

                        $(this).css({
                            'height': base.jhmHeight + 'px',
                            'width': curImgWidth + 'px',
                            'max-height': base.jhmHeight + 'px',
                            'max-width': curImgWidth + 'px',
                            'margin-left': curDiffWidth / 2  + 'px'
                        })

                        // neutralize
                        $(this).css({
                            'margin-top': ''
                        })
					}
					else 
                    {
                        var diff = base.jhmHeight - height;

						if(opt.imageVerticalAlign == 'top') {
                            $(this).css('margin-top', '0px');
						}
						else if(opt.imageVerticalAlign == 'bottom') {
                            $(this).css('margin-top', diff + 'px');
						}
						else {
                            $(this).css('margin-top', (diff / 2) + 'px');
						}

                        $(this).css({
                            'width': width + 'px',
                            'max-width': width + 'px'
                        })

                        // neutralize
                        $(this).css({
                            'height': 'auto',
                            'max-height':'none',
                            'margin-left': ''
                        })
					}

                    // width                    
                    $(this).parent().width(width);
                })
            }
            else
            {
                var padding = 10;
                var curImgHeight = base.jhmHeight - (padding * 2);
                var curParWidth = imageDom.parent().width();
                var curParHeight = imageDom.parent().height();

                // image
                imageDom.css({
                    'border-radius': '3px'
                });

                // parent
                imageDom.parent().css({
                    'padding': padding + 'px',
                    'width': (curParWidth - padding * 2) + 'px',
                    'height': (curParHeight - padding * 2) + 'px'
                });

                // container
                var contWidth = sliderWidth - (padding * 2);
                var contHeight = base.jhmHeight - (padding * 2);

                // horizontal center align
                imageDom.each(function(index){
                    var width = base.getImgWidth(curImgHeight,index,imageDom.length);
                    var diff = contWidth - width;

                    if(diff > 0)
                    {
                        $(this).css({
                            'margin-left': (diff / 2) + 'px',
                            'margin-top': '0px',
                            'height': curImgHeight + 'px'
                        });
                    }
                    else
                    {
                        var width = sliderWidth;
                        var height = base.getImgHeight(width,index,imageDom.length);
                        var diff = contHeight - height;

                        $(this).css({
                            'margin-left': '0px',
                            'margin-top': (diff / 2) + 'px',
                            'height': height + 'px'
                        });
                    }
                })
            }
        }

        /**
         * Function: setupScaleIframe
         */
        base.setupScaleIframe = function(iframeDom)
        {
            iframeDom.each(function(index){
                $(this).width(base.jhmWidth);
                $(this).height(base.jhmHeight);
            });
        }
	}

})(jQuery);