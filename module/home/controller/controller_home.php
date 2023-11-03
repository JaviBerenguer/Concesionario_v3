<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3';
include($path . "/module/home/model/DAO_home.php");

switch ($_GET['op']) {
    case 'list';
        include('module/home/view/home.html');
        break;

    case 'homePageCategory';
        // echo json_encode("hola");
        // exit;

        try{
            $daohome = new DAOHome();
            $SelectCategory = $daohome->select_categories();
        } catch(Exception $e){
            echo json_encode("error");
        }

        if(!empty($SelectCategory)){
            // echo json_encode($SelectCategory); 
            echo json_encode($SelectCategory); 
        }
        else{
            echo json_encode("error");
        }
    break;

    
    case 'Carrousel_Brand';
    //   echo json_encode("hola");
        try {
            $daohome = new DAOHome();
            $SelectBrand = $daohome->select_brand();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($SelectBrand)) {
            echo json_encode($SelectBrand);
        } else {
            echo json_encode("error");
        }
        break;

    case 'homePageType';
        try {
            $daohome = new DAOHome();
            $SelectType = $daohome->select_type_motor();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($SelectType)) {
            echo json_encode($SelectType);
        } else {
            echo json_encode("error");
        }
        break;

    default;
        include("module/exceptions/views/pages/error404.php");
        break;

    case 'mas_visitados':
        try {
            $daohome = new DAOHome();
            $SelectBrand = $daohome->select_mas_visitados();
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($SelectBrand)) {
            echo json_encode($SelectBrand);
        } else {
            echo json_encode("error");
        }
        break;
}
?>