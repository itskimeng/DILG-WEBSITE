/**
 * Rotation Script for nx-YouTubeBox 
 * @package     nx-YouTubeBox
 *
 * @copyright   Copyright (C) 2009 - 2017 nx-designs.
 * @license     GNU General Public License version 2 or later
*/

/* 	Credits goes to stackoverflow user Matti Mehtonen for this solution
	Link : http://stackoverflow.com/questions/19794171/css-rotate-element-while-staying-inside-container
*/

     function rotateScript (randomizer, deg) {
		 

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

            function getScale(degrees) {
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
            }

            return function (inner) {
                offsetAngle = Math.atan(inner.offsetWidth / inner.offsetHeight);
                originalHeight = inner.offsetHeight;
                originalFactor = Math.sqrt(Math.pow(inner.offsetHeight, 2) + Math.pow(inner.offsetWidth, 2));

                return {

                    rotate: function (degrees) {
                        setRotation (degrees, getScale(degrees), inner);
                    }
                };
            };

        }());

        var outer = document.getElementById('nx-youtubebox-'+randomizer+'-rotation'),
            inner = document.getElementById('nx-player_'+randomizer+'_outer'),
            rotator = setRotator(inner),
            degrees = deg;
         rotator.rotate(deg);
    }
