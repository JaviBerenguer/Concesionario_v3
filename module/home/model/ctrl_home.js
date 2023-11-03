// console.log("hola_js");

function loadCategories() {
    
    $.get("module/home/controller/controller_home.php?op=homePageCategory",
        function (data, status) {
            // console.log(data);
            // console.log(data);
            var json = JSON.parse(data);
            // console.log(json);

            for (row in json) {
                $('<div></div>').attr('class', "card1").attr({ 'id': json[row].id_cat }).appendTo('#containerCategories')
                    .html(
                        "<div class='card_image'>" +
                        "<img src=" + json[row].img_cat + " />" +
                        "</div > "
                        // " < br > " +
                        // " < div class= 'card_title title-black' > " +
                        // " < p > " + json[row].name_cat + "</p > " +
                        // "</div > "
                    )
            }
            if (json === 'error') {
                console.log("error");
                //pintar 503
            }
        })
}

function carousel_Brands() {
     console.log("hola");
    $.get("module/home/controller/controller_home.php?op=Carrousel_Brand",
        function (data, status) {
            // console.log(data);
            var json = JSON.parse(data);
            // console.log(json);

            for (row in json) {
                $('<div></div>').attr('class', "card2", "carouselelements").attr('id', json[row].id_brand).appendTo(".carousellist").html(
                    "<img class='carousel__img' id='' src='" + json[row].img_brand + "' alt='' >"
                
                    
                    )
            }

            new Glider(document.querySelector('.carousellist'), {
                slidesToShow: 5,
                slidesToScroll: 5,
                draggable: true,
                dots: '.dots',
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                }
            });

            if (json === 'error') {
                console.log("error");
                //pintar 503
            }
        });
}

function loadCatTypes() {
    console.log("test");
    $.get("module/home/controller/controller_home.php?op=homePageType",
        function (data, status) {
            // console.log(data);
            var json = JSON.parse(data);
            // console.log(json);

               for (row in json) {
                $('<div></div>').attr('class', "card3").attr({'id': json[row].cod_tmotor}).appendTo('#containertypes')
                    .html(
                        "<div class='card_image'>" +
                        "<img src=" + json[row].img_tmotor + " />" +
                        "</div > "
                        // " < br > " +
                        // " < div class= 'card_title title-black' > " +
                        // " < p > " + json[row].name_cat + "</p > " +
                        // "</div > "
                    )
            }

            if (json === 'error') {
                console.log("error");
                //pintar 503
            }
        });

}
function clicks(){
    $(document).on("click",'div.card1', function (){
        var filter = [];
        filter.push(["id_category",this.getAttribute('id')]);
        localStorage.removeItem('filter')
        localStorage.setItem('filter', JSON.stringify(filter)); 
        // console.log(filters);
          setTimeout(function(){ 
            window.location.href = 'index.php?page=controller_shop&op=list';
          }, 1000);  
      }); 
  
      $(document).on("click",'div.card2', function (){
        var filter = [];
        filter.push(["id_brand",this.getAttribute('id')]);
        localStorage.removeItem('filter')
        localStorage.setItem('filter', JSON.stringify(filter)); 
          setTimeout(function(){ 
            window.location.href = 'index.php?page=controller_shop&op=list';
          }, 1000);  
      });
  
      $(document).on("click",'div.card3', function (){
        var filter = [];
        filter.push(["id_motor",this.getAttribute('id')]);
        localStorage.removeItem('filter')
        localStorage.setItem('filter', JSON.stringify(filter)); 
          setTimeout(function(){ 
            window.location.href = 'index.php?page=controller_shop&op=list';
          }, 1000);  
      });

      $(document).on("click",'div.card4', function (){
        var filter = [];
        filter.push(["id_car",this.getAttribute('id')]);
        localStorage.removeItem('filter')
        localStorage.setItem('filter', JSON.stringify(filter)); 
          setTimeout(function(){ 
            window.location.href = 'index.php?page=controller_shop&op=list';
          }, 1000);  
      });
    //   $(document).on("click",'div.card4', function (){
    //     var filter = [];
    //     filter.push(["id_car",this.getAttribute('id')]);
    //     localStorage.removeItem('filter')
    //     localStorage.setItem('filter', JSON.stringify(filter)); 
    //       setTimeout(function(){ 
    //             localStorage.setItem('model_mas_visitados', this.value);
    //         window.location.href = 'index.php?page=controller_shop&op=details_car';
    //       }, 1000);  
    //   });
}

