function logout() {
    var status = confirm('Do you want to logout?')
    if (status == true) {
        localStorage.removeItem('studentToken');
        toastr.success('Logout Successfully');
        setTimeout(function() {
            window.location.replace('../index.php');
        }, 1000);
    }
}

$(function() {
    // $('.test-questions li').each(function(index, elem) {
    //     $(elem).attr('id', 'step' + index);
    // });

    // $('.question-wrapper-inner').find('.ans-options').each(function(index1, elem1) {
    //     $(elem1).parents('.step').each(function(index0, elem0) {
    //         $(elem0).addClass('step' + index1);
    //     });
    //     $(elem1).children('ul').find('li input').each(function(index2, elem2) {
    //         $(elem2).attr('name', index1);
    //     });
    // });

    // var index = $(".step.active").index(".step"),
    //     stepsCount = $(".step").length,
    //     prevBtn = $(".prev"),
    //     nextBtn = $(".next"),
    //     clearBtn = $('#clear')

    // prevBtn.click(function() {
    //     nextBtn.prop("disabled", false);

    //     if (index > 0) {
    //         index--;
    //         $(".step").removeClass("active").eq(index).addClass("active");
    //         $(".test-questions li").removeClass("active").eq(index).addClass("active").find('a').removeClass('que-not-answered');
    //     };

    //     if (index === 0) {
    //         $(this).prop("disabled", true);
    //     }
    // });

    // nextBtn.click(function() {
    //     prevBtn.prop("disabled", false);

    //     if (index < stepsCount - 1) {
    //         index++;
    //         $(".step").removeClass("active").eq(index).addClass("active");
    //         $(".test-questions li").removeClass("active").eq(index).addClass("active").prevAll().find('a').addClass('que-not-answered');
    //     };

    //     if (index === stepsCount - 1) {
    //         $(this).prop("disabled", true);
    //     }
    // });

    // clearBtn.click(function() {
    //     $(".step.active").find('input').each(function() {
    //         $(this).prop('checked', false);
    //     });
    //     // $(".step.active").find('input').attr('checked',false);
    // });

});