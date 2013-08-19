var drag = false,
    active = "",
    
    compileFormString = function() {
        var data = [];
        console.log($('.canvas .block').length);
        // loop through the grid of blocks appending their color values to the form string
        $('.canvas .block').each(function(index, element) {
            var bgColor = $(element).css('background-color'),
                rgb = bgColor.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            data.push(rgb[1] + "-" + rgb[2] + "-" + rgb[3]);
        });
        $('#formString').val(data.join("|"));
    };

$(function() {
    $('.colors, .recent').on('mousedown', '.color', function(e) {
        e.preventDefault();
        var color = $(this).css('background-color'),
            sel = $('.selection');
        sel.css('background-color', color);
        
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
            console.log(current);
        if (current != color) {
            active = color;
        }
        else {
            active = "white";
        }
        drag = true;
        $(this).css('background-color', active);
    });
    
    $('body').on('mouseup', function(e) {
        e.preventDefault();
        drag = false, active = "";
    });
    
    $('.block').on('mouseenter', function(e) {
        e.preventDefault();
        if (drag) {
            $(this).css('background-color', active);
        }
    });
    
    $('.fillGrid').on('click', function(e) {
        e.preventDefault();
        var color = $('.selection').css('background-color');
        $('.block').css('background-color', color);
    });
    
    $('.clearGrid').on('click', function(e) {
        e.preventDefault();
        $('.block').css('background-color', "white");
    });
    
    $('.submit').on('click', function(e) {
        e.preventDefault();
        compileFormString();
        $('.canvasForm').submit();
    });
});