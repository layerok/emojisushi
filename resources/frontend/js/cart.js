$(document).ready(function(){

    function getCart(){
        $.ajax({
            url: "/cart/get",
            dataType: 'json',
            success: function( cartData ) {
                console.log(cartData);
                $.get( "/frontend/js/templates/cart.html", function(data, textStatus, XMLHttpRequest){
                    var markup = data;

                    /* Compile markup string as a named template */
                    $.template( "cartTemplate", markup );
                    /* Render the named template */
                    $("[data-cart-popup-items]").html("");

                    if(cartData.products.length < 1){
                        $("[data-cart-popup-items]").addClass('dn');
                        $("[data-cart-popup-empty]").removeClass('dn');
                        $("[data-cart-popup-action]").addClass('dn');

                    }else{
                        $("[data-cart-popup-items]").removeClass('dn');
                        $("[data-cart-popup-empty]").addClass('dn');
                        $("[data-cart-popup-action]").removeClass('dn');
                    }

                    let products = $('[data-product-controls]');

                    products.each(function(){
                        let product_id = $(this).attr('data-product-controls');

                        if(typeof cartData.products[product_id] === 'undefined') {
                            $(this).find('[data-control-add]').removeClass('dn');
                            $(this).find('[data-control-update]').addClass('dn');
                        }
                        else {
                            // does exist
                            $(this).find('[data-control-add]').addClass('dn');
                            $(this).find('[data-control-quantity]').text(cartData.products[product_id]['quantity']);
                            $(this).find('[data-control-update]').removeClass('dn');
                        }
                    })

                    $.tmpl( "cartTemplate", Object.values(cartData.products) ).appendTo( "[data-cart-popup-items]" );
                    initBindigs();
                });

            }
        } );
    }

    getCart();

    function initBindigs(){
        $('[data-buy]').each(function() {
            $(this).validate({
                submitHandler: function (form, event) {
                    event.preventDefault();
                    $(form).ajaxSubmit({
                        dataType: 'json',
                        success: function (res) {

                            $.notify(res.message, res.status);
                            getCart();

                            // if (res.status != 'error') {
                            //     if (res.hasOwnProperty('liqpay')) {
                            //         let liqPayForm = $.parseHTML($.trim(res.html_str))[0];
                            //         $('body').append(liqPayForm);
                            //         liqPayForm.submit();
                            //     } else {
                            //         window.location.href = "/orders/thankyou";
                            //     }
                            // }

                        },
                        error: function () {
                            $.notify('Ошибка', 'error')
                        }
                    });
                },
            })
        });

        $('[data-cart-add]').each(function() {
            $(this).validate({
                submitHandler: function (form, event) {
                    event.preventDefault();
                    $(form).ajaxSubmit({
                        dataType: 'json',
                        data: {"_token": $('meta[name="csrf-token"]').attr('content')},
                        success: function (res) {

                            $.notify(res.message, res.status);
                            getCart();

                            // if (res.status != 'error') {
                            //     if (res.hasOwnProperty('liqpay')) {
                            //         let liqPayForm = $.parseHTML($.trim(res.html_str))[0];
                            //         $('body').append(liqPayForm);
                            //         liqPayForm.submit();
                            //     } else {
                            //         window.location.href = "/orders/thankyou";
                            //     }
                            // }

                        },
                        error: function () {

                            $.notify('Ошибка', 'error')
                        }
                    });
                },
            })
        });
    }








})

