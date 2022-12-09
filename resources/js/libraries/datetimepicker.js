$(function () {
    $('.form-control-date').datetimepicker({
        icons:{
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            clear: 'fa fa-trash',
        },
        allowInputToggle: true,
        format: 'YYYY-MM-DD',
        showClear: true
        //locale: 'ru'
        //maxDate: 'now'
        //defaultDate: $('.form-control-date').val()
    });
});