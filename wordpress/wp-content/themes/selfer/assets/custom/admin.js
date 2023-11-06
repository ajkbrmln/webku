(function ($) {
    "use strict"; // use strict to start
    var ajaxurl = selfer.ajaxurl;

    // Item Verification
    function item_verification(form) {
        var form = $(form);
        form.submit(function (event) {
            event.preventDefault();
            var $self = $(this);
            var data = form.serialize(); 
            $.ajax({
                type: "POST",
                dataType: "html",
                url: selfer.ajaxurl,
                data: data,
                beforeSend: function() {
                    $self.children('.selfer-loader').css({'display': 'inline-block'});
                    $self.children('.selfer-loader').children().addClass('spin');
                },
                success: function (data) {          
                    $self.children('.selfer-loader').css({'display': 'none'});
                    $self.children('.selfer-loader').children().removeClass('spin'); 
                    if(data == 'true') {
                        $('.selfer-important-notice.registration-form-container .about-description-success').slideDown('slow');
                        $('.selfer-important-notice.registration-form-container .selfer-registration-form').slideUp();
                        $('.selfer-important-notice.registration-form-container .about-description-success-before').slideUp();
                    } else { 
                        $('.selfer-important-notice.registration-form-container .about-description-faild-msg').slideDown('slow');
                        setTimeout(function() {
                            $('.selfer-important-notice.registration-form-container .about-description-faild-msg').slideUp('slow');
                        }, 9500);
                    }
                },
                error: function () { 
                    console.log("Something miss. Please recheck");
                }
            });
        });  
    }
     
    if ($('#selfer_product_registration').length) {
        item_verification('#selfer_product_registration');
    }

})(jQuery);