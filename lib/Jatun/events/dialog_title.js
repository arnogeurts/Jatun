if ($('#' + arguments.id).dialog('isOpen') == true) {
    $('#' + arguments.id).dialog('option', 'title', arguments.title);
}