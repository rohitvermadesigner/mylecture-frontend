var count = 7200;
var counter = setInterval(timer, 1000); //1000 will  run it every 1 second

function timer() {
    count = count - 1;
    if (count == -1) {
        clearInterval(counter);
        return;
    }

    var seconds = count % 60;
    var minutes = Math.floor(count / 60);
    var hours = Math.floor(minutes / 60);
    minutes %= 60;
    hours %= 60;

    // document.getElementById("timer").innerHTML = hours + ":" + minutes + ":" + seconds; // watch for spelling
}

$(function() {

    // $('#btnRegister').click(function() {
    //     alert('OTP has been sent to your registered email id');
    // });

    $('#submit-exam1').click(function() {
        $('.test-process').hide();
        $('.test-process-2').show();
    });
    $('#submit-exam2').click(function() {
        $('.test-process').hide();
        $('.test-process-3').show();
    });
    $('#submit-exam3').click(function() {
        $('.test-process').hide();
        $('.test-process-4').show();
    });

    // let interval = setInterval(() => {
    //     let timeStarted = $('.time-started').text();
    //     timeStarted++;
    //     $('.time-started').text(timeStarted);
    // }, 300);

    $('.test-questions li').each(function(index, elem) {
        $(elem).attr('id', 'step' + index);
    });

    $('.ans-options').each(function(index1, elem1) {
        // $(elem1).addClass('text' + index1);
        $(elem1).parents('.step').each(function(index0, elem0) {
            $(elem0).addClass('step' + index1);
        });
        $(elem1).children('ul').find('li input').each(function(index2, elem2) {
            // $(elem2).attr('name', index2);
            $(elem2).attr('name', index1);
        });
    });

    var index = $(".step.active").index(".step"),
        stepsCount = $(".step").length,
        prevBtn = $(".prev"),
        nextBtn = $(".next");
    clearBtn = $('#clear')

    prevBtn.click(function() {
        nextBtn.prop("disabled", false);

        if (index > 0) {
            index--;
            $(".step").removeClass("active").eq(index).addClass("active");
            // $(".test-questions li").removeClass("active").eq(index).addClass("active");
            $(".test-questions li").removeClass("active").eq(index).addClass("active").find('a').removeClass('que-not-answered');
        };

        if (index === 0) {
            $(this).prop("disabled", true);
        }
    });

    nextBtn.click(function() {
        prevBtn.prop("disabled", false);

        if (index < stepsCount - 1) {
            index++;
            $(".step").removeClass("active").eq(index).addClass("active");
            // ans-options
            // if(($(".step").eq(index).find('li input')).is(':checked')){
            //     alert('test');
            $(".test-questions li").removeClass("active").eq(index).addClass("active").prevAll().find('a').addClass('que-not-answered');
            // }
        };

        if (index === stepsCount - 1) {
            $(this).prop("disabled", true);
        }
    });

    clearBtn.click(function() {
        alert('test');
        $(".step.active").find('input').each(function() {
            $(this).prop('checked', false);
        });
        // $(".step.active").find('input').attr('checked',false);
    });

});

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