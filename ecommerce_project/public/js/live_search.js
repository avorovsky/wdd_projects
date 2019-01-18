// show search suggestions while typing
$(document).ready(function () {

    // handle key input
    $('#search_field').keyup(function () {
        // get value of field
        var string = $('#search_field').val();
        if (string == '') {
            // clear suggestions
            $('#search_suggest').html('');
        } else {
            var token = $('input[name=token]').val();
            $.ajax({
                type: 'POST',
                url: '/search/suggest',
                data: {search_field: string, token: token},
                success: function (result) {
                    // show suggestions
                    $('#search_suggest').html(result);
                    $('#search_suggest').show();
                }
            });
        }
    });

});

// search suggestion to search string
// then show results
function fillField(value) {
    // place selected to value of field
    $('#search_field').val(value);
    // .. and hide suggestion
    $('#search_suggest').hide();
    var string = $('#search_field').val();
    var token = $('input[name=token]').val();
    $.ajax({
        type: 'POST',
        url: '/search/result',
        data: {search_field: string, token: token},
        success: function (result) {
            // go to results
            window.location = ('/search/result/?search='+string);
        }
    });
}
