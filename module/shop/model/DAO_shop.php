<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3';
include($path . "/model/connect.php");

class DAOShop
{
    function select_all_cars($total_prod, $items_page)
    {
        $sql = "SELECT c.id_car, c.id_category, m.name_model, b.name_brand, c.id_price, i.img_cars, mot.name_tmotor, c.car_plate, c.id_color, c.lat, c.lon, c.Km
        FROM car c, img_cars i, model m, motor_type mot, brand b, mas_visitados ma
        WHERE c.id_model = m.id_model  
        AND m.id_brand = b.id_brand
        AND c.id_car = i.id_car
        AND c.id_motor = mot.cod_tmotor
        AND ma.id_car = c.id_car
        GROUP BY c.id_car
        ORDER BY ma.contador DESC
        LIMIT $total_prod, $items_page
        ";
        // LIMIT $total_prod, $items_page";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }

    function count_all_cars()
    {
        $sql = "SELECT COUNT(*) as 'contador'
        FROM car c, model m, motor_type mot, brand b, mas_visitados ma
        WHERE c.id_model = m.id_model  
        AND m.id_brand = b.id_brand
        AND c.id_motor = mot.cod_tmotor
        AND ma.id_car = c.id_car;
        ";
        // LIMIT $total_prod, $items_page";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }
    
    function select_one_car($id)
    {

        // echo json_encode($id);
        $sql = "SELECT c.id_car, m.name_model, b.name_brand, c.id_price, i.img_cars, mot.name_tmotor, c.car_plate, c.id_color, c.lat, c.lon, cat.name_cat, c.city
        FROM car c, img_cars i, model m, motor_type mot, brand b, category cat
        WHERE c.id_model = m.id_model  
        AND m.id_brand = b.id_brand
        AND c.id_car = '$id'
        AND c.id_motor = mot.cod_tmotor
        AND i.id_car = c.id_car
        AND c.id_category = cat.id_cat
        GROUP BY c.id_car";


        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        // echo json_encode($res);
        connect::close($conexion);
        return $res;
    }

    function select_imgs_car($id)
    {
        $sql = "SELECT i.id_car, i.img_cars
                    FROM img_cars i, car c
                    WHERE i.id_car = '$id'
                    AND c.id_car = i.id_car";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $imgArray = array();
        if (mysqli_num_rows($res) > 0) {
            foreach ($res as $row) {
                array_push($imgArray, $row);
            }
        }
        return $imgArray;
    }


    function filters($filter, $total_prod, $items_page)
    {
        // echo json_encode($filter);
        // exit;
        //consulta anterior

        // $consulta = "select * from (SELECT c.id_car, c.car_plate, c.id_price, c.id_color, 
        // ca.name_cat, b.name_brand, mo.name_tmotor, c.id_motor, b.id_brand, c.id_category,  
        // m2.name_model, img.img_cars, c.lat, c.lon, c.Km
        //     FROM car c, category ca, brand b, motor_type mo, model m2, img_cars img
        //     WHERE ca.id_cat = c.id_category
        //     AND mo.cod_tmotor = c.id_motor
        //     AND m2.id_model = c.id_model
        //     AND img.id_car = c.id_car
        //     AND m2.id_brand = b.id_brand) subcon WHERE";

        //consulta anterior

        $consulta = "select * from (SELECT c.id_car, c.car_plate, c.id_price, c.id_color, 
        ca.name_cat, b.name_brand, mo.name_tmotor, c.id_motor, b.id_brand, c.id_category,  
        m2.name_model, img.img_cars, c.lat, c.lon, c.Km
            FROM car c, category ca, brand b, motor_type mo, model m2, img_cars img
            WHERE ca.id_cat = c.id_category
            AND mo.cod_tmotor = c.id_motor
            AND m2.id_model = c.id_model
            AND img.id_car = c.id_car
            AND m2.id_brand = b.id_brand
            GROUP BY c.id_car) subcon";
            
        for ($i=0; $i < count($filter); $i++){
            if ($i==0){
                if ($filter[$i][0] == 'ordenar'){
                    $consulta.= " ORDER BY subcon." . $filter[$i][1] . " DESC";

                }else{
                $consulta.= " WHERE subcon." . $filter[$i][0] . "=" . '"' . $filter[$i][1] . '"';
                }
            }
            else {
                if ($filter[$i][0] == 'ordenar'){
                    $consulta.= " ORDER BY subcon." . $filter[$i][1] . " DESC";

                }else{
                $consulta.= " AND subcon." . $filter[$i][0] . "=" . '"' . $filter[$i][1] . '"';}
            }        
        }
        $consulta.=" LIMIT $total_prod, $items_page ";
        // echo json_encode($consulta);
        // exit;
        $conexion = connect::con();
        $res = mysqli_query($conexion, $consulta);
      
        connect::close($conexion);
        $retrArray = array();
        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }

        // echo json_encode($retrArray);
        // exit;

        return $retrArray;
    }

