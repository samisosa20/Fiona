$("#signin").click(function(){
    log_in();
});
if (document.getElementById("pwd")){
    var input = document.getElementById("pwd");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            log_in();
        }
    });
};
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
            } else if (data == 400) {
                document.getElementById("uname").className = "form-control is-invalid";
                document.getElementById("mensaje").innerHTML = "<div class='alert alert-danger' role='alert'>" +
                "El usuario no existe!</div>";
            } else if (data == 450) {
                document.getElementById("uname").className = "form-control is-invalid";
                document.getElementById("pwd").className = "form-control is-invalid";
                document.getElementById("mensaje").innerHTML = "<div class='alert alert-danger' role='alert'>" +
                "Usuario o contraseña incorrecta!</div>";
            } else if (data == 100) {
                alert ("Problemas al conectar con el servidor");
            }
        }
    });
};
function lowerCase(id) {
    var x=document.getElementById(id).value
    document.getElementById(id).value=x.toLowerCase().trim();
};
$("#btn_signup").click(function(){
    sign_up();
});
function sign_up(){
    var name = document.getElementById("name").value;
    var lastname = document.getElementById("lastname").value;
    var email = document.getElementById("email").value.trim();
    var pass = document.getElementById("pass").value;
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (email == "" || !emailRegex.test(email) || name == "" || pass == "" || pass.length < 6){
        if (!emailRegex.test(email) || email == ""){
            document.getElementById("email").className = "form-control is-invalid";
        }
        if (name == ""){
            document.getElementById("name").className = "form-control is-invalid";
        }
        if (pass == "" || pass.length < 6){
            document.getElementById("pass").className = "form-control is-invalid";
        }
    } else {
        $.ajax('conexions/registrar.php', {
            type: 'POST',  // http method
            data: { name: name,
                lastname: lastname,
                email: email,
                pass: pass},  // data to submit
            success: function (data, status, xhr) {
                //console.log('status: ' + status + ', data: ' + data);
                if (data == 200) {
                    window.location="/";
                } else {
                    alert("Error: No se pudo registrar correctamente!. (" + 
                    data + ")");
                }
            }
        });
    }
};