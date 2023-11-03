function ajaxForSearch(url, filter, total_prod = 0, items_page) {
    // console.log(filter);

    $.post(url, { 'filter': filter, 'total_prod': total_prod, 'items_page': items_page })
        .then(function (shop) {
            $('#list_cars').empty();
            if (shop == "error") {
                $('<div></div>').attr({}).appendTo('#list_cars').html("<h1>No hay resultados</h1>");
            } else {
                var json = JSON.parse(shop);
                console.log(json);

                for (row in json) {
                    // console.log(json[row]);
                    $('<div></div>').attr({ 'id': json[row].id_car, 'class': 'list_content_shop' }).appendTo('#list_cars')
                        .html(

                            `<div class="col-sm-6 col-md-6">
                                <div class="thumbnail">
                                <img src="${json[row].img_cars}" style="width:400px;height:200px">
                                <div class="caption">
                                    <h3>${json[row].name_model}</h3>
                                    <ul>
                                    <li><p>${json[row].name_brand}</p>
                                    <li><p>${json[row].name_tmotor}</p></li>
                                    <li><p>${json[row].car_plate}</p></li>
                                    <li><p>${json[row].id_color}</p></li>
                                    <li><p>${json[row].id_price} $</p></li>
                                    <li><p>${json[row].Km} Km</p></li>  
                                    </ul>
                                    <table>
                                    <tr>
                                        <td><p><button id = "${json[row].id_car}" class="primary-button more_info_list" role="button">Details</button></p></td>
                                        <td></td>
                                        <td><p><button id = "${json[row].id_car}" class="primary-button add_to_cart" role="button">Add to cart</button></p></td>
                                    </tr> 
                                     </table>                                         
                                    <a class='details__heart' id='${json[row].id_car} '><i id= '${json[row].id_car} ' class='fa-regular fa-heart fa-lg'></i></a>
                                    </div>
                                </div>
                            </div>`
                        )
                        // <p><button id = "${json[row].id_car}" class="primary-button list__heart" role="button">LIKE</button></p>
                        // <div class="button_like" id='heart'></div>
                    // <p><button id = "${json[row].id_car}" class="primary-button list__heart" role="button">LIKE</button></p>
                }
                // if (localStorage.getItem('id')) {
                //     document.getElementById(move_id).scrollIntoView();
                // }
                mapBox_all(shop);
                load_likes_user();
            };
        });
}
function loadCars(total_prod = 0, items_page = 4) {
    $('.glider-contain').css({ 'display': 'none' });

    // filtro normal esta en el final de la funcion filter button
    var filter_search = JSON.parse(localStorage.getItem('filter_search'));
    var filter = JSON.parse(localStorage.getItem('filter'));
    let redirect_login_likes = localStorage.getItem('redirect_like')
   
    // console.log("hola load cars");

    if (filter_search) {
        // console.log("testfilter");
        // let filter_search = JSON.parse(localStorage.getItem('filter_search'));
        console.log(filter_search);
        ajaxForSearch("module/shop/controller/controller_shop.php?op=filter_search", filter_search, total_prod, items_page);
    }
    // despues de volver de details
    else if (filter) {
        // console.log("testfilter");
        ajaxForSearch("module/shop/controller/controller_shop.php?op=filter", filter, total_prod, items_page);
        // , total_prod, items_page
    }
    else if(redirect_login_likes){
        redirect_login_like()
    }
    else {
        ajaxForSearch("module/shop/controller/controller_shop.php?op=all_cars", undefined, total_prod, items_page);
    }
}

