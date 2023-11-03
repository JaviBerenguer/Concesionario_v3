<?php
    // include("model/connect.php");
	// $path = $_SERVER['DOCUMENT_ROOT'].'/5-MVC/8_MVC_CRUD/';
    // include($path."model/connect.php");

	include("C:/xampp/htdocs/5-MVC/8_MVC_CRUD/model/connect.php");
	
	
    
	class DAOcars{
		function insert_cars($datos){
			// die('<script>console.log('.json_encode( "hola" ) .');</script>');

        	$license_number =$datos['license_number'];
        	$brand=$datos['brand'];
        	$model=$datos['model'];
        	$car_plate=$datos['car_plate'];
        	$km=$datos['km'];
        	$category=$datos['category'];
        	$type=$datos['type'];
			$comments=$datos['comments'];
			$discharge_date=$datos['discharge_date'];
			$color=$datos['color'];
			$extras=$datos['extras'];
			$car_image=$datos['car_image'];
			$price=$datos['price'];
			$doors=$datos['doors'];
			$city=$datos['city'];
			$lat=$datos['lat'];
			$lng=$datos['lng'];

        	// foreach ($datos['idioma'] as $indice) {
        	//     $language=$language."$indice:";
        	// }
        	// foreach ($datos['aficion'] as $indice) {
        	//     $hobby=$hobby."$indice:";
        	// }
        	$sql = "INSERT INTO cars (license_number, brand, model, car_plate, km, category, type, comments, discharge_date, color, extras, car_image, price, doors, city, lat, lng)"
        		. "VALUES ('$license_number', '$brand', '$model', '$car_plate', '$km', '$category', '$type', '$comments', '$discharge_date', '$color', '$extras', '$car_image', '$price', '$doors', '$city', '$lat', '$lng')";
            
			// die('<script>console.log('.json_encode( $sql ) .');</script>');
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
			return $res;
		}
		
		function select_all_cars(){
			// $data = 'hola DAO select_all_cars';
            // die('<script>console.log('.json_encode( $data ) .');</script>');
			$sql = "SELECT * FROM cars ORDER BY id ASC";
			
			$conexion = connect::con();
			
            $res = mysqli_query($conexion, $sql);
			connect::close($conexion);
            return $res;
		}
		
		function select_cars($id){
			// $data = 'hola DAO select_cars';
            // die('<script>console.log('.json_encode( $data ) .');</script>');
			$sql = "SELECT * FROM cars WHERE id='$id'";
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql)->fetch_object();
            connect::close($conexion);
            return $res;
		}
		
		function update_cars($datos){
			//die('<script>console.log('.json_encode( $datos ) .');</script>');
			$cars=$datos['usuario'];
        	$passwd=$datos['pass'];
        	$name=$datos['nombre'];
        	$dni=$datos['DNI'];
        	$sex=$datos['sexo'];
        	$birthdate=$datos['fecha_nacimiento'];
        	$age=$datos['edad'];
        	$country=$datos['pais'];
        	// foreach ($datos['idioma'] as $indice) {
        	//     $language=$language."$indice:";
        	// }
        	$comment=$datos['observaciones'];
        	// foreach ($datos['aficion'] as $indice) {
        	//     $hobby=$hobby."$indice:";
        	// }
        	
        	$sql = " UPDATE usuario SET pass='$passwd', name='$name', dni='$dni', sex='$sex', birthdate='$birthdate', age='$age',"
        		. " country='$country', WHERE cars='$cars'";
            
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
			return $res;
		}
		
		function delete_cars($id){
			$sql = "DELETE FROM cars WHERE id='$id'";
			
			$conexion = connect::con();
			// die('<script>console.log('.json_encode( 'hola') .');</script>');
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
		}
	}