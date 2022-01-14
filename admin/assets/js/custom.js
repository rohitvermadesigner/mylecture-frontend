$(function() {

    $('.richText').richText();

    $('.nav-tabs a[href="#"]').tab('show');

    $('.stepNext').click(function(e) {
        e.preventDefault();
        var next_tab = $('.nav-tabs > .active').next('li').find('a');
        if (next_tab.length > 0) {
            next_tab.trigger('click');
        }
    });

    $('.stepPrev').click(function(e) {
        e.preventDefault();
        var next_tab = $('.nav-tabs > .active').prev('li').find('a');
        if (next_tab.length > 0) {
            next_tab.trigger('click');
        }
    });

    $('body').on('change', '#addCategory', function() {
        if ($(this).find('option:selected').val() === 'addCategory') {
            $('#addCategoryModal').modal('show');
        }
    });
    $('body').on('change', '#addInstruction', function() {
        if ($(this).find('option:selected').val() === 'addInstruction') {
            $('#addInstructionModal').modal('show');
        }
    });

    $('body').on('click', '.subjecticn', function() {
        $(this).toggleClass('treeminus');

        $(this).parents('td').find('.topiclist').toggle();
    });

    $('body').on('click', '.inner-subjection', function() {
        $(this).toggleClass('treeminus');

        $(this).parent('span').parent('li').find('ul').toggle();
    });


});