function clicks() {
    $(document).on("click", ".more_info_list", function () {
        var id_car = this.getAttribute('id');
        $('#list_cars').empty();
        $('#related_cars').empty();
        // console.log(id_car);
        loadDetails(id_car);
        sumar_mas_visitados(id_car);
        // console.log(id_car);
    });
    $(document).on("click", ".list__heart", function () {
        var id_car = this.getAttribute('id');
        click_like(id_car, "list_all");
        // console.log(id_car);
    });

    $(document).on("click", ".details__heart", function () {
        var id_car = this.getAttribute('id');
        click_like(id_car, "details");
    });
    
    $(document).on("click", ".fa-cart-shopping", function () {
        console.log("salto-cart");
        window.location.href = 'index.php?page=controller_cart&op=list'
    });

    $(document).on("click", ".add_to_cart", function () {
        let id_car = this.getAttribute('id');
        // console.log(id_car);
        toastr.success("Añadido con exito");    
        add_cart(id_car);
        });
}
function sumar_mas_visitados(id_car) {
    $.get("module/shop/controller/controller_shop.php?op=sumar_mas_visitados&id=" + id_car)
}
function loadDetails(id_car) {
    $('.related_cars').empty();
    $('.masrelacionados-button').empty();
    $('.pagination').empty(); 
    $('.filters').empty();
    

    //datos coche
    ajaxPromise('module/shop/controller/controller_shop.php?op=details_car', 'POST', 'JSON', { 'id_car': id_car })
        .then(function (json) {
            $('#list_cars').empty();
            $('#titulo_related_cars').empty();
            $('#related_cars').empty();
            $('.glider-contain').css({ 'display': 'block' });
            

            $('<div></div>').attr({ 'id': json.id_car, 'class': 'list_content_shop' }).appendTo('#list_cars')
                .html(

                    `<div class="col-sm-12 col-md-12">
                            <div class="thumbnail">
                               
                            <div class="caption">
                                <h3>${json.name_model}</h3>
                                <ul class=details_car>
                                <li><p>${json.name_brand}</p>
                                <li><p>${json.car_plate}</p></li>
                                <li><p>${json.id_price}</p></li>
                                <li><p>${json.name_tmotor}</p></li>
                                <li><p>${json.name_cat}</p></li>
                                <li><p>${json.city}</p></li>
                                </ul>
                                </br>
                                <p><button class="primary-button boton_volver_details" role="button">Volver</button></p>
                                <a class='details__heart' id='${json.id_car} '><i id= '${json.id_car} ' class='fa-regular fa-heart fa-lg'></i></a>
                            </div>
                            </div>
                        </div>`
                )
            mapBox(json);
            related_cars(json.name_brand, json.id_car)
        });

    //fotos
    // $.get("module/shop/controller/controller_shop.php?op=fotos_coche&id=" + id_car,
    // function (img_coche) {
    ajaxPromise('module/shop/controller/controller_shop.php?op=fotos_coche', 'POST', 'JSON', { 'id': id_car })
        .then(function (img) {
            // var img = JSON.parse(img_coche);
            $('.carouselfotos').empty();
            // console.log(img);
            for (row in img) {
                $('<div style="border-style: solid;"></div>').attr('class', "carouselelements").appendTo(".carouselfotos").html(
                    "<img class='carousel__img' id='' src='" + img[row].img_cars + "' alt='' >"
                )
            }
            new Glider(document.querySelector('.carouselfotos'), {
                slidesToShow: 1,
                slidesToScroll: 1,
                draggable: true,
                dots: '.dots',
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                }
            });
        });

}
function return_button() {
    //boton volver dentro de details
    $(document).on('click', '.boton_volver_details', function () {
        location.reload();
    })

}
function print_filters() {
    // console.log("test1");
    $('<div class="div-filters"></div>').appendTo('.filters')
        .html('<select class="filter_type">' +
            '<option value="E">Electrico</option>' +
            '<option value="H">Hibrido</option>' +
            '<option value="A">Adaptado</option>' +
            '<option value="G">Gasolina</option>' +
            '</select>' +
            '<select class="filter_category">' +
            '<option value="1">KM0</option>' +
            '<option value="2">Second Hand</option>' +
            '<option value="3">Renting</option>' +
            '<option value="4">Pre-owned</option>' +
            '<option value="5">Offer</option>' +
            '<option value="6">New</option>' +
            '</select>' +
            '</select>' +
            '<select class="filter_brand">' +
            '<option value="1">Audi</option>' +
            '<option value="2">BMW</option>' +
            '<option value="3">Chevrolet</option>' +
            '<option value="4">Citroen</option>' +
            '<option value="5">Dacia</option>' +
            '<option value="6">Ferrari</option>' +
            '<option value="7">Fiat</option>' +
            '</select>' +
            '<select class="filter_color">' +
            '<option value="White">White</option>' +
            '<option value="Black">Black</option>' +
            '<option value="Red">Red</option>' +
            '<option value="Blue">Blue</option>' +
            '<option value="Grey">Grey</option>' +
            '<option value="Orange">Orange</option>' +
            '<option value="Brown">Brown</option>' +
            '</select>' +
            '</select>' +
            '<select class="filter_option">' +
            '<option value="id_price">precio de mayor a menor</option>' +
            '<option value="Km">km de mayor a menor</option>' +
            '</select>' +
            '<div id="overlay">' +
            '<div class= "cv-spinner" >' +
            '<span class="spinner"></span>' +
            '</div >' +
            '</div > ' +
            '</div>' +
            '</div>' +
            '<p> </p>' +
            '<button class="filter_button primary-button button_spinner" id="Button_filter">Filter</button>' +
            '<button class="filter_remove primary-button" id="Remove_filter">Remove</button>');
}
function filter_button() {
    // console.log("test2");
    //Filtro type
    $('.filter_color').change(function () {
        localStorage.setItem('filter_color', this.value);
    });
    if (localStorage.getItem('filter_color')) {
        $('.filter_color').val(localStorage.getItem('filter_color'));
    }
    $('.filter_category').change(function () {
        localStorage.setItem('filter_category', this.value);
    });
    if (localStorage.getItem('filter_category')) {
        $('.filter_category').val(localStorage.getItem('filter_category'));
    }
    $('.filter_type').change(function () {
        localStorage.setItem('filter_type', this.value);
    });
    if (localStorage.getItem('filter_type')) {
        $('.filter_type').val(localStorage.getItem('filter_type'));
    }
    $('.filter_brand').change(function () {
        localStorage.setItem('filter_brand', this.value);
    });
    if (localStorage.getItem('filter_brand')) {
        $('.filter_brand').val(localStorage.getItem('filter_brand'));
    }
    $('.filter_option').change(function () {
        localStorage.setItem('filter_option', this.value);
    });
    if (localStorage.getItem('filter_option')) {
        $('.filter_option').val(localStorage.getItem('filter_option'));
    }


    $(document).on('click', '.filter_button', function () {
        var filter = [];
        // console.log(filter);

        if (localStorage.getItem('filter_type')) {
            filter.push(['id_motor', localStorage.getItem('filter_type')])
        }
        if (localStorage.getItem('filter_category')) {
            filter.push(['id_category', localStorage.getItem('filter_category')])
        }
        if (localStorage.getItem('filter_brand')) {
            filter.push(['id_brand', localStorage.getItem('filter_brand')])
        }
        if (localStorage.getItem('filter_color')) {
            filter.push(['id_color', localStorage.getItem('filter_color')])
        }
        if (localStorage.getItem('filter_option')) {
            filter.push(['ordenar', localStorage.getItem('filter_option')])
        }


        if (filter.length != 0) {
            localStorage.setItem('filter', JSON.stringify(filter));
        }

        // console.log(localStorage.getItem('filter'));



        if (filter.length != 0) {
            ajaxForSearch("module/shop/controller/controller_shop.php?op=filter", filter);
            load_pagination()
        }

        else {
            ajaxForSearch("module/shop/controller/controller_shop.php?op=all_cars");
            load_pagination()
        }
        //test
        location.reload();




    });
}
function remove_filters() {
    $(document).on('click', '.filter_remove', function () {
        localStorage.removeItem('filter_type');
        localStorage.removeItem('filter_category');
        localStorage.removeItem('filter_brand');
        localStorage.removeItem('filter_color');
        localStorage.removeItem('filter_option');
        localStorage.removeItem('filter');
        localStorage.removeItem('filter_search');
        //recargar pagina 
        location.reload();
        // highlight(filter);

    });
}
function mapBox_all(shop) {
    var json = JSON.parse(shop);
    // console.log(json);
    mapboxgl.accessToken = 'pk.eyJ1IjoiMjBqdWFuMTUiLCJhIjoiY2t6eWhubW90MDBnYTNlbzdhdTRtb3BkbyJ9.uR4BNyaxVosPVFt8ePxW1g';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-0.61667, 38.83966492354664], // starting position [lng, lat]
        zoom: 6 // starting zoom
    });

    for (row in json) {
        const marker = new mapboxgl.Marker()
        const minPopup = new mapboxgl.Popup()
        minPopup.setHTML('<h3 style="text-align:center;">' + json[row].name_brand + '</h3><p style="text-align:center;">Modelo: <b>' + json[row].name_model + '</b></p>' +
            '<p style="text-align:center;">Precio: <b>' + json[row].id_price + '€</b></p>' +
            '<a class="button button-primary-outline button-ujarak button-size-1 wow fadeInLeftSmall link boton_mapa" data-wow-delay=".4s" id="' + json[row].id_car + '">Read More</a>' +
            '<img src="' + json[row].img_cars + '"  width="70" height="50">')

        marker.setPopup(minPopup)
            .setLngLat([json[row].lon, json[row].lat])
            .addTo(map);
    }


}
function salto_mapa_details() {
    //  console.log(id_car);
    $(document).on('click', '.boton_mapa', function () {
        var id_car = this.getAttribute('id');
        console.log(id_car);
        loadDetails(id_car);
    })
}
function mapBox(json) {
    // console.log(json);
    mapboxgl.accessToken = 'pk.eyJ1IjoiMjBqdWFuMTUiLCJhIjoiY2t6eWhubW90MDBnYTNlbzdhdTRtb3BkbyJ9.uR4BNyaxVosPVFt8ePxW1g';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [json.lon, json.lat], // starting position [lng, lat]
        zoom: 10 // starting zoom
    });
    const markerOntinyent = new mapboxgl.Marker()
    const minPopup = new mapboxgl.Popup()
    minPopup.setHTML('<h4>' + json.name_brand + '</h4><p>Modelo: ' + json.name_model + '</p>' +
        '<p>Precio: ' + json.id_price + '€</p>' +
        '<img src="' + json.img_cars + '"  width="70" height="50">')
    markerOntinyent.setPopup(minPopup)
        .setLngLat([json.lon, json.lat])
        .addTo(map);
}

