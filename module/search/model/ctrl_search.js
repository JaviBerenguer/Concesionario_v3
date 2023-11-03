// console.log("hola ctLr search");
function load_brand() {
    localStorage.removeItem('brand_car');
    // console.log("holaaaaaaaa");
    ajaxPromise('module/search/ctrl/ctrl_search.php?op=brand_car', 'POST', 'JSON')
        .then(function (data) {
            $('#brand_car').append('<option value = "0" disabled selected>Brand</option>');
            for (row in data) {
                $('#brand_car').append('<option value = "' + data[row].name_brand + '">' + data[row].name_brand + '</option>');
            }
        }).catch(function () {
            console.log("Fail load type_car");
        });
}


function load_category() {
    localStorage.removeItem('category');
    ajaxPromise('module/search/ctrl/ctrl_search.php?op=category_null', 'POST', 'JSON')
        .then(function (data) {
            $('#category').empty();
            $('#category').append('<option value = "0" disabled selected>Category</option>');
            for (row in data) {
                $('#category').append('<option value = "' + data[row].name_cat + '">' + data[row].name_cat + '</option>');
            }
        }).catch(function () {
            console.log("Fail load category_car");
        });

    //test poner # y no . porque es por id, no una clase
    $('#brand_car').change(function () {
        //test
        localStorage.removeItem('error_no_marca');
        localStorage.removeItem('brand_car');
        localStorage.setItem('brand_car', this.value);
        var brand_localstorage = 0;
        brand_localstorage = localStorage.getItem('brand_car');
        console.log(brand_localstorage);
        //test
        // console.log(brand_localstorage) 
        if (brand_localstorage != null) {
            // console.log("holaloadcat");
            ajaxPromise('module/search/ctrl/ctrl_search.php?op=category', 'POST', 'JSON', { 'marca_load_cat': brand_localstorage })
                .then(function (data) {
                    $('#category').empty();
                    $('#category').append('<option value = "0" disabled selected>Category</option>');
                    // console.log(data);
                    for (row in data) {
                        $('#category').append('<option value = "' + data[row].name_cat + '">' + data[row].name_cat + '</option>');
                    }
                }).catch(function () {
                    //despues compruebo al darle search si error_no_marca vale null para aplicar filtro search, o si es igual a distinto de null
                    // se limpian los filtros y va a shop
                    localStorage.setItem('error_no_marca',"error");
                    console.log("Fail load category_car");
                    $('#error_coches').empty();
                    $('#error_coches').fadeIn(500);
                    $('<div style="color:white;"></div>').appendTo('#error_coches').html("No se encuentran coches de esta marca");
                    $('#error_coches').fadeOut(500);
                });
        }
    });
    $('#category').change(function () {
        // localStorage.setItem('category', this.value);
        // var category_localstorage = 0;
        // category_localstorage = localStorage.getItem('category');
        // console.log(category_localstorage)
    })
}
function autocomplete() {
//repito todo igual pero con click
$("#autocom").on("click", function () {
    $('#error_coches').empty();
    $('#search_auto').empty();
    // console.log("test_autocom");
    let sdata = { complete: $(this).val() };
    if (($('#brand_car').val() != 0)){
        sdata.brand = $('#brand_car').val();
        console.log(sdata.brand);
        if (($('#brand_car').val() != 0) && ($('#category').val() != 0)) {
            sdata.category = $('#category').val();
            console.log(sdata.category);
        }
    }
    if (($('#brand_car').val() == 0) && ($('#category').val() != 0)) {
        sdata.category = $('#category').val();
        console.log(sdata.category);
    }
    ajaxPromise('module/search/ctrl/ctrl_search.php?op=autocomplete', 'POST', 'JSON', sdata)
        .then(function (data) {
            console.log(data);
            $('#search_auto').empty();
            $('#search_auto').fadeIn(10000000);
            
            for (row in data) {
                $('<div style="color:white;"></div>').appendTo('#search_auto').html(data[row].city).attr({ 'class': 'searchElement', 'id': data[row].city });
            }
//
            // $("#autocom").on("keyup", function (event) {
            //     if ( event.key == "Enter") {
            //         console.log("test_enter");
            //         $('#autocom').val(this.getAttribute(data[0].city));
            //     // $('#search_auto').fadeOut(1000);
            //     }
            // });
//
            $(document).on('click', '.searchElement', function () {
                $('#autocom').val(this.getAttribute('id'));
                // $('#search_auto').fadeOut(1000);
                $('#search_auto').empty();
            
            });
            $(document).on('click scroll', function (event) {
                if (event.target.id !== 'autocom') {
                    // $('#search_auto').fadeOut(1000);
                    $('#search_auto').empty();
                }
            });
        }).catch(function () {
            // $('#search_auto').fadeOut(500);
        });
});

//igual pero con keyup

$("#autocom").on("keyup", function (presionar_tecla) {
    //que no funcione con enter
    // if ( presionar_tecla.key != "Enter") {
    $('#error_coches').empty();
    $('#search_auto').empty();
    // console.log("test_autocom");
    let sdata = { complete: $(this).val() };
    if (($('#brand_car').val() != 0)){
        sdata.brand = $('#brand_car').val();
        console.log(sdata.brand);
        if (($('#brand_car').val() != 0) && ($('#category').val() != 0)) {
            sdata.category = $('#category').val();
            console.log(sdata.category);
        }
    }
    if (($('#brand_car').val() == 0) && ($('#category').val() != 0)) {
        sdata.category = $('#category').val();
        console.log(sdata.category);
    }
    ajaxPromise('module/search/ctrl/ctrl_search.php?op=autocomplete', 'POST', 'JSON', sdata)
        .then(function (data) {
            console.log(data);
            $('#search_auto').empty();
            $('#search_auto').fadeIn(10000000);
            
            for (row in data) {
                $('<div style="color:white;"></div>').appendTo('#search_auto').html(data[row].city).attr({ 'class': 'searchElement', 'id': data[row].city });
            }

            $(document).on('click', '.searchElement', function () {
                $('#autocom').val(this.getAttribute('id'));
                // $('#search_auto').fadeOut(1000);
                $('#search_auto').empty();
            
            });
            $(document).on('click scroll', function (event) {
                if (event.target.id !== 'autocom') {
                    // $('#search_auto').fadeOut(1000);
                    $('#search_auto').empty();
                }
            });
        }).catch(function () {
            // $('#search_auto').fadeOut(500);
        });
    // }
});


}


