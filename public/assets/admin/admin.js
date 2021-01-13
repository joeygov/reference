//Employee table
$(document).ready(function() {

   var employee_table = $('#employee-table').DataTable({
        "searching": false,
        "responsive":true,
        "buttons": [{
            "extend":"csv",
            "text": "Download CSV",
            "title": "Employee List",
            "exportOptions": {
                "columns": ':not(:last-child)',
                "modifier":{
                    "page":"all"
                }
              }
        }],
        "dom": '<"top"lf>rt<"bottom"ipB><"clear">'
    });

    $('#employee-table').on('page.dt', function () {
        var info = employee_table.page.info();

    });
    $(document).on('click', '.search-employee', function () {
        let employee_id = $('#employee_id').val();
        let first_name = $('#first_name').val();
        let last_name = $('#last_name').val();
        let account_id = $('#account_id').val();
        let user_status = $('#user_status').val();
        $.get('/admin/employee/search', {
            employee_id: employee_id,
            first_name: first_name,
            last_name: last_name,
            account_id: account_id,
            user_status: user_status
        },function (data) {
            employee_table.clear().draw();

            data.forEach(element => {
                employee_id = element.emp_id;
                first_name = element.first_name;
                last_name = element.last_name;
                employee_type = element.emp_statuses;
                account = element.account['name'];
                user_status = element.user_statuses;
                user_role = element.user_roles;
                employee_table.row.add([
                    employee_id
                    ,first_name
                    ,last_name
                    ,employee_type
                    ,account
                    ,user_status
                    ,user_role
                    ,'<a href="/admin/employee/edit/' + employee_id +'"><i class="fa fa-pencil-square-o"></i></a>' + ' ' +
                     '<a href="/admin/employee/delete/'+ employee_id +'"><i class="fa fa-trash-o"></i></a>'
                ]).draw(true);

                employee_table
                .search( '' )
                .columns().search( '' )
                .draw();
            });
        }).fail(function (err) {
            console.log(err)
        });;
    });

    $('.buttons-csv').addClass('btn btn-rounded btn-fw');

    $(document).on('click','.search-reset', function(){
        $('#employee_id').val('');
        $('#first_name').val('');
        $('#last_name').val('');
        $('#account_id').val('');
        $('#user_status').val('');
        $(".search-employee").click();
    });

    $(document).on('click', '#emp_add', function(){
        localStorage.clear();
    });
});

//Account
$(document).ready(function() {
    var account_table = $('#account-table').DataTable({
        "searching": false,
        "responsive":true,
        "dom": '<"top"lf>rt<"bottom"ipB><"clear">'
    });

    $(document).on('click', '.search-account', function () {
        let account_id = $('#account_id').val();
        let account_name = $('#account_name').val();

        $.get('/admin/account/search', {
            account_id: account_id,
            account_name: account_name
        },function (data) {
            account_table.clear().draw();

            data.forEach(element => {
                account_id = element.id;
                account_name = element.name;

                account_table.row.add([
                    account_id
                    ,account_name
                    ,'<a href="/admin/account/edit/' + account_id +'"><i class="fa fa-pencil-square-o"></i></a>' + ' ' +
                        '<a href="/admin/account/delete/'+ account_id +'"><i class="fa fa-trash-o"></i></a>'
                ]).draw(true);

                account_table
                .search( '' )
                .columns().search( '' )
                .draw();
            });
        }).fail(function (err) {
            console.log(err);
        });
    });

    $(document).on('click','.search-account-reset', function(){
        $('#account_id').val('');
        $('#account_name').val('');
        $(".search-account").click();
    });
});


