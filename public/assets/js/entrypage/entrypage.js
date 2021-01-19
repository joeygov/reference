
function display_c()
{
    mytime=setTimeout('display_ct()',1000);
}

function display_ct()
{
    let timenow = new Date().toLocaleTimeString(); 
    document.getElementById('time').innerHTML = timenow;
    display_c();

}

$('#in').click(function (e){
    let emp_id = $('#employee_id').val();
    let IN = $(this).data('in');
    let image = $('#image_tag').val();
    let check = $('#checking').val();

    $.ajax('/get_emp', {
        type: 'post', 
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            employee_id: emp_id,
            time: IN,
            image: image,
            check : check
        },
        success: function (response) {

            if(response.status != 'error') 
            {
                var time_in = $('#in').val();
                $('#myModal #submit').val(time_in); 
                $('#myModal').modal('show');
                $('#label').text('TIME IN');
                $('#info').text(response.employee['last_name'] +", "+response.employee['first_name']);
                $('#ctime').text(response.time);
                
                if (response.res['status'] == 'error') 
                {
                    $('#status').text(response.res['message']);
                    $('#submit').hide();
                    
                }else{

                    $('#status').text('');
                    $('#submit').show();
                }
            }  
            else{
                $('#response').text(response.message);
            }
        },
        error: function (){

        }
    });
});

$('#out').click(function (e) {
    let employee_id = $('#employee_id').val();
    let OUT = $(this).data('out');
    let image = $('#image_tag').val();
    let check = $('#checking').val();

    $.ajax('/get_emp', {
        type: 'post', 
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            employee_id: employee_id,
            time: OUT,
            image: image,
            check : check
        },

        success: function (response) {
            if(response.status != 'error') 
            {
                $('#myModal').modal('show');
                var time_out = $('#out').val();
                $('#myModal #submit').val(time_out); 
                $('#label').text('TIME OUT');
                $('#info').text(response.employee['last_name'] +", "+response.employee['first_name']);
                $('#ctime').text(response.time);

                if (response.res['status'] == 'error') 
                {
                    $('#status').text(response.res['message']);
                    $('#submit').hide();
                    $('#cancel').color('blue');

                }else{
                    $('#status').text('');
                    $('#submit').show();
                }

            }else{
                $('#response').text(response['message']);
            }
        },
        error: function (){

        }
    });
});

setTimeout(function() {
    $('#response').fadeOut('fast');
},5000);

setTimeout(function() {
    $('#alert').fadeOut('fast');
},10000);



