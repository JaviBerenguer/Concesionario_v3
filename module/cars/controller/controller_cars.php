<?php


    // include ("module/cars/model/DAOcars.php");

    // $path = $_SERVER['DOCUMENT_ROOT'].'/5-MVC/8_MVC_CRUD/';
    // include($path."module/cars/model/DAOcars.php");

    include("C:/xampp/htdocs/5-MVC/8_MVC_CRUD/module/cars/model/DAOcars.php");
    
    
    switch($_GET['op']){
        case 'list';
            // $data = 'hola crtl cars';
            // die('<script>console.log('.json_encode( $data ) .');</script>');
              
            try{
                $daocars = new DAOcars();
            	$rdo = $daocars->select_all_cars();
                //die('<script>console.log('.json_encode( $rdo->num_rows ) .');</script>');
            }catch (Exception $e){
                $callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            if(!$rdo){
    			$callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
    		}else{
                include("module/cars/view/list_cars.php");
    		}
            break;
            
        case 'create';
        // no se hacer die del formulario
            // $data = 'hola crtl cars create';
            // echo('<script>console.log('.json_encode( $data ) .');</script>');
            // echo('<script>console.log('.json_encode( $_POST ) .');</script>');
            include("module/cars/model/validate.php");
            
            $check = true;
            
            if (isset($_POST['create'])){
                // $data = 'hola create post cars'
                // die('<script>console.log('.json_encode( "hola" ) .');</script>');
                // die('<script>console.log('.json_encode( $_POST ) .');</script>');
                // die('<script>console.log('.json_encode( "creilla" ) .');</script>');
                $check=validate();
                // die('<script>console.log('.json_encode( $check ) .');</script>');

                if ($check){
                    // die('<script>console.log('.json_encode( "hola" ) .');</script>');
                    
                    try{
                        $daocars = new DAOcars();
    		            $rdo = $daocars->insert_cars($_POST);
                        // die('<script>console.log('.json_encode( $rdo ) .');</script>');
                    }catch (Exception $e){
                        $callback = 'index.php?page=503';
        			    die('<script>window.location.href="'.$callback .'";</script>');
                    }
                    
		            if($rdo){
                        echo '<script language="javascript">setTimeout(() => {
                            toastr.success("Creado en la base de datos correctamente");
                        }, 1000);</script>';
                        echo '<script language="javascript">setTimeout(() => {
                            window.location.href="index.php?page=controller_cars&op=list";
                        }, 2000);</script>';
            		}else{
            			$callback = 'index.php?page=503';
    			        die('<script>window.location.href="'.$callback .'";</script>');
            		}
                }
            }
            include("module/cars/view/create_cars.php");
            break;
            
        case 'update';
            include("module/cars/model/validate.php");
            $check = true;
            
            if (isset($_POST['update'])){
                // $data = 'hola update post cars';
                // die('<script>console.log('.json_encode( $data ) .');</script>');
                $check=validate();
                // die('<script>console.log('.json_encode( $check ) .');</script>');
                
                if ($check){
                    //die('<script>console.log('.json_encode( $_POST ) .');</script>');
                    try{
                        $daocars = new DAOcars();
    		            $rdo = $daocars->update_cars($_POST);
                        //die('<script>console.log('.json_encode( $rdo ) .');</script>');
                    }catch (Exception $e){
                        $callback = 'index.php?page=503';
        			    die('<script>window.location.href="'.$callback .'";</script>');
                    }
                    
		            if($rdo){
            			echo '<script language="javascript">setTimeout(() => {
                            toastr.success("Modificado en la base de datos correctamente");
                        }, 1000);</script>';
                        echo '<script language="javascript">setTimeout(() => {
                            window.location.href="index.php?page=controller_cars&op=list";
                        }, 2000);</script>';
            		}else{
            			$callback = 'index.php?page=503';
    			        die('<script>window.location.href="'.$callback .'";</script>');
            		}
                }else{
                    echo '<script language="javascript">setTimeout(() => {
                        window.location.href="index.php?page=controller_cars&op=list";
                    }, 2000);</script>';
                }
            }
            
            try{
                $daocars = new DAOcars();
            	$rdo = $daocars->select_cars($_GET['id']);
            	$cars=get_object_vars($rdo);
            }catch (Exception $e){
                $callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            if(!$rdo){
    			$callback = 'index.php?page=503';
    			die('<script>window.location.href="'.$callback .'";</script>');
    		}else{
        	    include("module/cars/view/update_cars.php");
    		}
            break;
            
        case 'read';
            // $data = 'hola crtl cars read';
            // die('<script>console.log('.json_encode( $data ) .');</script>');
            // die('<script>console.log('.json_encode( $_GET['id'] ) .');</script>');

            try{
                $daocars = new DAOcars();
            	$rdo = $daocars->select_cars($_GET['id']);
            	$cars=get_object_vars($rdo);
                //die('<script>console.log('.json_encode( $cars ) .');</script>');
            }catch (Exception $e){
                $callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
            }
            if(!$rdo){
    			$callback = 'index.php?page=503';
    			die('<script>window.location.href="'.$callback .'";</script>');
    		}else{
                include("module/cars/view/read_cars.php");
    		}
            break;
            
        case 'delete';
            // $data = 'hola crtl cars delete';
            // die('<script>console.log('.json_encode( $data ) .');</script>');
            // die('<script>console.log('.json_encode( $_GET['id'] ) .');</script>');

            if (isset($_POST['delete'])){
                //  die('<script>console.log('.json_encode( $_GET['id'] ) .');</script>');
                try{
                    $daocars = new DAOcars();
                	$rdo = $daocars->delete_cars($_GET['id']);
                }catch (Exception $e){
                    $callback = 'index.php?page=503';
    			    die('<script>window.location.href="'.$callback .'";</script>');
                }
            	if($rdo){
                    echo '<script language="javascript">setTimeout(() => {
                        toastr.success("Borrado en la base de datos correctamente");
                    }, 1000);</script>';
                    echo '<script language="javascript">setTimeout(() => {
                        window.location.href="index.php?page=controller_cars&op=list";
                    }, 2000);</script>';
        		}else{
        			$callback = 'index.php?page=503';
			        die('<script>window.location.href="'.$callback .'";</script>');
        		}
            }
            
            include("module/cars/view/delete_cars.php");
            break;
            
        case 'read_modal';
    
                // die('<script>console.log('.json_encode( "hola" ) .');</script>');

                try{
                    $dao_cars = new DAOcars();
                    $rdo = $dao_cars -> select_cars($_GET['modal']);
                }catch (Exception $e){
                    echo json_encode("error");
                    exit;
                }
                if(!$rdo){
                    echo json_encode("error");
                    exit;
                }else{
                    $car = get_object_vars($rdo);
                    echo json_encode($car);
                    exit;
                }
                break;

        // case 'read_modal':
        //     //echo $_GET["modal"]; 
        //     //exit;

        //     try{
        //         $daocar = new DAOcars();
        //     	$rdo = $daocar->select_cars($_GET['modal']);
        //     }catch (Exception $e){
        //         echo json_encode("error");
        //         exit;
        //     }
        //     if(!$rdo){
    	// 		echo json_encode("error");
        //         exit;
    	// 	}else{
    	// 	    $car=get_object_vars($rdo);
        //         echo json_encode($car);
        //         //echo json_encode("error");
        //         exit;
    	// 	}
        //     break;

            



        default;
            include("view/inc/error404.php");
            break;
    
    }