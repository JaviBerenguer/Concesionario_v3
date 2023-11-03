function protecturl() {
    var token = localStorage.getItem('token');
    ajaxPromise('module/auth/controller/controller_auth.php?op=controluser', 'POST', 'JSON', { 'token': token })
        .then(function(data) {
            console.log(data);
            if (data == "Correct_User") {
                console.log("CORRECTO-->El usario coincide con la session");
            } else if (data == "Wrong_User") {
                console.log("INCORRECTO--> Estan intentando acceder a una cuenta");
                logout_auto();
            }
        })
        .catch(function() { console.log("ANONYMOUS_user") });
}

function control_activity() {
    var token = localStorage.getItem('token');
    if (token) {
        ajaxPromise('module/auth/controller/controller_auth.php?op=actividad', 'POST', 'JSON')
            .then(function(response) {
                if (response == "inactivo") {
                    console.log("usuario INACTIVO");
                    logout_auto();
                } else {
                    console.log("usuario ACTIVO")
                }
            });
    } else {
        console.log("No hay usario logeado");
    }
}

function refresh_token() {
    var token = localStorage.getItem('token');
    if (token) {
        ajaxPromise('module/auth/controller/controller_auth.php?op=refresh_token', 'POST', 'JSON', { 'token': token })
            .then(function(data_token) {
                console.log("Refresh token correctly");
                // console.log(data_token);
                localStorage.setItem("token", data_token);
                load_menu();
                // load_menu esta en utils.js
            });
    }
}

function refresh_cookie() {
    ajaxPromise('module/auth/controller/controller_auth.php?op=refresh_cookie', 'POST', 'JSON')
        .then(function(response) {
            console.log("Refresh cookie correctly");
        });
}

function logout_auto() {
    ajaxPromise('module/auth/controller/controller_auth.php?op=logout', 'POST', 'JSON')
    .then(function(data) {
        localStorage.removeItem('token');
        toastr.warning("Se ha cerrado la cuenta por seguridad!!");
        setTimeout('window.location.href = "index.php?page=controller_auth&op=list";', 2000);
        // window.location.href = 'index.php?page=controller_auth&op=list'
        
    }).catch(function() {
        console.log('Something has occured');
    });
    
}

$(document).ready(function() {
    setInterval(function() { control_activity() }, 600000); 
    // setInterval(function() { protecturl()}, 60000);
    // protecturl()
    setInterval(function() { refresh_token() }, 600000);
    setInterval(function() { refresh_cookie() }, 600000);
});