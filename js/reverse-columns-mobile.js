jQuery(document).ready(function ($) {

    var columns = $('.wp-block-columns');

    // run on every set of columns
    columns.each(function () {

        var count = $(this).children().length;

        if (count != 2)
            returnfalse;

        // get the last child 
        var lastchild = $(this).children('.wp-block-column:last-child');

        // get the thing that might be an image
        var maybeimage = $(lastchild).find(">:first-child");

        // figure out if the thing we just grabbed is a gallery or an image
        var hasclass = maybeimage.is('.wp-block-image, .wp-block-gallery');

        if (hasclass === true)
            $(this).addClass('reverse-order-on-mobile');

    });

});