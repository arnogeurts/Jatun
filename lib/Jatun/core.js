/**
 * Do ajax request and trigger events for the response
 * 
 * @param data      Data about url and stuff, like in jQuery.ajax(...)
 */
(function( $ ){
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
	
	var jatunMethods = {
	    init : function(context) { 
	    	methods = this;
	    	var handler =  function(e) { 
                e.preventDefault();
                if (methods._confirm(context)) {
                    $.jatunRequest(methods._getData(context));
                }
            };
	    	
	    	if (context.is('form')) {
	            context.bind('submit', handler);
	        } else {
	            context.bind('click', handler);
	        }
	    },
	    
	    _getData : function(context) {
	    	if (context.data('target')) {
	    		return this._getData($('#' + context.data('target')));
	    	} else if (context.is('form')) {
	    		return {
	    			'url':  context.attr('action'),
	    			'type': context.attr('method'),
	    			'data': context.serialize()
	    		}
	    	} else if (context.is('a')) {
	    		return { 'url': context.attr('href') }
	    	} else {
	    		return { 'url': context.data('path') } 
	    	}
	    },
	    
	    _confirm: function(context) { 
	    	if (context.data('confirm') != undefined) {
	    		var e = $.Event('jatun.confirm'); 
	    		$(document).triggerHandler(e, context.data('confirm'));
	    		
	    		return e.result;
	    	}
			return true;
	    }
	};

	/**
	 * Add jatun function to all element so
	 * An element click results into a ajax-jatun request
	 */ 
	$.fn.jatun = function() {
		return jatunMethods.init(this);
	};
})( jQuery );

/**
 * trigger parse handler on load
 */
$(document).ready(function() {
    $(document).triggerHandler('jatun.parse', ['body']);
});

$(document).bind('jatun.confirm', function(e, str) {
	return confirm(str);
});

/**
 * Convert all jatun links into ajax calls
 */
$(document).bind('jatun.parse', function(e, element) {
    $(element).find('.jatun').each(function(index, element) {
	$(element).jatun();
    });
});
