/**
 * Genesis Sample entry point.
 *
 * @package GenesisSample\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */
var genesisSample=function(e){"use strict";var i=function(){var i=0;"fixed"===e(".site-header").css("position")&&(i=e(".site-header").outerHeight()),e(".site-inner").css("margin-top",i)};return{load:function(){i(),e(window).resize(function(){i()}),"undefined"!=typeof wp&&void 0!==wp.customize&&wp.customize.bind("change",function(e){setTimeout(function(){i()},1500)})}}}(jQuery);jQuery(window).on("load",genesisSample.load);