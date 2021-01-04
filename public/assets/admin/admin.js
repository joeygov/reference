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
            console.log(data)
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
                    ,'<a href=""><i class="fa fa-pencil-square-o"></i></a>' + ' ' +
                        '<a href=""><i class="fa fa-trash-o"></i></a>'
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
} );