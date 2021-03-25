<script type="text/javascript">
	/* 	Thanks to stackoverflow user Matti Mehtonen for this solution
		Link : http://stackoverflow.com/questions/19794171/css-rotate-element-while-staying-inside-container
	*/
     function rotateScript (randomizer, deg) {
         console.log('Rotator started');
         console.log(randomizer+' mit '+deg+' Grad');

        var setRotator = (function () {
            var setRotation,
                setScale,
                offsetAngle,
                originalHeight,
                originalFactor;

            setRotation = function (degrees, scale, element) {
                element.style.webkitTransform = 'rotate(' + degrees + 'deg) scale(' + scale + ')';
                element.style.transform = 'rotate(' + degrees + 'deg) scale(' + scale + ')';
            };

            getScale = function (degrees) {
                var radians = degrees * Math.PI / 180,
                    sum;

                if ((degrees < 90) && (degrees > 0)) {
                    sum = radians - offsetAngle;
                } else if ((degrees > -90) && (degrees < 0)) {
                    sum = radians + offsetAngle;
                } else {
                    sum = radians + offsetAngle;
                }

                return (originalHeight / Math.cos(sum)) / originalFactor;
            };

            return function (inner) {
                offsetAngle = Math.atan(inner.offsetWidth / inner.offsetHeight);
                originalHeight = inner.offsetHeight;
                originalFactor = Math.sqrt(Math.pow(inner.offsetHeight, 2) + Math.pow(inner.offsetWidth, 2));

                return {

                    rotate: function (degrees) {
                        setRotation (degrees, getScale(degrees), inner);
                    }
                }
            };

        }());

        var outer = document.getElementById('nxouter_'+randomizer),
            inner = document.getElementById('nxplayer_'+randomizer),
            rotator = setRotator(inner),
            degrees = deg-90;
        //console.log(degrees);
         rotator.rotate(degrees);
    };
</script>