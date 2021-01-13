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

         let account_id = $('#account_id').val();
         let status = $('#status').val();
         let from = $('#from').val();
         let to = $('#to').val();
         $.get('/user/tracker/search', {
             account_id: account_id,
             status: status,
             from: from,
             to: to,
         }, function (data) {
            $('.overlay').hide();
            spinner.stop();
             attendance_table.clear().draw();
             data.forEach(element => {
                 status = element.statuses;
                 time_in = convertDate(element.time_in);
                 time_out = convertDate(element.time_out);
                 over_break_total = null;
                 break_total = null;
                 attendance_table.row.add([
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


     $(document).on('click','.search-attendance-reset', function(){
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