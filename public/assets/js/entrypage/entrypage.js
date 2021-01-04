
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
}
