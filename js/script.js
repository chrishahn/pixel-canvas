var drag = false,
    active = "",
    html = "",
    defaultHtml = "<input name='canvas[]' type='hidden' value='0'/>";

$(function() {
    $('.colors, .recent').on('mousedown', '.color', function(e) {
        e.preventDefault();
        var color = $(this).css('background-color'),
            sel = $('.selection');
            html = $(this).html();
        sel.css('background-color', color).html(html);
        
        // add the color to the "recent" list, if that isn't what was clicked on
        if ($(this).parents('.recent').length != 1) {
            if ($('.recent .color').length == 10) {
                $('.recent .color:last').remove();
            }
            $('.recent').prepend($(this).clone());
        }
    });
    
    $('.block').on('mousedown', function(e) {
        e.preventDefault();
        var color = $('.selection').css('background-color'),
            current = $(this).css('background-color');
            html = $('.selection').html();
        if (current != color) {
            active = color;
        }
        else {
            active = "white";
            html = defaultHtml;
        }
        drag = true;
        $(this).css('background-color', active).html(html);
    });
    
    $('body').on('mouseup', function(e) {
        e.preventDefault();
        drag = false, active = "";
    });
    
    $('.block').on('mouseenter', function(e) {
        e.preventDefault();
        if (drag) {
            $(this).css('background-color', active).html(html);
        }
    });
    
    $('.fillGrid').on('click', function(e) {
        e.preventDefault();
        var color = $('.selection').css('background-color');
        $('.block').css('background-color', color).html(html);
    });
    
    $('.clearGrid').on('click', function(e) {
        e.preventDefault();
        $('.block').css('background-color', "white").html(defaultHtml);
    });
    
    $('.submit').on('click', function(e) {
        e.preventDefault();
        $('.canvasForm').submit();
    });
});