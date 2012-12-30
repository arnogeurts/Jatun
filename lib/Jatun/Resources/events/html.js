$('#' + arguments.id).html(arguments.content);
$(document).triggerHandler('jatun.parse', ['#' + arguments.id]);