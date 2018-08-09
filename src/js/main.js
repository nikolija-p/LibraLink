
var request1 = 1, request2 = 1, request3 = 1, request4 = 1;

/* View data
 *
 *
 * */
$(document).ready(function () {
    listTables();
});

function listTables() {
    if (request1 === 1){
        request1 = 0;
        $.ajax({
            type: 'POST',
            url: 'server/root.php?p=listTables',
            success: function (output) {
                JSON.parse(output).forEach(function (item) {
                    for( var key in item ) {
                        $('#collapseComponents').append('<li><a>' + item[key] + '</a></li>');
                    }
                });
                request1 = 1;
            },
            error: function() {
                request1 = 1;
            }
        });
    }
}

$( document ).on('click', '#collapseComponents > li > a', function(e) {
    e.preventDefault();
    select_table ($(this).text());
});



$( document ).on('click', '#tbody tr', function() {
    $(this).addClass('selected').siblings().removeClass('selected');
});

$('.insert-open-modal').click(function () {
    if ($('.action-buttons').attr('id').length === 0) {
        $('.modal-body').html('Prvo selektuj tabelu.');
    } else {
        $('.modal-body').empty().append('<form id="myForm"></form>');

        $('#thead > tr > th').each(function () {
            if ($(this).text() !== 'id') {
                $('#myForm').append('<input type="text" name="' + $(this).text() + '" placeholder="' + $(this).text() + '">');
            }
        });

        if ($('.insert').length === 0) {
            $('.modal-footer').append('<button type="button" class="btn btn-success insert" data-dismiss="modal">Potvrdi</button>');
        }
    }
});

$( document ).on('click', '.insert', function() {
    request3 = 0;
    var tableName = $('.action-buttons').attr('id');
    console.log($('#myForm').serialize());
    $.ajax({
        type: 'POST',
        data: $('#myForm').serialize(),
        url: 'server/root.php?p=insert/' + tableName,
        success: function (output) {
            if (output.trim() === 'true'){
                $('.result').html('<p class="alert-success">Success!</p>');
            } else {
                $('.result').html('<p class="alert-danger">Error!</p>');
            }
            console.log(output);
            select_table (tableName);
            request3 = 1;
        },
        error: function() {
            request3 = 1;
        }
    });
});



function select_table (name) {

    if (request2 === 1){
        request2 = 0;
        $('.action-buttons').attr('id', name);
        $.ajax({
            type: 'POST',
            data: 'tableName=' + name,
            url: 'server/root.php?p=table',
            success: function (output) {
                var obj = JSON.parse(output);
                var key_names = [];

                obj.forEach(function (item) {
                    for( var key in item ) {
                        if (!(key_names.includes(key))){
                            key_names.push(key);
                        }
                        //console.log(item[key] + ' ' + key);
                    }
                });
                $('#thead > tr > th').remove();
                $('#tbody > tr').remove();

                key_names.forEach(function( item ) {
                    $('#thead > tr').append('<th>' + item + '</th>');
                });

                var cnt = 0;
                $('#tbody').append('<tr></tr>');
                obj.forEach(function (item) {
                    for( var key in item ) {
                        if (cnt === key_names.length) {
                            $('#tbody').append('<tr></tr>');
                            cnt = 0;
                        }
                        cnt++;
                        $('#tbody > tr:last-child').append('<td>' + item[key] + '</td>');
                    }
                });
                request2 = 1;
            },
            error: function() {
                request2 = 1;
            }

        });
    }
}


/*  Show menu on mobile <992  */

$('.open-menu').on('click', function () {
    tog();
});
$('.open-menu').focusin(function() {
    tog();
});

function tog() {
    if ($(window).width() < 992) {
        $('#navbarResponsive').toggle();
    }
}