//Attendance table
$(document).ready(function() {

    let opts = {
        lines: 13,
        length: 38,
        width: 17,
        radius: 45,
        scale: 0.5,
        corners: 1,
        color: '#FFF',
        opacity: 0.25,
        animation: 'spinner-line-fade-quick',
        rotate: 0,
        direction: 1,
        speed: 1,
        trail: 60,
        fps: 20,
        zIndex: 2e9,
        className: 'spinner',
        top: '65%',
        left: '50%',
        shadow: false,
        hwaccel: false,
        position: 'absolute',
    };

    var attendance_table = $('#attendance-table').DataTable({
         "searching": false,
         "responsive":true,
         "buttons": [{
             "extend":"csv",
             "text": "Export CSV",
             "title": "Attendance List",
             "exportOptions": {
                 "modifier":{
                     "page":"all"
                 }
               }
         }],
         "dom": '<"top"lf>rt<"bottom"ipB><"clear">',
         "language" :{
            "processing" : 'Loading.. Please Wait ...'
         },
         "processing" : true
     });


     $('#employee-table').on('page.dt', function () {
         var info = employee_table.page.info();

     });
     $(document).on('click', '.search-attendance', function () {
        $('.overlay').show();

        var target = document.getElementById('spinner');
        var spinner = new Spin.Spinner(opts).spin(target);

         let employee_id = $('#employee_id').val();
         let first_name = $('#first_name').val();
         let last_name = $('#last_name').val();
         let account_id = $('#account_id').val();
         let status = $('#status').val();
         let from = $('#from').val();
         let to = $('#to').val();
         $.get('/admin/attendance/search', {
             employee_id: employee_id,
             first_name: first_name,
             last_name: last_name,
             account_id: account_id,
             status: status,
             from: from,
             to: to,
         }, function (data) {
            $('.overlay').hide();
            spinner.stop();
             attendance_table.clear().draw();
             data.forEach(element => {
                 employee_id = element.employee['emp_id'];
                 first_name =  element.employee['first_name'];
                 last_name = element.employee['last_name'];
                 status = element.statuses;
                 time_in = convertDate(element.time_in);
                 time_out = convertDate(element.time_out);
                 over_break_total = null;
                 break_total = null;
                 attendance_table.row.add([
                     employee_id
                     ,first_name
                     ,last_name
                     ,time_in
                     ,time_out
                     ,over_break_total
                     ,break_total
                     ,status
                 ]).draw(true);

                 attendance_table
                 .search( '' )
                 .columns().search( '' )
                 .draw();
             });
         }).fail(function (err) {
             console.log(err)
         });
     });

     $('.buttons-csv').addClass('btn btn-rounded btn-fw');

     $(document).on('click','.search-attendance-reset', function(){
        $('#employee_id').val('');
        $('#first_name').val('');
        $('#last_name').val('');
        $('#account_id').val('');
        $('#status').val('');
        $('#from').val("").datepicker("update");
        $('#to').val("").datepicker("update");
        $('.search-attendance').click();
     });

    function convertDate(value) {
        var date = new Date(value)

        var year = date.getFullYear();
        var month = date.getMonth()+1;
        var dt = date.getDate();
        var h = date.getHours();
        h = (h < 10) ? ("0" + h) : h ;

        var m = date.getMinutes();
        m = (m < 10) ? ("0" + m) : m ;

        var s = date.getSeconds();
        s = (s < 10) ? ("0" + s) : s ;


        if (dt < 10) {
            dt = '0' + dt;
        }
        if (month < 10) {
            month = '0' + month;
        }
        var newdate = year+'-' + month + '-'+dt + ' '+ h + ':' + m + ':' + s;

        return newdate;
    }

});

//Schedule
$(document).ready(function() {
    var schedule_table = $('#schedule-table').DataTable({
        "searching": false,
        "responsive":true,
        "dom": '<"top"lf>rt<"bottom"ipB><"clear">'
    });

    $(document).ready(function(){
        $('#shift_starts').timepicker({});
        $('#shift_ends').timepicker({});
        $('#start_date').datepicker();
    });

    function convertTime(time) {

        time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
        if (time.length > 1) {
            time = time.slice (1);
            time[5] = +time[0] < 12 ? 'am' : 'pm';
            time[0] = +time[0] % 12 || 12;
            time[0] = (time[0] < 10) ? ("0" + time[0]) : time[0]
            time.splice(3, 2);
        }
        return time.join ('  ');
    }


    $(document).on('click', '.search-schedule', function () {
         let schedule_id = $('#schedule_id').val();
         let start_date = $('#start_date').val();
         let shift_starts = $('#shift_starts').val();
         let shift_ends = $('#shift_ends').val();
         let account_id = $('#account_id').val();
         let type = $('#type').val();
         $.get('/admin/schedule/search', {
            schedule_id: schedule_id,
            start_date: start_date,
            shift_starts: shift_starts,
            shift_ends: shift_ends,
            account_id: account_id,
            type: type,
         }, function (data) {
            schedule_table.clear().draw();
             data.forEach(element => {
                 schedule_id = element.id;
                 account_id =  element.account_id;
                 employee_count = element.schedule_employee.length;
                 is_all = ((element.is_all == 1) ? 'Yes' : 'No') ;
                 shift_starts = convertTime(element.shift_starts);
                 shift_ends = convertTime(element.shift_ends);
                 type = element.is_flexs;
                 start_date = element.start_date;
                 schedule_table.row.add([
                    schedule_id
                     ,account_id
                     ,employee_count
                     ,is_all
                     ,shift_starts
                     ,shift_ends
                     ,type
                     ,start_date
                     ,'<a href="/admin/schedule/edit/' + schedule_id +'"><i class="fa fa-pencil-square-o"></i></a>' + ' ' +
                     '<a href="/admin/schedule/delete/'+ schedule_id +'"><i class="fa fa-trash-o"></i></a>'
                 ]).draw(true);

                 schedule_table
                 .search( '' )
                 .columns().search( '' )
                 .draw();
             });
         }).fail(function (err) {
             console.log(err)
         });
     });

     $(document).on('click','.search-schedule-reset', function(){
       $('#schedule_id').val('');
        $('#start_date').val("").datepicker("update");;
       $('#shift_starts').val('');
        $('#shift_ends').val('');
        $('#account_id').val('');
       $('#type').val('');
        $('.search-schedule').click();
     });
});



