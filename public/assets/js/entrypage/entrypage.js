
function display_c()
    {
    var refresh=1000; 
    mytime=setTimeout('display_ct()',refresh);
    }

//display currenttime
function display_ct() {
    var months = [ "January", "February", "March", "April", "May", "June", 
        "July", "August", "September", "October", "November", "December" ];

    var x = new Date();
    var date =months[ x.getMonth()] +" "+ x.getDate() + ", " + x.getFullYear();
    var hours = x.getHours();
    var minutes = x.getMinutes();
    var seconds = x.getSeconds();
    var ampm = hours <= 12 ? 'AM' : 'PM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' +seconds : seconds;
    var currentTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    document.getElementById('date').innerHTML = date;
    document.getElementById('time').innerHTML = currentTime;
    display_c();
}

function ok(){
    location.reload();
}