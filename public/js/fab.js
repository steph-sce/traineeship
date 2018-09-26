document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems);
});

var footerY = $('footer').offset();
footerY = footerY.top;

var fab = $('.fixed-action-btn');

$(window).scroll(function() {
    if($(window).scrollTop()+ $(window).height() >= footerY) {
        if(fab.hasClass('fab-animation-down') === true) {
            fab.removeClass('fab-animation-down');
        }
        fab.addClass('fab-animation-up');
    } else {
        if(fab.hasClass('fab-animation-up') === true) {
            fab.removeClass('fab-animation-up');
        }
        fab.addClass('fab-animation-down');
    }
});

$(document).scroll();

fab.removeClass('hide');