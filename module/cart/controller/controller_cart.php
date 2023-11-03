<?php
        $path = $_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3';
        include($path . "/module/cart/model/DAOcart.php");
        include($path . "/model/middleware_auth.php");

        switch($_GET['op']){
            case 'list';
                include("module/cart/view/cart.html");
                break;
                    
            case 'insert_cart';    
            // echo json_encode("insert");
            //         exit;
                try{
                   
                    $token = $_POST['token'];
                    $id_car = $_POST['id_car'];

                    $json = decode_token($token);
                    // echo json_encode($json['username']);
                    //     exit;
                    
                    $dao = new DAOCart();
                    $rdo = $dao->select_product($json['username'], $id_car);
                    // echo json_encode($rdo);
                    // exit;
                }catch (Exception $e){
                    echo json_encode("error");
                    exit;
                }
                $dinfo = array();
                foreach ($rdo as $row) {
                    array_push($dinfo, $row);
                }
                if(!$dinfo){
                    // $dao = new DAOCart();
                    $rdo = $dao->insert_product($json['username'], $id_car);
                    echo json_encode("insert");
                    exit;
                }
                else{
                    // $dao = new DAOCart();
                    $rdo = $dao->update_product($json['username'], $id_car);
                    echo json_encode("update");
                    exit;
                }
                break; 
                
        
            case 'delete_cart';    
                try{
                    // $token = $_POST['token'];
                    $idcar_token = $_POST['idcar_token'];
                    $json = decode_token($idcar_token[1]);
                    // echo json_encode($json['username']);
                    // exit;

                    $dao = new DAOCart();
                    $rdo = $dao->delete_cart($json['username'], $idcar_token[0]);
                }catch (Exception $e){
                    echo json_encode("error");
                    exit;
                }
                if(!$rdo){
                    echo json_encode("error");
                    exit;
                }else{
                    echo json_encode("delete");
                    exit;
                }
                break;         

            case 'load_cart';    
                try{
                    $token = $_POST['token'];
                    $json = decode_token($token);
                    
                    $dao = new DAOCart();
                    $rdo = $dao->select_user_cart($json['username']);
                }catch (Exception $e){
                    echo json_encode("error");
                    exit;
                }
                if(!$rdo){
                    echo json_encode("error");
                    exit;
                }else{
                    $dinfo = array();
                    foreach ($rdo as $row) {
                        array_push($dinfo, $row);
                    }
                    echo json_encode($dinfo);
                }
                break; 

        //     case 'update_qty';    
        //         try{
        //             $token = $_GET['user'];
        //             $secret = 'maytheforcebewithyou';
    
        //             $JWT = new JWT;
        //             $json = $JWT->decode($token, $secret);  
        //             $json = json_decode($json, TRUE);
                    
        //             $dao = new DAOCart();
        //             $rdo = $dao->update_qty($json['name'], $_GET['id'],$_GET['qty']);
        //         }catch (Exception $e){
        //             echo json_encode("error");
        //             exit;
        //         }
        //         if(!$rdo){
        //             echo json_encode("error");
        //             exit;
        //         }else{
        //             echo json_encode("update");
        //             exit;
        //         }
        //         break; 

        //     case 'checkout';    
        //         try{
        //             $token = $_GET['user'];
        //             $secret = 'maytheforcebewithyou';
    
        //             $JWT = new JWT;
        //             $json = $JWT->decode($token, $secret);  
        //             $json = json_decode($json, TRUE);
                    
        //             $dao = new DAOCart();
        //             $rdo = $dao->select_user_cart($json['name']);
        //         }catch (Exception $e){
        //             echo json_encode("error");
        //             exit;
        //         }
        //         if(!$rdo){
        //             echo json_encode("error");
        //             exit;
        //         }else{
        //             $dao = new DAOCart();
        //             $res = $dao->checkout($rdo, $json['name']);
        //             echo json_encode("checkout");
        //             exit;
        //         }
        //         break; 
                    
        //     default;
        //         include("view/inc/error404.php");
        //         break;
                
        };
