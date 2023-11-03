

function load_cart(){
    let token = localStorage.getItem('token');
        ajaxPromise("module/cart/controller/controller_cart.php?op=load_cart", 'POST', 'JSON', {'token': token })
        .then(function(data) { 
            console.log(data);
            var total_price = 0;
            
            for (row in data) {
                $(".listacart").append(

                    `<div class="col-sm-10 col-md-10">
                        
                        <table style="border-style: solid;">
                        <div class= "cardslista">
                        <tr>
                            <td>
                            <img src="${data[row].img_cars}"  style="width:200px;height:100px">
                            </td>
                           
                            <td>
                                <h3>${data[row].name_model}</h3>
                                <ul>
                                    <li><p>${data[row].name_brand}</p>
                                    <li><p>${data[row].id_color}</p></li>
                                    <li><p>${data[row].id_price} $</p></li>
                                    <li>Unidades:  <p>${data[row].qty} </p></li>
                                </ul>
                            </td>  
                                
                            <td>
                            <p><button id = "${data[row].id_car}" class="primary-button button__remove" role="button">Delete</button></p>
                            <p><button id = "${data[row].id_car}" class="primary-button button__remove" role="button">+</button></p>
                            <p><button id = "${data[row].id_car}" class="primary-button button__remove" role="button">-</button></p>
                            </td>
                        </tr>
                        </div>
                        </table>
                        
                       
                    </div>`
                )   
                var total_price = total_price + (data[row].precio)*(data[row].qty);
            }    
            $(".subtotal-value").append(total_price);
            $(".total-value").append(total_price);
        }).catch(function() {
            window.location.href = 'index.php?page=error503'
        });   
    }


function remove_cart(){
    $(document).on('click','.button__remove',function () {
        let id_car = this.getAttribute('id');
        let token = localStorage.getItem('token');
        let idcar_token = [id_car, token];
        // console.log(token);
        if(token == null){
            // console.log("erroreeeeeeee");
            setTimeout(' window.location.href = "index.php?page=controller_login&op=login_view"; ',1000);
        }else{
            ajaxPromise("module/cart/controller/controller_cart.php?op=delete_cart", 'POST', 'JSON', {'idcar_token': idcar_token })
            .then(function(data) { 
                console.log(data);
                toastr.success("Eliminado con exito");                   
                 setTimeout('window.location.href = "index.php?page=controller_cart&op=list";', 1000);

            }).catch(function() {
                // window.location.href = 'index.php?page=error503'
                console.log("hola-catch");
            });   
        }
    });
}

function change_qty(){
    $(document).on('input','.quantity-field',function () {
        var codigo_producto =  this.getAttribute('id');
        var qty = $(".quantity-field").val();
       
            ajaxPromise("module/cart/controller/controller_cart.php?op=update_qty&user=" + localStorage.getItem('token') + "&id=" + codigo_producto + "&qty=" + qty, 'GET', 'JSON')
            .then(function() { 
                location.reload();
            }).catch(function() {
                window.location.href = 'index.php?page=error503'
            });   
        
    });
}

// function checkout(){
//     $(document).on('click','.checkout-cta',function () {
//         if(localStorage.getItem('token') == null){
//             setTimeout(' window.location.href = "index.php?page=controller_login&op=login_view"; ',1000);
//         }else{
//             ajaxPromise("module/cart/controller/controller_cart.php?op=delete_cart", 'POST', 'JSON', {'idcar_token': idcar_token })
//             .then(function(data) { 
//                 window.location.href = 'index.php?page=controller_home&op=homepage'
//             }).catch(function() {
//                 window.location.href = 'index.php?page=error503'
//             });   
//         }
//     });
// }

$(document).ready(function(){
    load_cart();
    remove_cart();
    // change_qty();
    // checkout();
});