jQuery(function($) {
    var skills = $('#skills'),
        menu = skills.find('.menu'),
        decouvrezMoi = $('#decouvrez-moi'),
        menuItems = menu.find('.menu-item')
    ;

    decouvrezMoi.on('click', function() {
        menu.addClass('show');
    });

    menuItems.on('click', function() {
        skills.addClass('open');
    });
});
