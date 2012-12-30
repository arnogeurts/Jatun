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

$(document).triggerHandler('jatun.parse', ['#' + arguments.id]);