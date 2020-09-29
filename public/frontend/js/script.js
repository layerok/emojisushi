window.addEventListener("load", function(event) {
    $.notify.defaults({
       position: 'bottom right',
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var mySwiper = new Swiper('.swiper-container', {
        // Optional parameters
        loop: true,
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
    })



    // !!!!!!!!!!!!!!!! init modal !!!!!!!!!!!!!!!!!!!!//

    new layerok({
        trigger: '[data-layerok="#show-sign-modal"]'
    });

    new layerok({
        trigger: '[data-layerok="#show-sign-modal_2"]'
    });


    // Form validation

    $.jMaskGlobals = {
        translation: {
            'n': {pattern: /\d/}
        }
    };

    $('input[data-type="phone"]').each(function (key, value) {
        $(value).mask('+38(0nn) nnn-nn-nn');
    });

    jQuery.validator.addMethod("phone", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element ) || /^\+?3?8?\(?[0-9]{3}\)?\s?[0-9]{3}\-?[0-9]{2}\-?[0-9]{2}$/.test( value );
    }, 'Введите действительный номер телефона');



    $('.checkout-form').each(function(){
        $(this).validate({
            submitHandler: function (form, event) {
                event.preventDefault();
                console.log(form);
                $(form).ajaxSubmit({
                    dataType: 'json',
                    success: function (res) {
                        console.log(res);
                        //$.notify(res.message, res.status);
                        //getCart();

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
            rules: {
                phone: {
                    required: true,
                    phone: true,
                },
            },
            messages: {
                phone: {
                    required: "Пожалуйста, заполните это поле",
                }
            }
        });
    })




});
