(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });


    // Date and time picker
    $('.date').datetimepicker({
        format: 'L'
    });
    $('.time').datetimepicker({
        format: 'LT'
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Team carousel
    $(".team-carousel, .related-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 30,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });

    $('#menu-header-menu').on('click', 'a', onChagenPage);

    function onChagenPage(e){
        e.preventDefault(); // Предотвращаем обычное поведение
        if(!$(e.currentTarget).attr('aria-current')){
            let link = $(this).attr('href'); // Получаем адрес ссылки
            disabledBody(true);
            $('body').append('<div class="loader-wrap animate__animated animate__fadeIn"><div class="loader"></div></div>');
            // Отправляем AJAX-запрос
            ajaxRequest(link);
        }
    };

    function ajaxRequest(link){
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: { action: 'load_content', link},
            success: function (response) {
                // Обновляем контент
                $('body').html(response);
            },
            complete: function () {
                // Скрываем лоадер после завершения запроса
                $('.loader-wrap').remove();
                $('body').off('click', onChagenPage);
                disabledBody(false);
            }
        });
    }

    function disabledBody(flag){
        $('body').css('overflow-y', flag ? 'hidden' : 'auto');
    }


})(jQuery);






