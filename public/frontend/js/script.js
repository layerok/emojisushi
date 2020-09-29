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

    // $('.open-popup-link').magnificPopup({
    //     type:'inline',
    //     midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
    //     fixedContentPos: true,
    //     fixedBgPos: true,
    //     overflowY: 'scroll'
    // });

    // !!!!!!!!!!!!!!!! init modal !!!!!!!!!!!!!!!!!!!!//

    new layerok({
        trigger: '[data-layerok="#show-sign-modal"]'
    });

    new layerok({
        trigger: '[data-layerok="#show-sign-modal_2"]'
    });




});
