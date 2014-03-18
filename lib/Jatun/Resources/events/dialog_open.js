$.jatun.addHandler('dialog_open', ['id', 'title', 'content', 'width', 'height', 'buttons', function(id, title, content, width, height, buttons) {
    this.trigger('dialog.close', {'id': id});

    var d = $('<div id="' + id + '" title="' + title + '">' + content + '</div>');
    $('body').append(d);

    d.dialog({
        width: width,
        height: height,
        resizable: false,
        modal: true,
        close: function() {
            $(this).remove();
        },
        buttons: eval('(' + buttons + ')')
    });

    this.parse(d);
}]);
