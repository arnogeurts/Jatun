/**
 * Do ajax request and trigger events for the response
 * 
 * @param data      Data about url and stuff, like in jQuery.ajax(...)
 */
$.request = function(data) 
{
    $('body').addClass('wait');
    
    data.dataType = 'json';
    data.success = function(response) 
    {
        $.each(response, function(index, event) {
            $(document).triggerHandler(event.event, event.arguments);
        });
    };
    
    $.ajax(data).always(function() {
        $('body').removeClass('wait');
    });
}

/**
 * trigger parse handler on load
 */
$(document).ready(function() 
{
    $(document).triggerHandler('jatun.parse', ['body']);
});

/**
 * Convert all jatun links into ajax calls
 */
$(document).bind('jatun.parse', function(e, element) 
{
    $(element).find('.jatun-link').bind('click', function(e) {
        e.preventDefault();
        
        if ($(this).attr('href') != undefined) {
            var path = $(this).attr('href');
        } else {
            var path = $(this).data('path');
        }
        $.request({ url: path });
    })
});

/**
 * set html of given object
 */
$(document).bind('jatun.html', function(event, arguments) 
{
    $(arguments.id).html(arguments.content);
    $(document).triggerHandler('parse', [arguments.id]);
});

/**
 * open dialog
 */
$(document).bind('jatun.dialog.open', function(event, arguments)
{
    // remove all elements with given id
    $(document).triggerHandler('close_dialog', [arguments]);
    
    var d = $('<div id="' + arguments.id + '" title="' + arguments.title + '">' + arguments.content + '</div>');
    
    $('body').append(d);
    
    d.dialog({
        width: arguments.width,
        height: arguments.height,
        resizable: false,
        modal: true,
        close: function(event, ui) {
            $(this).remove();
        }
    });
    
    $(document).triggerHandler('parse', [ '#'+arguments.id ]);
});

/**
 * close dialog
 */
$(document).bind('jatun.dialog.close', function(event, arguments)
{
    if ($('#' + arguments.id).dialog('isOpen') == true) {
        $('#' + arguments.id).dialog('close');
    }
    
    if ($('#' + arguments.id).length > 0) {
        $('#' + arguments.id).remove();
    }
});

/**
 * set dialog title
 */
$(document).bind('jatun.dialog.title', function(event, arguments) 
{
    if ($('#' + arguments.id).dialog('isOpen') == true) {
        $('#' + arguments.id).dialog('option', 'title', arguments.title);
    }
})