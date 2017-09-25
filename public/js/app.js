$( document ).ajaxError(function( event, jqxhr, settings, thrownError ) {
    alert("Session expired. You'll be take to the login page");
    location.href = "/login";
});


$('body').on('click','.show-todolist-modal',(function(event) {
    event.preventDefault();
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#todo-list-title').text(title);
    $('#todo-list-save-btn').text(me.hasClass('edit')?'Update': 'Create New List');
    console.log(url);
    $.ajax({
       url:url,
        dataType: 'html',
        success: function(response){
           $('#todo-list-body').html(response);
        }
    });


    $('#todolist-modal').modal('show');
}));
function showMessage(message , element) {

    var alert = (element == undefined) ? '#add-new-alert' : element;

    $(alert).text(message).fadeTo(1000,500).slideUp(500, function () {
        $(this).hide();
    });
}

function updateTodoListCounter() {
    var total = $('.list-group-item').length;
    $('#todo-list-counter').text(total).next().text(total> 1 ? ' list items': ' list item');

    showNowRecordMessage(total);

}
function showNowRecordMessage(total) {
    if(total>0){
        $('#todo-list').closest('.panel').removeClass('hidden');
        $('#no-record-alert').addClass('hidden');
    }else {
        $('#todo-list').closest('.panel').addClass('hidden');
        $('#no-record-alert').removeClass('hidden');
    }
}

$('#todolist-modal').on('keypress', ":input:not(textarea)", function (event) {
        return event.keyCode !=13;
});


$('#todo-list-save-btn').click(function (event) {
    event.preventDefault();
    var form = $('#todo-list-body form'),
        url = form.attr('action'),
        method=$('input[name=_method]').val() == undefined ?  'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    $.ajax({
        url:url,
        method:method,
        data: form.serialize(),
        success:function (response) {
            if(method == 'POST') {
                $('#todo-list').prepend(response);
                showMessage("لیست با موفقیت ایجاد شد.");
                form.trigger('reset');
                $('#title').focus();

                updateTodoListCounter();
            }else{
                var id = $('input[name=id]').val()
                if(id){
                    $('#todo-list-'+id).replaceWith(response);
                }
                $('#todolist-modal').modal('hide');
                showMessage("بروزرسانی با موفقیت انجام شد!", '#update-alert');
            }
        },
        error:function (xhr) {
            var errors = xhr.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors, function (key, value) {
                   $('#'+key)
                       .closest('.form-group')
                       .addClass('has-error')
                       .append('<span class="help-block"><strong>'+value+'</strong></span>');
                });
            }
        }
    })
});


//task modal management

function countActiveTask() {
    var total = $('tr.task-item:not(:has(td.done))').length;
    $('#active-counter').text(total + (total > 1? ' tasks remain' : ' task remains'));
}
function countAllTasksOfSelectedTodoList() {
    var total = $('#task-table-body tr').length,
        selectedTodoListId = $('#selected-todo-list').val();
    $('#' + selectedTodoListId).find('span.badge').text(total + ' ' + (total>1 ? 'tasks': 'task'));
}

$('body').on('click', '.show-task-modal', (function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.data('title'),
        action = me.data('action'),
        parent = me.closest('.list-group-item');
    $('#task-modal-subtitle').text(title);
    $('#task-form').attr("action", action);
    $('#selected-todo-list').val(parent.attr('id'));

    $.ajax({
        url:url,
        dataType:'html',
        success:function (response) {
            $('#task-table-body').html(response);
            initIcheck();
            countActiveTask();
        }
    });


    $('#task-modal').modal('show');
}));

$('#task-form').submit(function (event) {
    event.preventDefault();
console.log('fuck');
    var form = $(this),
        action = form.attr('action');

    $.ajax({
        url: action,
        type: 'POST',
        data:form.serialize(),
        success: function (response) {
            $('#task-table-body').prepend(response);
            initIcheck();
            form.trigger('reset');
            countActiveTask();

            countAllTasksOfSelectedTodoList();
        },
        error:function (xhr) {
            console.log(xhr);
        }
    });
});
// delete task management

$('#task-table-body').on('click', '.remove-task-btn', function (event) {
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        url:url,
        type:'DELETE',
        data:{
            _token:$('input[name=_token]').val()
        },
        success:function (response) {
            $('#task-'+response.id).fadeOut(function () {
                $(this).remove();
                countActiveTask();
                countAllTasksOfSelectedTodoList();
            });
        }
    });
});


//delete modal management

$('body').on('click', '.show-confirm-modal', (function(event) {
    event.preventDefault();

    var  me = $(this),
         title = me.attr('data-title'),
         action = me.attr('href');

    $('#confirm-body form').attr('action', action);
    $('#confirm-body p').html("Are you sure you want to delete todo list: <strong>"+ title +"</strong>")
    $('#confirm-modal').modal('show');
}));


$('#confirm-remove-btn').click( function (event) {
    event.preventDefault();

    var form = $('#confirm-body form'),
        url = form.attr('action');

    $.ajax({
        url : url,
        method: 'DELETE',
        data: form.serialize(),
        success: function (data) {
            $('#confirm-modal').modal('hide');

            $('#todo-list-'+ data.id).fadeOut(function () {
                $(this).remove();

                updateTodoListCounter();
                showMessage("حذف لیست با موفقیت انجام شد!", '#update-alert');

            })
        }
    });

    
});
function markTheTask(checkbox) {
   var url = checkbox.data('url'),
        completed = checkbox.is(":checked");
    console.log(completed);
    $.ajax({
        url:url,
        type:'PUT',
        data: {
            completed:completed,
            _token:$("input[name=_token]").val()
        },
        success:function (response) {
            var nextTd = checkbox.closest('td').next();
            if(completed){
                nextTd.addClass('done');
            }
            else {
                nextTd.removeClass('done');
            }
            countActiveTask();
        }
    });
}

function initIcheck() {

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

    $('.check-item')
        .on('ifChecked', function (event) {
            var checkbox = $(this);
            markTheTask(checkbox);
        })
        .on('ifUnchecked', function (event) {
            var checkbox = $(this);
            markTheTask(checkbox);
        });
}

$('.filter-btn').click(function (event) {
    event.preventDefault();

    var id = this.id;
    $(this).addClass('active')
           .parent()
           .children()
           .not(event.target)
           .removeClass('active');
    if(id == "all-tasks"){
        $('tr.task-item').show();
    }
    else if(id == "active-tasks"){
        $('tr.task-item:has(td.done)').hide();
        $('tr.task-item:not(:has(td.done))').show();
    }
    else if(id == "completed-tasks"){
        $('tr.task-item:has(td.done)').show();
        $('tr.task-item:not(:has(td.done))').hide();
    }
});