    // contar coches filtro
    
//search
function filters_count($filter){

    $consulta = "select COUNT(*) AS contador from (SELECT c.id_car, c.car_plate, c.id_price, c.id_color, 
    ca.name_cat, b.name_brand, mo.name_tmotor, c.id_motor, b.id_brand, c.id_category,  
    m2.name_model, img.img_cars, c.lat, c.lon, c.Km
        FROM car c, category ca, brand b, motor_type mo, model m2, img_cars img
        WHERE ca.id_cat = c.id_category
        AND mo.cod_tmotor = c.id_motor
        AND m2.id_model = c.id_model
        AND img.id_car = c.id_car
        AND m2.id_brand = b.id_brand
        GROUP BY c.id_car) subcon";
        
    for ($i=0; $i < count($filter); $i++){
        if ($i==0){
            if ($filter[$i][0] == 'ordenar'){
                $consulta.= " ORDER BY subcon." . $filter[$i][1] . " DESC";

            }else{
            $consulta.= " WHERE subcon." . $filter[$i][0] . "=" . '"' . $filter[$i][1] . '"';
            }
        }
        else {
            if ($filter[$i][0] == 'ordenar'){
                $consulta.= " ORDER BY subcon." . $filter[$i][1] . " DESC";

            }else{
            $consulta.= " AND subcon." . $filter[$i][0] . "=" . '"' . $filter[$i][1] . '"';}
        }        
    }
// echo json_encode($consulta);
//         exit;
    $conexion = connect::con();
    $res = mysqli_query($conexion, $consulta);
  
    connect::close($conexion);
    $retrArray = array();
    if ($res->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }

    // echo json_encode($retrArray);
    // exit;

    return $retrArray;
}

