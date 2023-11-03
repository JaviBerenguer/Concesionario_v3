<!-- <div id="header">
</div> -->

<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button
        type="button"
        class="navbar-toggle"
        data-toggle="collapse"
        data-target=".navbar-collapse"
      >
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?page">CAR-NISSERIA</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-left ">
        <!-- <li><a href="index.php?page=homepage">INICIO</a></li>       -->
        <li><a href="index.php?page=controller_home&op=list">HOME</a></li>
        <li><a href="index.php?page=controller_shop&op=list">SHOP</a></li>
        <li id="authmenu"><a href="index.php?page=controller_auth&op=list">AUTH</a></li>
        <!-- <li><a href="index.php?page=controller_cars&op=list">CONTROLLER</a></li> -->
        <!-- <li><a href="index.php?page=aboutus">ABOUT US</a></li> -->
        <!-- <li><a href="index.php?page=services">SERVICES</a></li> -->
        <li><a href="index.php?page=contactus">CONTACT US</a></li>
        <li><a href="index.php?page=portfolio">PORTFOLIO</a></li>
        <li style="color:black;">--------------------------------------------</li>
        <li id="avatarhe"></li>
        <li id="desplegablelogout"></li> 
        <!-- <li><a href="index.php?page=contactus">CONTACT</a></li> -->
      </ul>
</br>
</br>
</br>
</br>
              <!-- ======SEARCH====== -->
              <div id="searchdiv">
                <div class="nav navbar-nav navbar-right">
                  <div class="search__form">
                    <ul class="nav navbar-nav navbar-left">
                      <li>
                        <label style="color: white">BRAND</label>
                        <select id="brand_car"></select>
                      </li>
                      <li>
                        <label style="color: white">CATEGORY</label>
                        <select id="category"></select>
                      </li>
                      <label style="color: white">CITY</label>
                      <input type="text" id="autocom" autocomplete="off" />          
                      <input type="button" value="SEARCH" id="boton_search" />
                      <div id="search_auto"></div>
                      <div id="error_coches"></div>
                      
                    </ul>
                  </div>
                  <div id="test"></div>
                </div>
              </div>
    </div>
  </div>
</div>
