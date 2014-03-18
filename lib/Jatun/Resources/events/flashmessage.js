$.jatun.addHandler('flashmessage', ['id', 'level', 'text', 'duration', function(id, level, text, duration) {
    var elem = $('<div style="display: none;" class="alert alert-' + level + '">' + text + '</div>');
    $('#' + id).prepend(elem);

    elem.slideDown(200, function() {
        setTimeout(function() {
            elem.slideUp(200, function() {
                elem.remove()
            });
        }, parseInt(duration));
    });
}]);