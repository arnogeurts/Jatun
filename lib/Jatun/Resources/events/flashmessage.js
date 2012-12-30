var elem = $('<div style="display: none;" class="alert alert-' + arguments.level + '">' + arguments.text + '</div>');
$('#' + arguments.id).prepend(elem);

var duration = parseInt(arguments.duration);

elem.slideDown(200, function() {
    setTimeout(function() {
        elem.slideUp(200, function() {
            elem.remove()
        });
    }, duration);
});