function mas_visitados() {
    // console.log("hola");
   $.get("module/home/controller/controller_home.php?op=mas_visitados",
       function (data, status) {
        //    console.log(data);
           var json = JSON.parse(data);
           console.log(json);
           for (row in json) {
            $('<div></div>').attr('class', "card4", "carouselelements").attr('id', json[row].id_car).appendTo(".mas_visitados").html(
                "<img class='carousel__img ' id='' src='" + json[row].img_cars + "' alt='' >"
            )
        }

        new Glider(document.querySelector('.mas_visitados'), {
            slidesToShow: 5,
            slidesToScroll: 5,
            draggable: true,
            dots: '.dots',
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            }
        });

        if (json === 'error') {
            console.log("error");
            //pintar 503
        }

})
}
function load_more_Books_car() {
    var limit = 3;

    $(document).on("click", '#load_more_books', function() {
        limit = limit + 1;
        $('.books_car').remove();
        $('#load_more_books').remove();
        
        ajaxPromise('https://www.googleapis.com/books/v1/volumes?q=Cars','GET', 'JSON')
            .then(function(data) {
                if (limit === 6) {
                    $('<button class="no-results btn btn-warning btn-block adjust-border-radius" id="">No hay mas libros disponibles....</button></br>').appendTo('.maslibros-button');
                } else {
                    $('<button class="load_more_button btn btn-warning btn-block adjust-border-radius" id="load_more_books">LOAD MORE</button>').appendTo('.maslibros-button');
                }

                for (i = 0; i < limit; i++) {
                    $('<div></div>').attr({ id: 'books_car', class: 'books_car' }).appendTo('.noticiasdiv')
                        .html(
                            '<div class="col-md-4 col-sm-4 col-xs-12">' +
                            '<div class="panel panel-danger adjust-border-radius">' +
                            '<div class="title_book panel-heading adjust-border">' +
                            '<h4>' + data.items[i].volumeInfo.title + '</h4>' +
                            '</div>' +
                            '<div class="panel-body">' +
                            '<ul class="plan">' +
                            '<li class="Img_new"><img src=' + data.items[i].volumeInfo.imageLinks.thumbnail + '</li>' +
                            '<li><i id="col-ico" class="fa-solid fa-user-large fa-sm"></i>&nbsp;&nbsp;' + data.items[i].volumeInfo.authors[0] + '</li>' +
                            '<li><i id="col-ico" class="fa-solid fa-calendar-days fa-sm"></i>&nbsp;&nbsp;' + data.items[i].volumeInfo.publishedDate + '</li>' +
                            '</ul>' +
                            '</div>' +
                            '<div class="panel-footer">' +
                            '<a href=' + data.items[i].volumeInfo.infoLink + ' target="_blank" class="btn btn-danger btn-block adjust-border-radius">MORE INFO</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                }
            }).catch(function() {
                // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=News cars HOME";
            });
    })
}

function get_Books_car() {
    limit = 3;

    ajaxPromise('https://www.googleapis.com/books/v1/volumes?q=Cars','GET', 'JSON')
        .then(function(data) {
            data.items.length = limit;
            $('<h2 class="cat">Books releted</h2>').appendTo('.noticiasdiv');
            $('<button class="load_more_button btn btn-warning btn-block adjust-border-radius" id="load_more_books">LOAD MORE</button>').appendTo('.maslibros-button');
            
            for (i = 0; i < data.items.length; i++) {
                $('<div></div>').attr({ id: 'books_car', class: 'books_car' }).appendTo('.noticiasdiv')
                    .html(
                        '<div class="col-md-4 col-sm-4 col-xs-12">' +
                        '<div class="panel panel-danger adjust-border-radius">' +
                        '<div class="title_book panel-heading adjust-border">' +
                        '<h4>' + data.items[i].volumeInfo.title + '</h4>' +
                        '</div>' +
                        '<div class="panel-body">' +
                        '<ul class="plan">' +
                        '<li class="Img_new"><img src="' + data.items[i].volumeInfo.imageLinks.thumbnail + '"</li>' +
                        '<li><i id="col-ico" class="fa-solid fa-user-large fa-sm"></i>&nbsp;&nbsp;' + data.items[i].volumeInfo.authors[0] + '</li>' +
                        '<li><i id="col-ico" class="fa-solid fa-calendar-days fa-sm"></i>&nbsp;&nbsp;' + data.items[i].volumeInfo.publishedDate + '</li>' +
                        '</ul>' +
                        '</div>' +
                        '<div class="panel-footer">' +
                        '<a href=' + data.items[i].volumeInfo.infoLink + ' target="_blank" class="btn btn-danger btn-block btn-lg adjust-border-radius">MORE INFO</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );
            }
        }).catch(function() {
            // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=News cars HOME";
        });
    load_more_Books_car();
}



$(document).ready(function () {
    // console.log("holaafaaaaaaa_sssssssssss");
    carousel_Brands();
    loadCategories();
    loadCatTypes();
    clicks();
    mas_visitados();
    get_Books_car();
});