function related_cars(name_brand, id_car) {
    // console.log(name_brand);
    let marca = name_brand;
    let loadeds = 0;
    let id_coche = id_car;
    // console.log(id_car);
    $('<div></div>').appendTo('#titulo_related_cars')
        .html(
            `<h2>RELATED CARS</h2>`
        )
    ajaxPromise('module/shop/controller/controller_shop.php?op=count_cars_related', 'POST', 'JSON', { 'marca': marca, 'id_car': id_coche })
        .then(function (data) {
            $('<button class="load_more_related btn btn-info btn-block adjust-border-radius" id="load_more_related">LOAD MORE RELATED</button>').appendTo('.masrelacionados-button');
            console.log(data);
            let total_items = data[0].n_prod;
            // console.log(total_items);
            cars_related(0, marca, total_items, id_car);
            $(document).on("click", '.load_more_related', function () {
                // console.log("holaclickmasrelated");
                loadeds = loadeds + 1;
                console.log(loadeds);
                if (loadeds == total_items) {
                    $('<div></div>').attr({}).appendTo('#related_cars').html("<h1>No se encuentran mas coches relacionados</h1>");
                } else if (loadeds < total_items) {
                    cars_related(loadeds, marca, total_items, id_car);
                }
                // $('.more_car__button').empty();

            });
        }).catch(function () {
            console.log('error total_items');
        });
}