function button_search() {
    $('#boton_search').on('click', function () {

        var error_marca = null;
        error_marca = localStorage.getItem('error_no_marca');
        console.log(error_marca);

        var search = [];
        //todos con valor = 0
        if (error_marca != null){
            localStorage.removeItem('filter');
            localStorage.removeItem('filter_search');
            window.location.href = 'index.php?page=controller_shop&op=list';
        }else{
        if ($('#autocom').val() == ""){
            search.push(["autocom", '0']);
            search.push(["brand_car", $('#brand_car').val()]);
            search.push(["category", $('#category').val()]);
        } else {
            search.push(["autocom", $('#autocom').val()]);
            search.push(["brand_car", $('#brand_car').val()]);
            search.push(["category", $('#category').val()]);
        }
        localStorage.removeItem('filter');
        console.log(search);
        localStorage.removeItem('filter_search');
        localStorage.setItem('filter_search', JSON.stringify(search));
        window.location.href = 'index.php?page=controller_shop&op=list'
    }
      
    

    });
    // $('#brand_car').change(function () {
    //     localStorage.setItem('brand', this.value);
    // });
    // if (localStorage.getItem('brand')) {
    //     $('.brand').val(localStorage.getItem('brand'));
    //     }
    }




$(document).ready(function () {
    button_search();
    load_brand();
    load_category();
    autocomplete();
});