var jhmResponsiveClass;

;(function($) {

	jhmResponsiveClass = function(base, opt) {

		/**
         * Function: doResponsiveClass
         */
        base.doResponsiveClass = function()
        {
            /**
             * Resposive Class
             * - jhm-responsive-mobile-small (width <= 369)
             * - jhm-responsive-mobile-medium (width <= 499 && width <= jhmWidth)
             * - jhm-responsive-full
             */

            if(370 <= base.jhmWidth && base.jhmWidth <= 499) {
                doResponsiveClassStart('jhm-responsive-mobile-medium')
            }
            else if(369 >= base.jhmWidth ) {
                doResponsiveClassStart('jhm-responsive-mobile-small')
            }
            else {
                // Desktop Mode
                doResponsiveClassStart('jhm-responsive-full')
            }

            function doResponsiveClassStart(responsiveClass){
                // if it is the first run dont do animation
                if(base.firstRun)
                {
                    base.firstRun = false
                    base.$jhmWrapper.attr('class','jhm-wrapper ' + opt.themeClass)
                    base.$jhmWrapper.addClass(responsiveClass)
                    return
                }

                if(base.old_responsive_class == responsiveClass) return

                base.old_responsive_class = responsiveClass

                base.$jhmWrapper.addClass(responsiveClass)
            }
        }
    }

})(jQuery);