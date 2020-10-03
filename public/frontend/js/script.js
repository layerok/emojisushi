
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

                $("#checkout-loader").addClass('db');
                $("#checkout-loader").removeClass('dn');

                $("#place-order").addClass('dn');
                $("#place-order").removeClass('db');
                event.preventDefault();
                console.log(form);
                $(form).ajaxSubmit({
                    dataType: 'json',
                    success: function (res) {

                        let response = JSON.parse(res);
                        console.log(response);
                        let messages = {
                            37: 'Перепроверьте введенный номер телефона'
                        }
                        if(messages.hasOwnProperty(response.error)){

                            $.notify(messages[response.error], 'error');
                        }else{
                            $.notify(response.message, 'error');
                        }

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
                        $("#checkout-loader").addClass('dn');
                        $("#checkout-loader").removeClass('db');

                        $("#place-order").addClass('db');
                        $("#place-order").removeClass('dn');

                    },
                    error: function () {
                        $.notify('Ошибка', 'error')
                        $("#checkout-loader").addClass('dn');
                        $("#checkout-loader").removeClass('db');

                        $("#place-order").addClass('db');
                        $("#place-order").removeClass('dn');
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


    //  !!!!!!!!!!!!!!!!!!!!!!!!  custom select !!!!!!!!!!!!!!!!!!!!!!!!!!!
    let selects = document.querySelectorAll('.select');

    selects.forEach(function(elem){
        elem.addEventListener('click', function(e){
            let list = elem.querySelector('ul');
            let input = elem.querySelector('input');
            let checkmark = elem.querySelector('.check-mark');
            let currentOptionHolder = elem.querySelector('.current-option');

            checkmark.classList.toggle('rotate-45');
            checkmark.classList.toggle('rotate-225');
            checkmark.classList.toggle('mt1');

            list.classList.toggle('scale0');
            list.classList.toggle('o-0');

            elem.classList.toggle('bg-light-gray');
            elem.classList.toggle('bg-white');

            if(!e.target.classList.contains('fw5') && e.target.tagName === 'LI') {
                input.value = e.target.dataset.value;
                currentOptionHolder.innerHTML = e.target.innerHTML;
                console.log(input.dataset.submitOnChange);
                if(input.dataset.changeAction) {
                    elem.closest('form').setAttribute('action', elem.closest('form').getAttribute('action')+'/filter/'+input.value)

                }

                if(input.dataset.submitOnChange){

                    e.preventDefault();
                    console.log(elem.closest('form'));
                    elem.closest('form').submit();
                }

            }
        });
    });




});




