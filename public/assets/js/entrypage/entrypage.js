
function display_c()
{
    var refresh=1000; 
    mytime=setTimeout('display_ct()',refresh);
}

//display currenttime
function display_ct() {
    let timenow = new Date().toLocaleTimeString(); 
    document.getElementById('time').innerHTML = timenow;
    display_c();
    getDate();
}

function changeLabel()
{
    document.getElementById('label').innerHTML = 'TIME IN';
}

function getDate()
{
    var d = new Date();
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    document.getElementById("date").innerHTML = months[d.getUTCMonth()] + " " + d.getUTCDate() + "," + d.getUTCFullYear() ;
}

$(document).on('click','.idAsk', function(){
    $('#emp_id').val('');
});

$('#in').click(function () {
    var time_in = $('#in').val();
    $('#myModal #submit').val(time_in); 
    $('#label #in').innerHTML = 'TIME IN';
});

$('#out').click(function () {
    var time_out = $('#out').val();
    $('#myModal #submit').val(time_out);
    $('#label #submit').innerHTML = 'TIME OUT';
    console.log(time_out);
});

setTimeout(function() {
    $('#response').fadeOut('fast');
},3000);




