// Define the variable global, to make it usable in custom integration
var hwtmemorylistCtrlInit;

jQuery(document).ready(function () {
    /*var hwtMemorylistForm = jQuery('.hwtmemorylist-list');*/
    var hwtmemorylistResultContainer = jQuery('.hwtmemorylist-list');

    /*
     * Define ajax handling
     */
    var hwtmemorylistAjaxService = {
        ajaxCall: function (data, target) {
            jQuery.ajax({
                url: hwtmemorylistMemorylistAjaxUrl,
                cache: false,
                //data: data,
                data: Object.assign(
                    data,
                    {'type': hwtmemorylistMemorylistAjaxPageType}
                ),
                success: function (result) {
                    /*if ( (jQuery(this).data('hwtmemorylist-action')==='add') || (jQuery(this).data('hwtmemorylist-action')==='remove') ) {
                        // handle data
                    } else {*/
                        //hwtMemorylistResultContainer.html(result);
                    //}

                    //Handle server response here
                    result = jQuery.parseJSON(result);
                    // ToDo: For debugging only
                    //console.log(this);
                    //console.log(result.status);
                    if (result.status == 'bypass') {
                        hwtmemorylistAjaxService.handleAjaxError();
                        return;
                    } else {
                        hwtmemorylistResultContainer.html(result.content);
                        jQuery('.hwtmemorylist-ctrl', hwtmemorylistResultContainer).on('click', hwtmemorylistCtrlInit);
                    }
                },
                error: this.handleAjaxError,
                beforeSend: function() {
                    target.addClass('hwtmemorylist-loading');
                },
                complete: function() {
                    target.removeClass('hwtmemorylist-loading');
                }
            });
        },
        handleAjaxError: function (jqXHR, textStatus, errorThrow) {
            //resultContainer.html('Ajax request - ' + textStatus + ': ' + errorThrow).fadeIn('fast');
            //alert('bypass');
        }
    };



    /*
     * Enable controls
     */
    var hwtmemorylistCtrlAllowedActions = ['add', 'remove', 'clear'];

    hwtmemorylistCtrlInit = function (event) {
        event.preventDefault();

        jQuery(this).data('hwtmemorylist-ajax', {
            'tx_hwtmemorylist_memorylist[action]': ( (hwtmemorylistCtrlAllowedActions.includes(jQuery(this).data('hwtmemorylist-action'))) ? jQuery(this).data('hwtmemorylist-action') : 'list'),
            'tx_hwtmemorylist_memorylist[model]': jQuery(this).data('hwtmemorylist-model'),
            'tx_hwtmemorylist_memorylist[id]': jQuery(this).data('hwtmemorylist-recordid')
        });
        //console.log(jQuery(this).data('hwtmemorylist-ajax'));

        hwtmemorylistAjaxService.ajaxCall(jQuery(this).data('hwtmemorylist-ajax'), jQuery(this));
    }

    // bind control handling to controls
    jQuery('.hwtmemorylist-ctrl').on('click', hwtmemorylistCtrlInit);
});