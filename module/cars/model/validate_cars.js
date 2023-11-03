
// function validate_license_number(texto){
//     if (texto.length > 0){
//         var reg = /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
//         return reg.test(texto);
//     }
//     return false;
// }

// function validate_model(texto){
//     if (texto.length > 0){
//         var reg=/^[a-zA-Z]*$/;
//         return reg.test(texto);
//     }
//     return false;
// }

// function validate_car_plate(car_plate){
//   var numero = car_plate.substr(0,car_plate.length-1);
//   var let = car_plate.substr(car_plate.length-1,1);
//   numero = numero % 23;
//   var letra='TRWAGMYFPDXBNJZSQVHLCKET';
//   letra=letra.substring(numero,numero+1);
//   if (letra!=let){
//       return false;
//   }else{
//       return true;
//   }
// }

// function validate_km(texto){
//     var i;
//     var ok=0;
//     for(i=0; i<texto.length;i++){
//         if(texto[i].checked){
//             ok=1
//         }
//     }
 
//     if(ok==1){
//         return true;
//     }
//     if(ok==0){
//         return false;
//     }
// }

// function validate_color(texto){
//     if (texto.length > 0){
//         return true;
//     }
//     return false;
// }

// function validate_extras(texto){
//     if (texto.length > 0){
//         var reg=/^[0-9]{1,2}$/;
//         return reg.test(texto);
//     }
//     return false;
// }

// function validate_pais(texto){
//     if (texto.length > 0){
//         return true;
//     }
//     return false;
// }

// function validate_car_image(array){
//     var check=false;
//     for ( var i = 0, l = array.options.length, o; i < l; i++ ){
//         o = array.options[i];
//         if ( o.selected ){
//             check= true;
//         }
//     }
//     return check;
// }

// function validate_price(texto){
//     if (texto.length > 0){
//         return true;
//     }
//     return false;
// }

// function validate_city(array){
//     var i;
//     var ok=0;
//     for(i=0; i<array.length;i++){
//         if(array[i].checked){
//             ok=1
//         }
//     }
 
//     if(ok==1){
//         return true;
//     }
//     if(ok==0){
//         return false;
//     }


// console.log("Test Java")
// tested

function validate_license_number(texto){
    if (texto.length > 16){
        return true;
    }
    return false;
}

