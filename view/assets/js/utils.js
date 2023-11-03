// console.log("hola_ajax");
function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    // console.log("holaaaaaaaaaaaaaaa_ajax");
    return new Promise((resolve, reject) => {
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData
        }).done((data) => {
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            reject(errorThrow);
        }); 
    });
}

function load_menu() {
    var token = localStorage.getItem('token');
    if (token) {
        // console.log("token test");
        ajaxPromise('module/auth/controller/controller_auth.php?op=data_user', 'POST', 'JSON', { 'token': token })
            .then(function(data) {
                // console.log(data);

                $('#avatarhe').empty();
                $('#user_info').empty();
                $('#authmenu').hide();
                $('<img src="' + data.avatar + '"alt="Robot" class="avatar" >').appendTo('#avatarhe')
                    .html(
                        '<div class="desplegablelogout">' + '</div>'
                    )
                $('#avatarhe').on('click', function() {
                    $('#desplegablelogout').empty();
                    $('#desplegablelogout').toggle();
                    $( '<li><a>' + data.username + '</a></li>').appendTo('#desplegablelogout')
                    .html(
                     '<tr name="lista" style="text-align:right;">' + 
                        '<td>' + '<p >--</p>' +'</td>' +
                        '<td>' + '<button class="namebuton primary-button " role="button">User Info</button>' + '</td>' +
                        '<td>' + '<p >--</p>' +'</td>' +
                        '<td>' + '<button class="logout primary-button " role="button">Logout</button>' + '</td>' +
                        '<td>' + '<p>--</p>' +'</td>' +
                        '<td>' + '<i class="fa-solid fa-cart-shopping fa-bounce fa-2xl" style="color: #ffffff;"></i>' +  '</td>'  +  
                    '</tr>'
                    )
                    console.log("holatoggle");
                });
            }).catch(function() {
                console.log("Error al cargar los datos del user");
            });
    } else {
        console.log("No hay token disponible");
        $('#searchdiv').hide();
        $('.opc_CRUD').empty();
        $('.opc_exceptions').empty();
        $('#user_info').hide();
        $('.log-icon').empty();
        $('<a href="index.php?module=ctrl_login&op=login-register_view"><i id="col-ico" class="fa-solid fa-user fa-2xl"></i></a>').appendTo('.log-icon');
    }
}


function click_logout() {
    $(document).on('click', '.logout', function() {
        localStorage.removeItem('total_prod');
        toastr.success("Logout succesfully");
        setTimeout('logout(); ', 1000);
    });
}

function click_name() {
    let token = localStorage.getItem('token');
    $(document).on('click', '.namebuton', function() {
        ajaxPromise('module/auth/controller/controller_auth.php?op=data_user', 'POST', 'JSON', { 'token': token })
        .then(function(data) {
            console.log(data);
            toastr.success("Cuenta de " + data.username + ", creada el dia " + data.FECHA);
        })
       
        
    });
}


function logout() {
    ajaxPromise('module/auth/controller/controller_auth.php?op=logout', 'POST', 'JSON')
        .then(function(data) {
            localStorage.removeItem('token');
            window.location.href = "index.php?page=controller_shop&op=list";
        }).catch(function() {
            console.log('Something has occured');
        });
}

$(document).ready(function() {
    load_menu();
    click_logout();
    click_name();
});