/**
 * Do ajax request and trigger events for the response
 * 
 * @param data      Data about url and stuff, like in jQuery.ajax(...)
 */
$.jatunRequest = function(data) {
    $('body').addClass('wait');
    
    data.dataType = 'json';
    data.success = function(response) {
        $.each(response, function(index, event) {
            $(document).triggerHandler(event.event, event.arguments);
        });
    };
    
    $.ajax(data).always(function() {
        $('body').removeClass('wait');
    });
}

/**
 * Add jatun function to all element so
 * An element click results into a ajax-jatun request
 */ 
$.fn.jatun = function() {
    if ($(this).is('form')) {
        $(this).bind('submit', function(e) { 
            e.preventDefault();
           
            if ($(this).data('confirm') == undefined || confirm($(this).data('confirm'))) { 
                $.jatunRequest({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize()
                });
            }
        });
    } else {
        $(this).bind('click', function(e) {
            e.preventDefault();

            var data = {};

            if ($(this).is('a')) {
                data = { 
                    url: $(this).attr('href') 
                };
            } else {
                data = { 
                    url: $(this).data('path') 
                };
            }

            if ($(this).data('confirm') == undefined || confirm($(this).data('confirm'))) {
                $.jatunRequest(data);
            }
        });
    }
}

/**
 * trigger parse handler on load
 */
$(document).ready(function() {
    $(document).triggerHandler('jatun.parse', ['body']);
});

/**
 * Convert all jatun links into ajax calls
 */
$(document).bind('jatun.parse', function(e, element) {
    $(element).find('.jatun').each(function(index, element) {
	$(element).jatun();
    });
});

/**
 * Set html of given element by id
 * 
 * Arguments:
 * id -- the id of the dom element
 * content -- the content to be set in the element
 */
$(document).bind('jatun.html', function(event, arguments) {
    $('#' + arguments.id).html(arguments.content);
    $(document).triggerHandler('jatun.parse', [ '#' + arguments.id ]);
});

/**
 * Open dialog
 * 
 * Arguments:
 * id -- the id of the dom element to be generated
 * title -- the title of the dialog
 * content -- the content of the dialog
 * width -- the width of the dialog
 * height -- the height of the dialog
 */
$(document).bind('jatun.dialog.open', function(event, arguments) {
    // remove all elements with given id
    $(document).triggerHandler('jatun.dialog.close', [arguments]);
    
    var d = $('<div id="' + arguments.id + '" title="' + arguments.title + '">' + arguments.content + '</div>');
    
    $('body').append(d);
    
    d.dialog({
        width: arguments.width,
        height: arguments.height,
        resizable: false,
        modal: true,
        close: function(event, ui) {
            $(this).remove();
        },
        buttons: eval('(' + arguments.buttons + ')')
    });
    
    $(document).triggerHandler('jatun.parse', [ '#'+arguments.id ]);
});

/**
 * Close dialog
 * 
 * Arguments:
 * id -- the dom element id of the dialog to be closed
 */
$(document).bind('jatun.dialog.close', function(event, arguments) {
    if ($('#' + arguments.id).length > 0) {
        if ($('#' + arguments.id).dialog('isOpen') == true) {
            $('#' + arguments.id).dialog('close');
        }
        
        $('#' + arguments.id).remove();
    }
});

/**
 * Set dialog title
 * 
 * Arguments:
 * id -- the id of the dom element of the dialog
 * title -- the title of the dialog to be set
 */
$(document).bind('jatun.dialog.title', function(event, arguments) {
    if ($('#' + arguments.id).dialog('isOpen') == true) {
        $('#' + arguments.id).dialog('option', 'title', arguments.title);
    }
});

/**
 * Add a flashmessage
 * 
 * Arguments:
 * id -- the id of the dom element where to prepend the message to
 * level -- the level of flashmessage (error, notice, success)
 * text -- the text of the flashmessage
 * duration -- the time the message is visible
 */
$(document).bind('jatun.flashmessage', function(event, arguments) {
    var elem = $('<div style="display: none;" class="flash flash-' + arguments.level + '">' + arguments.text + '</div>');
    $('#' + arguments.id).prepend(elem);

    var duration = parseInt(arguments.duration);
    
    elem.slideDown(200, function() {
        setTimeout(function() {
            elem.slideUp(200, function() {
                elem.remove();
            });
        }, duration);
    });
});
