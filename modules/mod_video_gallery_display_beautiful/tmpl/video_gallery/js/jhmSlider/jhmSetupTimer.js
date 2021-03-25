var jhmSetupTimer;

;(function($) {

	jhmSetupTimer = function(base, opt) {

		/**
         * Function: setupTimer
         */
        base.setupTimer = function()
        {
            var timerHTML = '<div class="jhm-timer"><div class="jhm-timer-mask"></div></div>';
                
            base.$jhmWrapper.append(timerHTML);
        }

        base.startTimer = function()
        {
            //Timer Execution
            function startClock() 
            {
                if (!opt.timer || opt.timer == 'false') 
                {
                    return false;
                } 
                else 
                {
                    // stop current if exist
                    if(base.clock) base.stopSliderLock();

                    // start new
                    base.pauseTimerAnimation(true);
                    base.doTimerAnimation();

                    base.clock = setInterval(function(e)
                    {
                        base.shift("next"); 

                        base.pauseTimerAnimation(true);

                        setTimeout(function() {
                            startClock();
                        }, opt.animationSpeed);

                    }, opt.advanceSpeed);
                }
            }

            function resumeClock()
            {
                var diffTime = getPausedInterval();

                base.pauseTimerAnimation();
                base.doTimerAnimation(diffTime);

                base.resumeClock = setTimeout(function()
                {
                    base.shift("next");

                    base.pauseTimerAnimation(true);

                    setTimeout(function() {
                        startClock();
                    }, opt.animationSpeed);

                }, diffTime);
            }

            function getPausedInterval()
            {
                var timer = base.$jhmWrapper.children('div.jhm-timer');
                var currentWidth = timer.children('div.jhm-timer-mask').width();
                var wrapperWidth = base.$jhmWrapper.width();

                var percentDiff = (currentWidth / wrapperWidth) * 100;

                var diffTime = opt.advanceSpeed - (opt.advanceSpeed * percentDiff) / 100;

                return diffTime;
            }

            // Timer Setup
            if (opt.timer && ! base.clock) 
            {
                var timer = base.$jhmWrapper.children('div.jhm-timer');

                if (timer.length != 0) 
                {
                    startClock();

                    if (opt.startClockOnMouseOut) {
                        var outTimer;
                        base.$jhmWrapper.mouseleave(function () {

                            outTimer = setTimeout(function () {
                                if (!base.timerRunning) {
                                    resumeClock();
                                }
                            }, opt.startClockOnMouseOutAfter)
                        })
                        base.$jhmWrapper.mouseenter(function () {
                            clearTimeout(outTimer);
                        })
                    }
                }

                // Pause Timer on hover
                if (opt.pauseOnHover) {
                    base.$jhmWrapper.mouseenter(function () {
                        base.stopSliderLock();
                    });
                }
            }
        }

        /**
         * Function: doTimerAnimation
         */
        base.doTimerAnimation = function(timeSpeed)
        {
            timeSpeed = timeSpeed ? timeSpeed : opt.advanceSpeed;

            if(base.css3support())
            {    
                enableTransition();
                doAnimate(timeSpeed);
            }

            /**
             * functions
             */
            function enableTransition()
            {
                var timer = base.$jhmWrapper.children('div.jhm-timer');

                timer.children('div.jhm-timer-mask')[0].offsetHeight; // Trigger a reflow, flushing the CSS changes
                timer.children('div.jhm-timer-mask').removeClass('notransition'); // Re-enable transitions
            }

            function doAnimate(timeSpeed)
            {
                var timer = base.$jhmWrapper.children('div.jhm-timer');

                timer.children('div.jhm-timer-mask')
                     .css({
                        'width': '100%',
                        'transition': 'width ' + timeSpeed + 'ms linear'
                     });
            }
        }

        /**
         * Function: pauseTimerAnimation
         */
        base.pauseTimerAnimation = function(reset)
        {
            var timer = base.$jhmWrapper.children('div.jhm-timer');
            var currentWidth = timer.children('div.jhm-timer-mask').width();

            if(reset) currentWidth = 0;

            if(base.css3support())
            {
                timer.children('div.jhm-timer-mask')
                     .addClass('notransition')
                     .css({
                        'width': currentWidth + 'px'
                     });
            }
        }

        /**
         * Function: setTimerWidth
         */
        base.setTimerWidth = function()
        {
            var timer = base.$jhmWrapper.children('div.jhm-timer');

            timer.width(base.jhmWidth);
        }
	}

})(jQuery);