function validate_brand(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_model(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_car_plate(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_km(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_category(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_type(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_comments(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_discharge_date(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}
function validate_color(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_extras(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_car_image(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}
function validate_price(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_doors(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_city(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_lat(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_lng(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate(){
    // console.log('hola validate js');
    // tested click en submit
    // return true;

    var check=true;
    
    var v_license_number=document.getElementById('license_number').value;
    var v_brand=document.getElementById('brand').value;
    var v_model=document.getElementById('model').value;
    var v_car_plate=document.getElementById('car_plate').value;
    var v_km=document.getElementById('km').value;
    var v_category=document.getElementById('category').value;
    var v_type=document.getElementById('type').value;
    var v_comments=document.getElementById('comments').value;
    var v_discharge_date=document.getElementById('discharge_date').value;
    var v_color=document.getElementById('color').value;
    var v_extras=document.getElementById('extras').value;
    var v_car_image=document.getElementById('car_image').value;
    var v_price=document.getElementById('price').value;
    var v_doors=document.getElementById('doors').value;
    var v_city=document.getElementById('city').value;
    var v_lat=document.getElementById('lat').value;
    var v_lng=document.getElementById('lng').value;
  
    var r_license_number=validate_license_number(v_license_number);
    var r_brand=validate_brand(v_brand);
    var r_model=validate_model(v_model);
    var r_car_plate=validate_car_plate(v_car_plate);
    var r_km=validate_km(v_km);
    var r_category=validate_category(v_category);
    var r_type=validate_type(v_type);
    var r_comments=validate_comments(v_comments);
    var r_discharge_date=validate_discharge_date(v_discharge_date);
    var r_color=validate_color(v_color);
    var r_extras=validate_extras(v_extras);
    var r_car_image=validate_car_image(v_car_image);
    var r_price=validate_price(v_price);
    var r_doors=validate_doors(v_doors);
    var r_city=validate_city(v_city);
    var r_lat=validate_lat(v_lat);
    var r_lng=validate_lng(v_lng);
    

    if(!r_license_number){       
        document.getElementById('error_license_number').innerHTML = " * El license_number introducido no es valido";
        check=false;
    }else{
        document.getElementById('error_license_number').innerHTML = "";
    }
    if(!r_brand){
        document.getElementById('error_brand').innerHTML = " * La marca introducida no es valida";
        check=false;
    }else{
        document.getElementById('error_brand').innerHTML = "";
    }
    if(!r_model){
        document.getElementById('error_model').innerHTML = " * El model introducido no es valido";
        check=false;
    }else{
        document.getElementById('error_model').innerHTML = "";
    }
    if(!r_car_plate){
        document.getElementById('error_car_plate').innerHTML = " * El car_plate introducido no es valido";
        check=false;
    }else{
        document.getElementById('error_car_plate').innerHTML = "";
    }
    if(!r_km){
        document.getElementById('error_km').innerHTML = " * La cantidad de Km seleccionados no son validos";
        check=false;
    }else{
        document.getElementById('error_km').innerHTML = "";
    }
    if(!r_category){
        document.getElementById('error_category').innerHTML = " * La categoria seleccionada no es valida";
        check=false;
    }else{
        document.getElementById('error_category').innerHTML = "";
    }
    if(!r_type){
        document.getElementById('error_type').innerHTML = " * El tipo seleccionado no es valido";
        check=false;
    }else{
        document.getElementById('error_type').innerHTML = "";
    }
    if(!r_comments){
        document.getElementById('error_comments').innerHTML = " * Los comentarios son incorrectos";
        check=false;
    }else{
        document.getElementById('error_comments').innerHTML = "";
    }
    if(!r_discharge_date){
        document.getElementById('error_discharge_date').innerHTML = " * La fecha es incorrecta";
        check=false;
    }else{
        document.getElementById('error_discharge_date').innerHTML = "";
    }
    if(!r_color){
        document.getElementById('error_color').innerHTML = " * No has introducido ninguna color";
        check=false;
    }else{
        document.getElementById('error_color').innerHTML = "";
    }
    if(!r_extras){
        document.getElementById('error_extras').innerHTML = " * Los extras introducida no es valida";
        check=false;
    }else{
        document.getElementById('error_extras').innerHTML = "";
    }
    if(!r_car_image){
        document.getElementById('error_car_image').innerHTML = " * No has seleccionado ningun car_image";
        check=false;
    }else{
        document.getElementById('error_car_image').innerHTML = "";
    }
    if(!r_price){
        document.getElementById('error_price').innerHTML = " * El precio introducido no es valido";
        check=false;
    }else{
        document.getElementById('error_price').innerHTML = "";
    }
    if(!r_doors){
        document.getElementById('error_doors').innerHTML = " * No has seleccionado ninguna opción";
        check=false;
    }else{
        document.getElementById('error_doors').innerHTML = "";
    }
    if(!r_city){
        document.getElementById('error_city').innerHTML = " * No has seleccionado ninguna city";
        check=false;
    }else{
        document.getElementById('error_city').innerHTML = "";
    }
    if(!r_lat){
        document.getElementById('error_lat').innerHTML = " * No has seleccionado ninguna lat";
        check=false;
    }else{
        document.getElementById('error_lat').innerHTML = "";
    }
    if(!r_lng){
        document.getElementById('error_lng').innerHTML = " * No has seleccionado ninguna lng";
        check=false;
    }else{
        document.getElementById('error_lng').innerHTML = "";
    }
    return check;
}


//modal read

// function showModal(title_Car, id) {
//     $("#details_car").show();
//     $("#modal_cars").dialog({
//         title: title_Car,
//         width : 850,
//         height: 500,
//         resizable: "false",
//         modal: "true",
//         hide: "fold",
//         show: "fold",
//         buttons : {
//             Update: function() {
//                         window.location.href = 'index.php?module=cars&op=update&id=' + id;
//                     },
//             Delete: function() {
//                         window.location.href = 'index.php?module=cars&op=delete&id=' + id;
//                     }
//         }
//     });
// }

// function loadContentModal() {
//     $('.car').click(function () {
//         var id = this.getAttribute('id');
//         // console.log(id);

 
//         $.get("module/cars/controller/controller_cars.php?op=read_modal&id=" + id, 
//         function (data, status) {

//             // console.log(data);
//             //   return true;

//             var data = JSON.parse(data);
//             $('<div></div>').attr('id', 'details_car', 'type', 'hidden').appendTo('#modal_cars');
//             $('<div></div>').attr('id', 'container').appendTo('#details_car');
//             $('#container').empty();
//             $('<div></div>').attr('id', 'car_content').appendTo('#container');
//             $('#car_content').html(function() {
//                 var content = "";
//                 for (row in data) {
//                     content += '<br><span>' + row + ': <span id =' + row + '>' + data[row] + '</span></span>';
//                 }
//                 return content;
//                 });
//                 showModal(title_car = data.brand + " " + data.model, data.id);
//         })
//         .catch(function() {
//             window.location.href = 'index.php?module=errors&op=503&desc=List error';
//         });
//     });
//  }
$(document).ready(function () {
    $('.car').click(function () {
        var id = this.getAttribute('id');
        //alert(id);

        $.get("module/cars/controller/controller_cars.php?op=read_modal&modal=" + id, 
        function (data, status) {
            var json = JSON.parse(data);
            // console.log(json);
            
            if(json === 'error') {
                //console.log(json);
                //pintar 503
                window.location.href='index.php?page=503';
            }else{
                // console.log(json.id);
                $("#id").html(json.id);
                $("#license_number ").html(json.license_number );
                $("#brand").html(json.brand);
                $("#model").html(json.model);
                $("#car_plate").html(json.car_plate);
                $("#km").html(json.km);
                $("#category").html(json.category);
                $("#type").html(json.type);
                $("#comments").html(json.comments);
                $("#discharge_date").html(json.discharge_date);
                $("#color").html(json.color);
                $("#extras").html(json.extras);
                $("#car_image").html(json.car_image);
                $("#price").html(json.price);
                $("#doors").html(json.doors);
                $("#city").html(json.city);
                $("#lat").html(json.lat);
                $("#lng").html(json.lng);
                
     
                $("#details_cars").show();
                $("#read_modal").dialog({
                    width: 850, //<!-- ------------- ancho de la ventana -->
                    height: 500, //<!--  ------------- altura de la ventana -->
                    //show: "scale", <!-- ----------- animación de la ventana al aparecer -->
                    //hide: "scale", <!-- ----------- animación al cerrar la ventana -->
                    resizable: "false", //<!-- ------ fija o redimensionable si ponemos este valor a "true" -->
                    //position: "down",<!--  ------ posicion de la ventana en la pantalla (left, top, right...) -->
                    modal: "true", //<!-- ------------ si esta en true bloquea el contenido de la web mientras la ventana esta activa (muy elegante) -->
                    buttons: {
                        Ok: function () {
                            $(this).dialog("close");
                        }
                    },
                    show: {
                        effect: "blind",
                        duration: 1000
                    },
                    hide: {
                        effect: "explode",
                        duration: 1000
                    }
                });
            }//end-else
        });
    });
});

//  $(document).ready(function() {
//     loadContentModal();
// })