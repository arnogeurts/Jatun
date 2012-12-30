// if dialog is already open, modify it
var elem = $('#' + arguments.id);
if (elem.length > 0) {
	$('.modal-title', elem).html(arguments.title);
	$('.modal-body', elem).html(arguments.content);
	$('.modal-footer', elem).html(arguments.buttons);
} else {
    var d = 
     $('<div id="' + arguments.id + '" class="modal hide fade" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="modal-label" aria-hidden="true">' +
    	'<div class="modal-header">' +
	        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>' +
	        '<h3 id="modal-label" class="modal-title">' + arguments.title + '</h3>' +
        '</div>' +
       '<div class="modal-body">' +
            arguments.content +
	    '</div>' +
	    '<div class="modal-footer">' +
	    	arguments.buttons +
	    '</div>' +
    '</div>');

    $('body').append(d);
    
    d.modal('show');
    
    $('#' + arguments.id).bind("hidden", function() {
    	$(this).remove();
    });
}

$(document).triggerHandler('jatun.parse', ['#' + arguments.id]);