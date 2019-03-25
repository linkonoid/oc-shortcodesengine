+ function($) {

    alert('----------------');

    "use strict";

    var BackendPopup = function() {

        this.clickRecord = function(recordId) {
            var newPopup = $('<a />')
            newPopup.popup({
                handler: 'onModalEditForm',
                extraData: {
                    'recordId': recordId,
                }
            })
        }

        this.createRecord = function() {
            var newPopup = $('<a />')
            newPopup.popup({ handler: 'onModalCreateForm' })
        }

    }

    $.backendpopup = new BackendPopup;

}(window.jQuery);