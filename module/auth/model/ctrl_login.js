function login() {
    let redirect_like = localStorage.getItem('redirect_like') || false;
    if (validate_login() != 0) {
        var data = $('#login__form').serialize();
        ajaxPromise('module/auth/controller/controller_auth.php?op=login', 'POST', 'JSON', data)
            .then(function(result) {
                console.log(result);
                if (result == "error_user") {
                    document.getElementById('error_username_log').innerHTML = "El usario no existe,asegurase de que lo a escrito correctamente"
                } else if (result == "error_passwd") {
                    document.getElementById('error_passwd_log').innerHTML = "La contraseña es incorrecta"
                }
                else if(redirect_like){
                    toastr.success("Redirigiendo al coche seleccionado");
                    localStorage.setItem("token", result);
                    setTimeout(' window.location.href = "index.php?page=controller_shop&op=list"; ', 1000);
                    
                }
                else {
                    localStorage.setItem("token", result);
                    toastr.success("Loged succesfully");
                    setTimeout(' window.location.href = "index.php?page=controller_home&op=list"; ', 1000);
                }
            }).catch(function(textStatus) {
                if (console && console.log) {
                    console.log("La solicitud ha fallado: " + textStatus);
                }
            });
    }
}

function key_login() {
    $("#login").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            e.preventDefault();
            login();
        }
    });
}

function button_login() {
    $('#login').on('click', function(e) {
        e.preventDefault();
        login();
    });
}

function validate_login() {
    var error = false;

    if (document.getElementById('username_log').value.length === 0) {
        document.getElementById('error_username_log').innerHTML = "Tienes que escribir el usuario";
        error = true;
    } else {
        if (document.getElementById('username_log').value.length < 5) {
            document.getElementById('error_username_log').innerHTML = "El usuario tiene que tener 5 caracteres como minimo";
            error = true;
        } else {
            document.getElementById('error_username_log').innerHTML = "";
        }
    }

    if (document.getElementById('passwd_log').value.length === 0) {
        document.getElementById('error_passwd_log').innerHTML = "Tienes que escribir la contraseña";
        error = true;
    } else {
        document.getElementById('error_passwd_log').innerHTML = "";
    }

    if (error == true) {
        return 0;
    }
}

$(document).ready(function() {
    key_login();
    button_login();
});