<?php
if (isset($_GET['page'])) {
	switch ($_GET['page']) {
			// case "homepage";
			// 	include("module/inicio/view/inicio.php");
			// 	break;
		case "controller_cars";
			include("module/cars/controller/" . $_GET['page'] . ".php");
			break;
		case "controller_home";
			include("module/home/controller/" . $_GET['page'] . ".php");
			break;
		case "controller_shop";
			include("module/shop/controller/" . $_GET['page'] . ".php");
			// die('<script>console.log("eeeeeeeeee");</script>');
			break;
		case "controller_auth";
			include("module/auth/controller/" . $_GET['page'] . ".php");
			// die('<script>console.log("eeeeeeeeee");</script>');
			break;
		case "controller_cart";
			include("module/cart/controller/" . $_GET['page'] . ".php");
			// die('<script>console.log("eeeeeeeeee");</script>');
			break;
		case "services";
			include("module/services/" . $_GET['page'] . ".php");
			break;
		case "aboutus";
			include("module/aboutus/" . $_GET['page'] . ".php");
			break;
		case "portfolio";
			include("module/portfolio/" . $_GET['page'] . ".php");
			break;
		case "contactus";
			include("module/contact/" . $_GET['page'] . ".php");
			break;
		case "404";
			include("view/inc/error" . $_GET['page'] . ".php");
			break;
		case "503";
			include("view/inc/error" . $_GET['page'] . ".php");
			break;
		default;
			include("module/inicio/view/inicio.php");
			break;
	}
} else {
	include("module/inicio/view/inicio.php");
}
