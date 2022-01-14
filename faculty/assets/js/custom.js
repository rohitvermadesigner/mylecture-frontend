$(function() {

    $('.has-sub > a').click(function(e) {
        e.preventDefault();
        $(this).parent('.has-sub').toggleClass('active');
        $(this).find('svg').toggleClass('fa-plus fa-minus');
    });

    $('.browse-categories-btn').click(function(e) {
        e.stopPropagation();
        $('.category-menu').toggle();
    });

    if ($(window).width() > 767) {
        $('body').click(function() {
            $('.category-menu').hide();
        });

        $('nav li').mouseover(function() {
            $(this).find('.submenu').show();
            // $(this).find('svg').css('WebkitTransform', 'rotate(180deg)');
            // $(this).find('svg').css('-moz-Transform', 'rotate(180deg)');
            // $(this).find('.r-sign svg').css('WebkitTransform', 'rotate(0deg)');
            // $(this).find('.r-sign svg').css('-moz-Transform', 'rotate(0deg)');
        });
        $('nav li').mouseout(function() {
            $(this).find('.submenu').hide();
            // $(this).find('svg').css('WebkitTransform', 'rotate(0deg)');
            // $(this).find('svg').css('-moz-Transform', 'rotate(0deg)');
            // $(this).find('.r-sign svg').css('WebkitTransform', 'rotate(0deg)');
            // $(this).find('.r-sign svg').css('-moz-Transform', 'rotate(0deg)');
        });

    } else {
        $('.cat-item a').click(function() {
            $(this).next('.sub-menu').toggleClass('active');
            // $(this).next('.sub-menu').prev('a').find('svg').css('transform', 'rotate(90deg)');
            // $(this).next('.sub-menu.active').prev('a').find('svg').css('transform', 'rotate(-90deg)');
        });

        $('.nav-toggle-btn').click(function() {
            $('nav').show();
        });
        $('.nav-toggle-close-btn').click(function() {
            $('nav').hide();
        });

        $('nav li').click(function() {
            $(this).find('.submenu').toggleClass('active');
        });
    }

    $('.register-btn').click(function() {
        $('.nav-pills a[href="#register"]').tab('show');
        $('#loginModal').modal('show');
    });
    $('.login-btn').click(function() {
        $('.nav-pills a[href="#login"]').tab('show');
        $('#loginModal').modal('show');
    });

    $('#btnReset').click(function() {
        $('.login-form').hide();
        $('.reset-form').show();
    });

    $('.products-slider.owl-carousel').owlCarousel({
        nav: true,
        dots: false,
        autoplay: true,
        loop: true,
        nav: true,
        // navText: ['<img src="' + url + 'public/images/white-arrow-prev.png" alt="">','<img src="' + url + 'public/images/white-arrow-next.png" alt="">'],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 3
            }
        }

    });
});