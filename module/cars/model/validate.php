<?php
    function validate_license_number($license_number){
        $sql = "SELECT * FROM cars WHERE license_number='$license_number'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);
        return $res;
    }

    function validate_car_plate($car_plate){
        $sql = "SELECT * FROM cars WHERE car_plate='$car_plate'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);
        return $res;
    }

    // function validate_maricula($dni){
    //     $sql = "SELECT * FROM usuario WHERE dni='$dni'";

    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     $res = $res->num_rows;
    //     connect::close($conexion);
    //     return $res;
    // }
    
    function validate() {
        // $data = 'hola validate php';
        // die('<script>console.log('.json_encode( $_POST ) .');</script>');

        $check = true;

        $license_number = $_POST['license_number'];
        $car_plate = $_POST['car_plate'];
        $license_number = validate_license_number($license_number);
        $car_plate = validate_car_plate($car_plate);

        if($license_number !== null){
            echo '<script language="javascript">setTimeout(() => {
                toastr.error("El license_number no puede estar repetido");
            }, 1000);</script>';
            $check = false;
        }

        if($car_plate !== null){;
            echo '<script language="javascript">setTimeout(() => {
                toastr.error("La matricula no puede estar repetida");
            }, 1000);</script>';
            $check = false;
        }

        return $check;
    }
