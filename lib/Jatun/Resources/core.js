/**
 * Do ajax request and trigger events for the response
 * 
 * @param data      Data about url and stuff, like in jQuery.ajax(...)
 */
$.jatunRequest = function(data) {
    $('body').addClass('wait');
   
    switch (typeof data.data) {
    	case "undefined":
    		data.data = 'jatun=1';
    		break;
    	case "object":
    		data.data.jatun = 1;
    		break;
    	case "string":
    	default:
    		data.data += '&jatun=1';
    		break;
    }
    
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