function cars_related(loadeds, marca, total_items, id_car) {
    let loaded = loadeds;
    let brand = marca;
    let id_coche = id_car
    let items = 1;
    let tope = total_items;

    // console.log(loaded);
    // console.log(brand);
    // console.log(total_item);
    ajaxPromise("module/shop/controller/controller_shop.php?op=cars_related", 'POST', 'JSON', { 'loaded': loaded, 'brand': brand, 'items_num': items, 'id_car': id_coche })
        .then(function (data) {
            console.log(data);

            for (row in data) {
                // console.log(json[row]);
                $('<div></div>').attr({ 'id': data[row].id_car, 'class': 'list_content_shop' }).appendTo('#related_cars')
                    .html(

                        `<div class="col-sm-6 col-md-6">
                                <div class="thumbnail">
                                <img src="${data[row].img_cars}"  style="width:400px;height:200px">
                                <div class="caption">
                                    <h3>${data[row].name_model}</h3>
                                    <ul>
                                    <li><p>${data[row].name_brand}</p>
                                    <li><p>${data[row].id_color}</p></li>
                                    <li><p>${data[row].id_price} $</p></li>
                                    </ul>
                                    <p><button id = "${data[row].id_car}" class="primary-button more_info_list" role="button">Details</button></p>
                                </div>
                                </div>
                            </div>`

                    )
            }

        })
}

