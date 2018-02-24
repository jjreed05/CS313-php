// Code is from rationalboss on https://stackoverflow.com/questions/12498209/redirect-10-second-countdown
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        location.href = 'login.php';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
