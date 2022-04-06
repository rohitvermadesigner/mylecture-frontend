const base_url = 'https://dev.gemsnext.com/api/v1';

$(function() {
    $("body").on("click", ".toggle-button", function(e) {
        e.stopPropagation();
        $("body").css("overflow", "hidden");
        $(".mobile-menu").addClass("active");
    });

    $(".toggle-close").click(function() {
        $("body").css("overflow", "visible");
        $(".mobile-menu").removeClass("active");
    });

    $(".mobile-menu .mobile-menu-container").click(function(e) {
        e.stopPropagation();
    });

});