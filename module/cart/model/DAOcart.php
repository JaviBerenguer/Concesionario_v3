<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3';
include($path . "/model/connect.php");

class DAOCart{

    function select_product($user, $id){
        $sql = "SELECT * FROM cart WHERE user='$user' AND codigo_producto='$id'";
        $conexion = connect::con();
        // echo json_encode($sql);
        // exit;
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function insert_product($user, $id){
        $sql = "INSERT INTO cart (user, codigo_producto, qty) VALUES ('$user','$id', '1')";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function update_product($user, $id){
        $sql = "UPDATE cart SET qty = qty+1 WHERE user='$user' AND codigo_producto='$id'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_user_cart($user){
        $sql = "        SELECT c.id_car, c.id_category, m.name_model, b.name_brand, c.id_price, i.img_cars, mot.name_tmotor, c.car_plate, c.id_color, c.lat, c.lon, c.Km, ca.qty, ca.user
        FROM car c, img_cars i, model m, motor_type mot, brand b, mas_visitados ma, cart ca
        WHERE c.id_model = m.id_model  
        AND m.id_brand = b.id_brand
        AND c.id_car = i.id_car
        AND c.id_motor = mot.cod_tmotor
        AND ma.id_car = c.id_car
        AND c.id_car = ca.codigo_producto
        AND ca.user = '$user'
        GROUP BY c.id_car";
        //   echo json_encode($sql);
        //   exit;
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        // echo json_encode($res);
        // exit;
        connect::close($conexion);
        return $res;
    }

    // function update_qty($user, $id, $qty){
    //     $sql = "UPDATE cart SET qty = $qty WHERE user='$user' AND codigo_producto='$id'";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     return $res;
    // }
    
    function delete_cart($user, $id){
        $sql = "DELETE FROM cart WHERE user='$user' AND codigo_producto='$id'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    // function checkout($data, $user){
    //     $name = md5($user);
    //     $date = date("Ymd");
    //     foreach($data as $fila){
    //         $cod_ped = $user;
    //         $cod_prod = $fila["codigo_producto"];
    //         $talla = $fila["talla"];
    //         $cantidad = $fila["qty"];
    //         $precio = $fila["precio"];
    //         $total_precio = $fila["precio"]*$fila["qty"];

    //         $sql = "INSERT INTO `pedidos`(`cod_ped`, `user`, `cod_prod`, `talla`, `cantidad`, `precio`, `total_precio`, `fecha`) 
    //                 VALUES ('$cod_ped','$user','$cod_prod','$talla','$cantidad','$precio','$total_precio','$date')";
    //         $conexion = connect::con();
    //         $res = mysqli_query($conexion, $sql);
    //         connect::close($conexion); 
    //     }
    //     return $res;
    // }

}

?>