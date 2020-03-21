$("#signin").click(function(){
    log_in();
});
var input = document.getElementById("pwd");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        log_in();
    }
});
function log_in(){
    var user = document.getElementById("uname").value;
    var passwd = document.getElementById("pwd").value;
    $.ajax('conexions/validar.php', {
        type: 'POST',  // http method
        data: { user: user,
                passwd: passwd },  // data to submit
        success: function (data, status, xhr) {
            //console.log('status: ' + status + ', data: ' + data);
            if (data == 200) {
                window.location="/pages/dashboard.php";
            } else {
                alert("Error: " + data);
            }
        }
    });
};