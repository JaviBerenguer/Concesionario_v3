<?php
	$path = $_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3';
	include($path . "/model/connect.php");
    
	class DAOSearch {
		function select_brand_car(){
			$sql = "SELECT * FROM brand";
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            // echo json_encode($res);
            // exit;
            if (mysqli_num_rows($res) > 0) {
				while ($row = mysqli_fetch_assoc($res)) {
					$retrArray[] = $row;
				}
			}
            return $retrArray;
        }

    function select_category_car_dependiente($marca){
		// echo json_encode("hola dao");
		// echo json_encode($marca);
		// exit;
		$sql = "SELECT DISTINCT(c.name_cat)
		FROM category c, car ca, model m, brand b
		WHERE ca.id_category = c.id_cat
		AND ca.id_model = m.id_model
		AND m.id_brand = b.id_brand
		AND b.name_brand LIKE '$marca'";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
		// echo json_encode($sql);
        // exit;
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
    }
	function select_category_car_no_dependiente(){
		// echo json_encode("hola dao");
		// echo json_encode($marca);
		// exit;
		$sql = "SELECT c.name_cat
		FROM category c";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
		// echo json_encode($sql);
        // exit;
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
    }
	function select_only_brand($complete, $brand){
		// echo json_encode("hola_select_only_brand");
		// exit;
        $select="SELECT DISTINCT(ca.city)
		FROM category c, car ca, model m, brand b
		WHERE ca.id_category = c.id_cat
		AND ca.id_model = m.id_model
		AND m.id_brand = b.id_brand
		AND b.name_brand LIKE '$brand'
        AND ca.city LIKE '$complete%'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);
        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }

    function select_only_category($category, $complete){
		// echo json_encode("hola_select_only_category");
		// exit;
        $select="SELECT DISTINCT(ca.city)
		FROM category c, car ca
		WHERE ca.id_category = c.id_cat
		AND c.name_cat LIKE '$category'
        AND ca.city LIKE '$complete%'";
        
        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);
        
        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }


    function select_brand_category($complete, $brand, $category){
		// echo json_encode("hola_select_brand_category");
		// exit;
        $select="SELECT DISTINCT(ca.city)
		FROM category c, car ca, model m, brand b
		WHERE ca.id_category = c.id_cat
        AND ca.id_model = m.id_model
        AND m.id_brand = b.id_brand
		AND b.name_brand LIKE '$brand'
		AND c.name_cat LIKE '$category'
        AND ca.city LIKE '$complete%'";
        
        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);
        
        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }

    function select_city($complete){
		// echo json_encode("hola_select_city");
		// exit;
        $select="SELECT DISTINCT(ca.city)
        FROM car ca
        WHERE ca.city LIKE '$complete%'";
        
        $conexion = connect::con();
        $res = mysqli_query($conexion, $select);
        connect::close($conexion);
        
        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }
	
}
?>