function load_pagination() {
console.log("holapagination");
    let sdata = 0;
    let url = null;
    if (localStorage.getItem('filter')) {
        let filters_y_home = JSON.parse(localStorage.getItem('filter'));
        url = "module/shop/controller/controller_shop.php?op=count_filter";
        sdata = filters_y_home;
        // console.log(url);
    } else if (localStorage.getItem('filter_search')) {

        let filter_search = JSON.parse(localStorage.getItem('filter_search'));
        url = "module/shop/controller/controller_shop.php?op=count_filter_search";
        // console.log(filter_search);
        sdata = filter_search;

    } else {
        url = "module/shop/controller/controller_shop.php?op=count_all_cars";
        // console.log("hola_pagination_all");

    }


    ajaxPromise(url, 'POST', 'JSON', { 'sdata': sdata })
        .then(function (data) {
            console.log(data);
            let total_prod = data[0].contador;

            if (total_prod >= 4) {
                total_pages = Math.ceil(total_prod / 4);
                // console.log(total_pages);
            } else {
                total_pages = 1;
            }

            $('#pagination').bootpag({
                total: total_pages,
                page: 1,
                maxVisible: total_pages
            }).on('page', function (event, num) {
                localStorage.setItem('page', num);
                localStorage.removeItem('id_car');
                total_prod = 4 * (num - 1);
                if (total_prod == 0) {
                    localStorage.setItem('total_prod', 0)
                }
                loadCars(total_prod, 4);
                $('html, body').animate({ scrollTop: $(".list_cars") });
            });
        })
    // .catch(function() {
    //     console.log('Fail pagination');
    // });
}

function click_like(id_car, lugar) {
    var token = localStorage.getItem('token');
    // console.log(id_car);
    // console.log(lugar);
    // $("#" + id_car + ".fa-heart").toggleClass('fa-solid');
    if (token) {
        ajaxPromise("module/shop/controller/controller_shop.php?op=control_likes", 'POST', 'JSON', { 'id_car': id_car, 'token': token })
            .then(function (data) {
                console.log(data);
                // console.log(id_car);
                if(data == 0){
                    $("#" + id_car + ".fa-heart").toggleClass('fa-solid');
                }else{
                    $("#" + id_car + ".fa-heart").toggleClass('fa-regular');
                }
                
            }).catch(function () {
                console.log("error like");
            });

    } else {
        // console.log("holaelseclicklike");
        // const redirect = [];
        // redirect.push(id_car, lugar);

        localStorage.setItem('redirect_like', lugar);
        localStorage.setItem('id_car_like', id_car);

        toastr.warning("Debes de iniciar session");
        setTimeout('window.location.href = "index.php?page=controller_auth&op=list";', 1000);
        
    }
}

