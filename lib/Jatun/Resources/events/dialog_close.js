$.jatun.addHandler('dialog_close', ['id', function(id) {
    var dialog = $('#' + id);
    if (dialog.length > 0) {
        if (dialog.dialog('isOpen') == true) {
            dialog.dialog('close');
        }
    }
    dialog.remove();
}]);