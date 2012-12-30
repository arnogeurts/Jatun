if ($('#' + arguments.id).length > 0) {
    if ($('#' + arguments.id).dialog('isOpen') == true) {
        $('#' + arguments.id).dialog('close');
    }
    
    $('#' + arguments.id).remove();
}