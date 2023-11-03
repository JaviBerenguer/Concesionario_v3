<?php
// die('<script>console.log("test");</script>'); 
$path = $_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3';
include($path . "/module/shop/model/DAO_shop.php");
include($path . "/model/middleware_auth.php");


switch ($_GET['op']) {
    case 'list':
        // die('<script>console.log("test_list");</script>'); 
        include('module/shop/view/shop.html');
        break;

    case 'all_cars':
        // echo json_encode("hola_all_cars");
        // exit;
        // exit;
        // die('<script>console.log("test");</script>');
        // $prod = $_POST['total_prod'];
        // $items = $_POST['items_page'];
        try {
            $daoshop = new DAOShop();
            $Dates_Cars = $daoshop->select_all_cars($_POST['total_prod'], $_POST['items_page']);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Dates_Cars)) {
            echo json_encode($Dates_Cars);
        } else {
            echo json_encode("error");
        }
        break;
    
    case 'count_all_cars':
            // echo json_encode("hola_all_cars");
            // exit;
            // exit;
            // die('<script>console.log("test");</script>');
            // $prod = $_POST['total_prod'];
            // $items = $_POST['items_page'];
            try {
                $daoshop = new DAOShop();
                $Dates_Cars = $daoshop->count_all_cars();
            } catch (Exception $e) {
                echo json_encode("error");
            }
    
            if (!empty($Dates_Cars)) {
                echo json_encode($Dates_Cars);
            } else {
                echo json_encode("error");
            }
            break;

    case 'details_car':
        // echo json_encode($_GET['id']);
