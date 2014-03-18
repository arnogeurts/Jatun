$.jatun.addHandler('html', ['id', 'content', function(id, content) {
    var element = $('#' + id);
    element.html(content);
    this.parse(element);
}]);