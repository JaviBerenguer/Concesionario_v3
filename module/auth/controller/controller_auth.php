<?php
//  die('hola');
//  exit;
$path = $_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3';
include($path . "/module/auth/model/DAOauth.php");
include($path . "/model/middleware_auth.php");
@session_start();
 switch ($_GET['op']) {
    case 'list':
        // die('<script>console.log("test_list");</script>'); 
        include('module/auth/view/auth.html');
        break;
    case 'test':
        echo json_encode("testttt");
        exit;
    case 'register':
            // Comprobar que la email no exista
            // echo json_encode("hola_controller_register");
            // exit;
            try {
                $daoLog = new DAOauth();
                $check = $daoLog->select_email($_POST['email_reg']);
            } catch (Exception $e) {
                echo json_encode("error");
                exit;
            }
            if ($check) {
                echo json_encode("error_email");
                exit;
            } else {
                $check_email = true;
            }

            try {
                $daoLog = new DAOauth();
                $check_username = $daoLog->select_username($_POST['username_reg']);
            } catch (Exception $e) {
                echo json_encode("error");
                exit;
            }
            if ($check_username) {
                echo json_encode("error_user");
                exit;
            } else {
                $check_usuario= true;
            }
    
            // Si no existe el email creará el usuario
            if ($check_email && $check_usuario) {
                try {
                    $daoLog = new DAOauth();
                    $rdo = $daoLog->insert_user($_POST['username_reg'], $_POST['email_reg'], $_POST['passwd1_reg']);
                } catch (Exception $e) {
                    echo json_encode("error");
                    exit;
                }
                if (!$rdo) {
                    echo json_encode("error_user");
                    exit;
                } else {
                    echo json_encode("ok");
                    exit;
                }
            } 
            break;
    
     case 'login':
            try {
              
                // echo json_encode(  $_POST['username_log']);
                // exit;
                $daoLog = new DAOauth();
                $rdo = $daoLog->select_user($_POST['username_log']);
                // echo json_encode($rdo);
                // exit;
                if ($rdo == "error_user") {
                    echo json_encode("error_user");
                    exit;
                } else {
                    if (password_verify($_POST['passwd_log'], $rdo['password'])) {
                        $token= create_token($rdo["username"]);
                        $_SESSION['username'] = $rdo["username"]; //Guardamos el usario 
                        $_SESSION['tiempo'] = time(); //Guardamos el tiempo que se logea
                        echo json_encode($token);
                        // echo json_encode($_SESSION['username']);
                        // exit;
                    } else {
                        echo json_encode("error_passwd");
                        exit;
                    }
                }
            } catch (Exception $e) {
                echo json_encode("error");
                exit;
            }
            break;
    
    case 'logout':
        // echo json_encode("hola");
        //         exit;
            unset($_SESSION['username']);
            unset($_SESSION['tiempo']);
            session_destroy();
    
            echo json_encode('Done');
            break;
            exit;
    
    case 'data_user':
            $json = decode_token($_POST['token']);
            $daoLog = new DAOauth();
            $rdo = $daoLog->select_data_user($json['username']);
            echo json_encode($rdo);
            exit;
            break;
    
    case 'actividad':
            if (!isset($_SESSION["tiempo"])) {
                echo json_encode("inactivo");
                exit();
            } else {
                if ((time() - $_SESSION["tiempo"]) >= 1800) { //1800s=30min
                    echo json_encode("inactivo");
                    exit();
                } else {
                    echo json_encode("activo");
                    exit();
                }
            }
            break;
    
    case 'controluser':
            $token_dec = decode_token($_POST['token']);
            // echo json_encode($token_dec['exp']);
            // exit();
    
            if ($token_dec['exp'] < time()) {
                echo json_encode("Wrong_User");
                exit();
            }
    
            if (isset($_SESSION['username']) && ($_SESSION['username']) == $token_dec['username']) {       
                echo json_encode("Correct_User");
                exit();
            } else {
                echo json_encode("Wrong_User");
                exit();
            }
    //         break;
    
    case 'refresh_token':
            $old_token = decode_token($_POST['token']);
            $new_token = create_token($old_token['username']);
            echo json_encode($new_token);
            break;
    
    case 'refresh_cookie':
            session_regenerate_id();
            echo json_encode("Done");
            exit;
            break;
    }
