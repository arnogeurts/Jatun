$.jatun.addHandler('modal_close', ['id', function(id) {
    var element = $('#' + id);
    if (element.length > 0) {
        element.modal('hide');
    }
}]);