$(document).ready(function () {
    //saveLogRoute is a constant for route value.
    const saveLogRoute = $('#save-log-route').val();
    //saveLogs is constant (query selector for save_logs input)
    const saveLogs = $('.save_logs');
    //equalTo is constant (query selector for equalto input)
    const equalTo = $('.equalto');
    //nameModaInput is constant (query selector for name input)
    const nameModaInput = $('#name');
    //modal is constant (query selector for name popup)
    const nameModal=$('#name_popup');
    //calculator is constant (query selector for calculator)
    let calculator = $('#calculator'),
        input = '',
        answer = $('.answer', calculator);
/*
* Function get triggered when input other than '=' , 'C'(clear), Save log is pressed .
* It also helps for calculation
*
* */
    $('input[type="button"]:not(.equalto):not(.clear):not(.save_logs)', calculator).click((e) => {
        if ($(e.target).val() === '+' || $(e.target).val() === '-' || $(e.target).val() === '*' || $(e.target).val() === '/') {
            answer.val(input);
            equalTo.attr('data-equalFlag', '');
            saveLogs.attr('data-resultFlag', '');
        }
        else if (saveLogs.attr('data-resultFlag') === 'true' || $('input[type="button"].equalto', calculator).attr('data-equalFlag') === 'true') {
           clearData();
        }
        input += $(e.target).val().toString();
        answer.val(input);
    });
/*
* Shorthand function used for clearing values (input,dataAttributes)
* Function get triggered whenever there is need to clear the data
* */
    function clearData() {
        input = '';
        saveLogs.attr('data-resultFlag', '');
        saveLogs.attr('data-input', '');
        saveLogs.attr('data-result', '');
        equalTo.attr('data-equalFlag', '');
        saveLogs.addClass('disabledButton');
        saveLogs.attr('disabled', 'disabled');
    }

    $('input[type="button"].clear', calculator).click((e) => {
        input = '';
        answer.val(input);
        clearData();
    });

    $('textarea.answer', calculator).keyup((e) => {
        input = $(e.target).val();
    });
/*
* Function get triggered whenever savelog(input,result,name)is called .
* The same function is used for storing the data into database (ajax function).
* It also prepend the latest data into table(dataTable).
* */
    function saveLog(input, result, name) {
        if (name) {
            $.ajax({
                url: saveLogRoute,
                data: {
                    input: input,
                    result: result,
                    name: name,
                },
                success(resp) {
                    $('table tbody').prepend('<tr><td>' + resp.log.created_at_read + '</td> <td  class="max-width">' + resp.log.log_name + '</td></td> <td  class="max-width">' + resp.log.input + '</td> <td  class="max-width">' + resp.log.result + '</td></tr>');
                    saveLogs.attr('data-result', '');
                    saveLogs.attr('data-input', '');
                    saveLogs.attr('data-resultFlag', true);
                    nameModal.modal('hide');
                    saveLogs.addClass('disabledButton');
                    saveLogs.attr('disabled','disabled');
                    nameModaInput.val('');
                }
            });
        }
    }
/*
* Function get triggered when user click Save log in modal (modal asking for reference name.
* From the same function savelog(input,result,name) is triggered where ,
* input = user input
* result = result of the input
* name = reference name
* */
    $('.save-logs-modal').click(function () {
        const result = saveLogs.attr('data-result');
        const input = saveLogs.attr('data-input');
        const name = nameModaInput.val();
        saveLog(input, result, name)
    });
/*
* Function get triggered when user press '='
* data-input & data-result are data attributes where result and input data after pressign equal is stored .
* */
    $('input[type="button"].equalto', calculator).click((e) => {
        try {
            const result = eval(input);
            saveLogs.attr('data-input', input);
            saveLogs.attr('data-result', result);
            if (result) {
                saveLogs.removeAttr('disabled');
                saveLogs.removeClass('disabledButton');
            }
            equalTo.attr('data-equalFlag', true);
            answer.val(result);
            input = result;

        } catch (err) {
            alert('Error! Please check values');
        }
    });
    /*
    * Function for saving logs when save log is clicked
    * It triggers the modal (show)
    * data-result & data input are data attributes.
    * */
    $('input[type="button"].save_logs', calculator).click((e) => {
            const result = saveLogs.attr('data-result');
            if (result) {
                nameModal.modal('show');
            } else {
                saveLogs.attr('data-result', '');
                saveLogs.attr('data-input', '');
                alert("please enter something to save");
            }
    });
    //For initializing datatable and ordering it.
    $('.table').DataTable({
        order: ['0', 'desc']
    });
});
