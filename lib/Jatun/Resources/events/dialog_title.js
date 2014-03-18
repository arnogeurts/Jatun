$.jatun.addHandler('dialog_title', ['id', 'title', function(id, title) {
    var element = $('#' + id);
    if (element.dialog('isOpen') == true) {
        element.dialog('option', 'title', title);
    }
}]);