function load_likes_user() {
    // console.log("error_load_like_user");
    var token = localStorage.getItem('token');
    if (token) {
        ajaxPromise("module/shop/controller/controller_shop.php?op=load_likes_user", 'POST', 'JSON', { 'token': token })
            .then(function(data) {
                console.log(data);
                for (row in data) {
                    $("#" + data[row].id_car + ".fa-heart").toggleClass('fa-solid');
                    // $("#1" + ".fa-heart").hide()
                }
            }).catch(function() {
                console.log("error_load_like_user");
            });
    }
}

function redirect_login_like() {
console.log("holaredirlike");
    let redirect = localStorage.getItem('redirect_like');
    let id_car = localStorage.getItem('id_car_like');
    if (redirect == "details") {
        console.log("holadetails");
        loadDetails(id_car);
        
        localStorage.removeItem('redirect_like');
        // localStorage.removeItem('page');
    } else if (redirect == "list_all") {
        localStorage.removeItem('redirect_like');
        loadCars();
    }
}

function add_cart(id_car){
    let token = localStorage.getItem('token');
    // console.log(token);
        ajaxPromise("module/cart/controller/controller_cart.php?op=insert_cart", 'POST', 'JSON', { 'id_car': id_car, 'token': token })
        .then(function(data) { 

            
             console.log(data);
            // toastr.success("Coche " + id_car + "añadido al carrito correctamente");
        }).catch(function() {
            // window.location.href = 'index.php?page=error503'
            console.log("error add cart");
        });   
}

// function boton_like_animation() {

//     $(document).on("click", ".button_like", function () {
//         console.log("testgndn");
//         if ($(this).hasClass('active')) {
//             $(this).removeClass('active');
//         } else {
//             timeline.play();
//             $(this).addClass('active');
//         }
//     })


//     var scaleCurve = mojs.easing.path('M0,100 L25,99.9999983 C26.2328835,75.0708847 19.7847843,0 100,0');
//     var el = document.querySelector('.button_like'),
//         // mo.js timeline obj
//         timeline = new mojs.Timeline(),

//         // tweens for the animation:

//         // burst animation
//         tween1 = new mojs.Burst({
//             parent: el,
//             radius: { 0: 100 },
//             angle: { 0: 45 },
//             y: -10,
//             count: 10,
//             radius: 100,
//             children: {
//                 shape: 'circle',
//                 radius: 30,
//                 fill: ['red', 'white'],
//                 strokeWidth: 15,
//                 duration: 500,
//             }
//         });


//     tween2 = new mojs.Tween({
//         duration: 900,
//         onUpdate: function (progress) {
//             var scaleProgress = scaleCurve(progress);
//             el.style.WebkitTransform = el.style.transform = 'scale3d(' + scaleProgress + ',' + scaleProgress + ',1)';
//         }
//     });
//     tween3 = new mojs.Burst({
//         parent: el,
//         radius: { 0: 100 },
//         angle: { 0: -45 },
//         y: -10,
//         count: 10,
//         radius: 125,
//         children: {
//             shape: 'circle',
//             radius: 30,
//             fill: ['white', 'red'],
//             strokeWidth: 15,
//             duration: 400,
//         }
//     });

//     // add tweens to timeline:
//     timeline.add(tween1, tween2, tween3);


//     // when clicking the button start the timeline/animation:
  
// }

$(document).ready(function () {
    loadCars();
    clicks();
    print_filters();
    filter_button();
    remove_filters();
    return_button();
    salto_mapa_details();
    load_pagination();
});