// echo json_encode(($_POST['id_car']));
// exit;
        try {
            $daoshop = new DAOShop();
            $Date_car = $daoshop->select_one_car($_POST['id_car']);
            echo json_encode($Date_car);
        } catch (Exception $e) {
            echo json_encode("error");
        }
        break;
    case 'fotos_coche':
            // echo json_encode($_GET['id']);
    
            try {
                $daoshop = new DAOShop();
                $img_car = $daoshop->select_imgs_car($_POST['id']);
                echo json_encode($img_car);
            } catch (Exception $e) {
                echo json_encode("error");
            }
            break;

 
    case 'filter';
    // echo json_encode("hola_case_filter");
    // echo json_encode($_POST['filter']);
    // exit;
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery->filters($_POST['filter'], $_POST['total_prod'], $_POST['items_page']);
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        } else {
            echo "error";
        }
        break;
        
        case 'count_filter';
        // echo json_encode("hola_case_filter");
        // echo json_encode($_POST['filter']);
        // exit;
            $homeQuery = new DAOShop();
            $selSlide = $homeQuery->filters_count($_POST['sdata']);
            if (!empty($selSlide)) {
                echo json_encode($selSlide);
            } else {
                echo "error";
            }
            break;
        // default;
        //     include("module/exceptions/views/pages/error404.php");
        //     break;
        

       
        
    case 'filter_search':
    // echo json_encode("hola_case_filter_search");
    // exit;
    // echo json_encode($_POST['filter']);
    // exit;
    
    $total_prod = $_POST['total_prod'];
    $items_page = $_POST['items_page'];
    $all_search = $_POST['filter'];
    $city = ($all_search[0][1]);
    $brand = ($all_search[1][1]);
    $category = ($all_search[2][1]);
    // , $total_prod, $items_page
    // echo json_encode($category);
    // exit;

    try {
        $dao = new DAOShop();
        if (($category != null) && ($brand == null) && ($city == "0")) {
            $rdo = $dao->select_category_search($category, $total_prod, $items_page);
        } 
        else if (($category == null) && ($brand != null) && ($city == "0")) {
            $rdo = $dao->select_brand_search($brand, $total_prod, $items_page);
        } 
        else if (($category == null) && ($brand == null) && ($city != "0")) {
            $rdo = $dao->select_city_search($city, $total_prod, $items_page);
        } 
        else if (($category != null) && ($brand != null) && ($city == "0")) {
            $rdo = $dao->select_category_brand_search($category, $brand, $total_prod, $items_page);
        } 
        else if (($category == null) && ($brand != null) && ($city != "0")) {
            $rdo = $dao->select_brand_city_search($brand, $city, $total_prod, $items_page);
        } 
        else if (($category != null) && ($brand == null) && ($city != "0")) {
            $rdo = $dao->select_category_city_search($category, $city, $total_prod, $items_page);
        } 
        else if (($category != null) && ($brand != null) && ($city != "0")) {
            $rdo = $dao->select_all_search($category, $brand, $city, $total_prod, $items_page);
        } 
        else {
            $rdo = $dao->select_all_cars($_POST['total_prod'], $_POST['items_page']);
        }
    } catch (Exception $e) {
        echo json_encode("error");
        exit;
    }
    if (!$rdo) {
        echo json_encode("error");
        exit;
    } else {
        $dinfo = array();
        foreach ($rdo as $row) {
            array_push($dinfo, $row);
        }
        echo json_encode($dinfo);
    }
    break;

    case 'count_filter_search';

    $all_search = $_POST['sdata'];
    $city = ($all_search[0][1]);
    $brand = ($all_search[1][1]);
    $category = ($all_search[2][1]);
    
    // , $total_prod, $items_page
    // echo json_encode($category);
    // exit;

    try {
        $dao = new DAOShop();
        if (($category != null) && ($brand == null) && ($city == "0")) {
            $rdo = $dao->count_category_search($category);
        } 
        else if (($category == null) && ($brand != null) && ($city == "0")) {
            $rdo = $dao->count_brand_search($brand);
        } 
        else if (($category == null) && ($brand == null) && ($city != "0")) {
            $rdo = $dao->count_city_search($city);
        } 
        else if (($category != null) && ($brand != null) && ($city == "0")) {
            $rdo = $dao->count_category_brand_search($category, $brand);
        } 
        else if (($category == null) && ($brand != null) && ($city != "0")) {
            $rdo = $dao->count_brand_city_search($brand, $city);
        } 
        else if (($category != null) && ($brand == null) && ($city != "0")) {
            $rdo = $dao->count_category_city_search($category, $city);
        } 
        else if (($category != null) && ($brand != null) && ($city != "0")) {
            $rdo = $dao->count_all_search($category, $brand, $city);
        } 
    } catch (Exception $e) {
        echo json_encode("error");
        exit;
    }
    if (!$rdo) {
        echo json_encode("error");
        exit;
    } else {
        $dinfo = array();
        foreach ($rdo as $row) {
            array_push($dinfo, $row);
        }
        echo json_encode($dinfo);
    }
    break;

        case 'sumar_mas_visitados':
            // echo json_encode("hola_sumar_mas_visitados");
            // exit;
            // echo json_encode($_GET['id']);
            // exit;
                $homeQuery = new DAOShop();
                $selSlide = $homeQuery->sumar_mas_visitados_Query($_GET['id']);
                if (!empty($selSlide)) {
                    echo json_encode($selSlide);
                } else {
                    echo "error";
                }
            break;
        case 'count_cars_related':
                // echo json_encode("hola_count_cars_related");
                // exit;
                $marca = $_POST['marca'];
                $id_car =  $_POST['id_car'];
                $homeQuery = new DAOShop();
                $selSlide = $homeQuery->count_more_cars_related($marca, $id_car);
                if (!empty($selSlide)) {
                    echo json_encode($selSlide);
                } else {
                    echo "error";
                }
            break;
        
        case 'cars_related':
                $marca = $_POST['brand'];
                $loaded =  $_POST['loaded'];
                $items =  $_POST['items_num'];
                $idcar =  $_POST['id_car'];

                $homeQuery = new DAOShop();
                $selSlide = $homeQuery->select_cars_related($loaded, $marca, $items, $idcar);
                if (!empty($selSlide)) {
                    echo json_encode($selSlide);
                } else {
                    echo "error";
                }
            break;

        case 'control_likes':
           
                $token = $_POST['token'];
                $id_car = $_POST['id_car'];
        
                try {
                    // echo json_encode("eeeeeeeeeeeerror");
                    // exit;
                 
                    // error no decode token
                    $json = decode_token($token);

                    // echo json_encode($json);
                    // exit;

                    $dao = new DAOShop();
                    $rdo = $dao->select_likes($id_car, $json['username']);
                    // echo json_encode( $rdo);
                    // exit;
                } catch (Exception $e) {
                    echo json_encode("error");
                    exit;
                }
                if (!$rdo) {
                    echo json_encode("error");
                    exit;
                } else {
                    $dinfo = array();
                    foreach ($rdo as $row) {
                        array_push($dinfo, $row);
                    }
                    if (count($dinfo) === 0) {
                        $dao = new DAOShop();
                        $rdo = $dao->like($id_car, $json['username']);
                        echo json_encode("0");
                    } else {
                        $dao = new DAOShop();
                        $rdo = $dao->dislike($id_car, $json['username']);
                        echo json_encode("1");
                    }
                }
                break;
        
        case 'load_likes_user';
                try {
                    $json = decode_token($_POST['token']);
                    $dao = new DAOShop();
                    $rdo = $dao->select_load_likes($json['username']);
                } catch (Exception $e) {
                    echo json_encode("error");
                    exit;
                }
                if (!$rdo) {
                    echo json_encode("error");
                    exit;
                } else {
                    $dinfo = array();
                    foreach ($rdo as $row) {
                        array_push($dinfo, $row);
                    }
                    echo json_encode($dinfo);
                }
                break;
        
    
}
