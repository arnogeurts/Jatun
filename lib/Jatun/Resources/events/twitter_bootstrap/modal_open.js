$.jatun.addHandler('modal_open', ['id', 'title', 'content', 'width', 'height', 'buttons', function(id, title, content, width, height, buttons) {
    // if dialog is already open, modify it
    var elem = $('#' + id);
    if (elem.length > 0) {
        $('.modal-title', elem).html(title);
        $('.modal-body', elem).html(content);
        $('.modal-footer', elem).html(buttons);
    } else {
        // move all modals back in z-index
        $('.modal, .modal-backdrop').each(function(index, elem) {
            $(elem).css('z-index', parseInt($(elem).css('z-index')) - 20);
        });
        elem = $(
            '<div class="modal fade" id="' + id + '">' +
                '<div class="modal-dialog">' +
                    '<div class="modal-content">' +
                        '<div class="modal-header">' +
                            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                            '<h4 class="modal-title">' + title + '</h4>' +
                        '</div>' +
                        '<div class="modal-body">' + content + '</div>' +
                        '<div class="modal-footer">' + buttons + '</div>' +
                    '</div>' +
                '</div>' +
            '</div>'
        );

        $('body').append(elem);

        elem.modal('show');

        elem.bind("hidden.bs.modal", function() {
            $(this).remove();
            // put all modals back at the given z-index
            $('.modal, .modal-backdrop').each(function(index, elem) {
                $(elem).css('z-index', parseInt($(elem).css('z-index')) + 20);
            });
        });
    }

    if (width) {
        elem.find('.modal-dialog').css({
            width: width
        });
    }

    if (height) {
        elem.find('.modal-dialog').css({
            height: height
        });
    }

    this.parse(elem);
}]);