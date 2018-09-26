var timeout = null;
$('#search').on('blur', function() {
    $('.close').trigger('click');
});
$('#search').on('keyup', function() {
    if(timeout) {
        clearInterval(timeout);
    }
    var value = $(this).val();

    timeout = setTimeout(function() {
        if(value.length > 0) {
            window.location.href = route + "?search=" + value;
        }
    }, 500);
})