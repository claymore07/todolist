$('.show-todolist-modal').click(function(event) {
    event.preventDefault();

    $('#todolist-modal').modal('show');
});

$('.show-task-modal').click(function(event) {
    event.preventDefault();

    $('#task-modal').modal('show');
});

$(function() {
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-green',
        increaseArea: '20%'
    });

    $('#check-all').on('ifChecked', function(e) {
        $('.check-item').iCheck('check');
    });

    $('#check-all').on('ifUnchecked', function(e) {
        $('.check-item').iCheck('uncheck');
    });
});