// , $total_prod, $items_page
// LIMIT $total_prod, $items_page
function select_category_search($category, $total_prod, $items_page){

    $sql = "SELECT * 
    FROM car c, category ca, brand b, model m, img_cars i, motor_type mo
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    AND c.id_motor = mo.cod_tmotor
    AND i.id_car = c.id_car
    AND ca.name_cat LIKE '$category'
    GROUP BY c.id_car
    LIMIT $total_prod, $items_page";

    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function count_category_search($category){
        
   
    $sql = "SELECT COUNT(*) as 'contador'
    FROM car c, model m, motor_type mot, brand b, mas_visitados ma, category ca
    WHERE c.id_model = m.id_model  
    AND m.id_brand = b.id_brand
    AND c.id_motor = mot.cod_tmotor
    AND ma.id_car = c.id_car
    AND ca.id_cat = c.id_category
    AND ca.name_cat LIKE '$category'";

// echo json_encode($sql);
//         exit;

    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function select_brand_search($brand, $total_prod, $items_page){
    $sql = "SELECT * 
    FROM car c, category ca, brand b, model m, img_cars i, motor_type mo
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    AND c.id_motor = mo.cod_tmotor
    and b.id_brand = m.id_brand
    AND i.id_car = c.id_car
    AND b.name_brand LIKE '$brand'
    GROUP BY c.id_car
    LIMIT $total_prod, $items_page";

    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function count_brand_search($brand){
    $sql = "SELECT COUNT(*) as 'contador'
    FROM car c, category ca, brand b, model m
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    and b.id_brand = m.id_brand
    AND b.name_brand LIKE '$brand';";

// echo json_encode($sql);
//         exit;

    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function select_city_search($city, $total_prod, $items_page){
    $sql = "SELECT * 
    FROM car c, category ca, brand b, model m, img_cars i, motor_type mo
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    AND c.id_motor = mo.cod_tmotor
    and b.id_brand = m.id_brand
    AND i.id_car = c.id_car
    AND c.city LIKE '$city'
    GROUP BY c.id_car
    LIMIT $total_prod, $items_page";

    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function count_city_search($city){
    $sql = "SELECT COUNT(*)
    FROM car c, category ca, brand b, model m
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    and b.id_brand = m.id_brand
    AND c.city LIKE '$city'
    GROUP BY c.id_car;"
;


    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function select_category_brand_search($category, $brand, $total_prod, $items_page){
    $sql = "SELECT * 
    FROM car c, category ca, brand b, model m, img_cars i, motor_type mo
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    and b.id_brand = m.id_brand
    AND c.id_motor = mo.cod_tmotor
    AND i.id_car = c.id_car
    AND ca.name_cat LIKE '$category'
    AND b.name_brand LIKE '$brand'
    GROUP BY c.id_car
    LIMIT $total_prod, $items_page";

    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function count_category_brand_search($category, $brand){
    $sql = "SELECT COUNT(*)
    FROM car c, category ca, brand b, model m
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    and b.id_brand = m.id_brand
    AND ca.name_cat LIKE '$category'
    AND b.name_brand LIKE '$brand'
    GROUP BY c.id_car";
        
    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function select_brand_city_search($brand, $city, $total_prod, $items_page){
    $sql = "SELECT * 
    FROM car c, category ca, brand b, model m, img_cars i, motor_type mo
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    AND b.id_brand = m.id_brand
    AND c.id_motor = mo.cod_tmotor
    AND i.id_car = c.id_car
    AND c.city LIKE '$city'
    AND b.name_brand LIKE '$brand'
    GROUP BY c.id_car
    LIMIT $total_prod, $items_page";

    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function count_brand_city_search($brand, $city){
    $sql = "SELECT  COUNT(*)
    FROM car c, category ca, brand b, model m
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    AND b.id_brand = m.id_brand
    AND c.city LIKE '$city'
    AND b.name_brand LIKE '$brand'
    GROUP BY c.id_car";


    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function select_category_city_search($category, $city, $total_prod, $items_page){
    $sql = "SELECT * 
    FROM car c, category ca, brand b, model m, img_cars i, motor_type mo
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    AND c.id_motor = mo.cod_tmotor
    and b.id_brand = m.id_brand
    AND i.id_car = c.id_car
    AND c.city LIKE '$city'
    AND ca.name_cat LIKE '$category'
    GROUP BY c.id_car
    LIMIT $total_prod, $items_page";

    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function count_category_city_search($category, $city){
    $sql = "SELECT COUNT(*)
    FROM car c, category ca, brand b, model m
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    and b.id_brand = m.id_brand
    AND c.city LIKE '$city'
    AND ca.name_cat LIKE '$category'
    GROUP BY c.id_car";



    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
        }
    }
    return $retrArray;
}

function select_all_search($category, $brand, $city, $total_prod, $items_page){
    $sql = "SELECT * 
    FROM car c, category ca, brand b, model m, img_cars i, motor_type mo
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    AND b.id_brand = m.id_brand
    AND i.id_car = c.id_car
    AND c.id_motor = mo.cod_tmotor
    AND c.city LIKE '$city'
    AND b.name_brand LIKE '$brand'
    AND ca.name_cat LIKE '$category'
    GROUP BY c.id_car
    LIMIT $total_prod, $items_page";
//  echo json_encode($sql);
//         exit;
    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
            echo json_encode($retrArray);
        exit;
        }
    }
    return $retrArray;
}

function count_all_search($category, $brand, $city){
    $sql = "SELECT COUNT(*) 
    FROM car c, category ca, brand b, model m
    WHERE c.id_category = ca.id_cat
    AND m.id_model = c.id_model
    AND b.id_brand = m.id_brand
    AND c.city LIKE '$city'
    AND b.name_brand LIKE '$brand'
    AND ca.name_cat LIKE '$category'
    GROUP BY c.id_car";

// echo json_encode($sql);
//         exit;

    $conexion = connect::con();
    $res = mysqli_query($conexion, $sql);
    connect::close($conexion);

    $retrArray = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $retrArray[] = $row;
            echo json_encode($retrArray);
        exit;
        }
    }
    return $retrArray;
}
    function sumar_mas_visitados_Query($id_coche){
        $consulta = "UPDATE mas_visitados 
        SET contador = contador+1
        WHERE id_car = $id_coche;";
        
           $conexion = connect::con();
           $res = mysqli_query($conexion, $consulta);
         
           connect::close($conexion);
           $retrArray = array();
           if ($res->num_rows > 0) {
               while ($row = mysqli_fetch_assoc($res)) {
                   $retrArray[] = $row;
               }
           }
   
           // echo json_encode($retrArray);
           // exit;
   
           return $retrArray;
    }

    // MORE CARS RELATED
	function count_more_cars_related($marca, $id_car){
        
		$sql = "SELECT COUNT(*) AS n_prod
				FROM car c, model m, brand b
				WHERE m.id_model = c.id_model
                AND b.id_brand = m.id_brand
                AND b.name_brand LIKE '$marca'
                AND c.id_car != $id_car";
// echo json_encode($sql);
// exit;
		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
      
		$retrArray = array();
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}

	function select_cars_related($loaded, $marca, $items, $id_car){
      
		$sql = "SELECT c.id_car, c.id_category, m.name_model, b.name_brand, c.id_price, i.img_cars, mot.name_tmotor, c.car_plate, c.id_color, c.lat, c.lon, c.Km
        FROM car c, img_cars i, model m, motor_type mot, brand b, mas_visitados ma
        WHERE c.id_model = m.id_model  
        AND m.id_brand = b.id_brand
        AND c.id_car = i.id_car
        AND i.id_car = c.id_car
        AND c.id_motor = mot.cod_tmotor
        AND ma.id_car = c.id_car
        AND b.name_brand LIKE '$marca'
        AND c.id_car != $id_car
        GROUP BY c.id_car
        ORDER BY ma.contador DESC
		LIMIT $loaded, $items";

// echo json_encode($sql);
// exit;

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		
		$retrArray = array();
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}

    // LIKES
	function select_load_likes($username){
        $sql = "SELECT l.id_car FROM likes l WHERE l.id_user = (SELECT u.username FROM users u WHERE u.username = '$username')";
        // echo json_encode($sql);
        //             exit;
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        
        return $res;
    }

    function select_likes($id_car, $username){
        $sql = "SELECT l.id_car FROM likes l
				WHERE l.id_user = (SELECT u.username FROM users u WHERE u.username = '$username')
				AND l.id_car = '$id_car'";
                // echo json_encode($sql);
                // exit;
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function like($id_car, $username){
        $sql = "INSERT INTO likes (id_user, id_car) VALUES ((SELECT u.username FROM users u WHERE u.username= '$username') ,'$id_car');";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function dislike($id_car, $username){
        $sql = "DELETE FROM likes WHERE id_car='$id_car' AND id_user=(SELECT u.username FROM users u WHERE u.username= '$username')";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
    
    
}
?>