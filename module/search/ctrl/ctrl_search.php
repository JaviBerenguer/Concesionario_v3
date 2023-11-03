<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3';
include($path . "/module/search/model/DAO_search.php");

switch ($_GET['op']) {
    case 'brand_car':
        // echo json_encode("ctrl_search");
        // exit;
        try {
            $dao = new DAOSearch();
            $resultado_brands = $dao->select_brand_car();
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$resultado_brands) {
            echo json_encode("error");
            exit;
        } else {
            echo json_encode($resultado_brands);
        }
        break;

    case 'category':
            $marca_seleccionada = $_POST["marca_load_cat"];
            // echo json_encode($marca_seleccionada);
            // exit;

            $homeQuery = new DAOSearch();
            $selSlide = $homeQuery -> select_category_car_dependiente($marca_seleccionada);        
            if (!empty($selSlide)) {
                echo json_encode($selSlide);
            }
            else {
                echo "error";
            }
            break;

     case 'category_null':
        // echo json_encode("testt");
        // exit;
            $homeQuery = new DAOSearch();
            $selSlide = $homeQuery -> select_category_car_no_dependiente();
            if (!empty($selSlide)) {
                echo json_encode($selSlide);
            }
            else {
                echo "error";
            }
            break;

    case 'autocomplete':
            // echo json_encode($_POST['brand']);
            // echo json_encode($_POST['category']);
            // exit;
            try{
                $dao = new DAOSearch();
                if (!empty($_POST['brand']) && empty($_POST['category'])){
                    $resultado = $dao->select_only_brand($_POST['complete'], $_POST['brand']);
                }else if(!empty($_POST['brand']) && !empty($_POST['category'])){
                    $resultado = $dao->select_brand_category($_POST['complete'], $_POST['brand'], $_POST['category']);
                }else if(empty($_POST['brand']) && !empty($_POST['category'])){
                    $resultado = $dao->select_only_category($_POST['category'], $_POST['complete']);
                }else {
                    $resultado = $dao->select_city($_POST['complete']);
                }
            }catch (Exception $e){
                echo json_encode("catch");
                exit;
            }
            if(!$resultado){
                echo json_encode("error");
                exit;
            }else{
                $dinfo = array();
                foreach ($resultado as $row) {
                    array_push($dinfo, $row);
                }
                echo json_encode($dinfo);
            }
            break; 
    }
