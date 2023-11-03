<?php
	$path = $_SERVER['DOCUMENT_ROOT'] . '/5-MVC/Concesionario_v3';
	include($path . "/model/connect.php");
    
	class DAOHome {

		function select_categories() {
			// echo json_encode("hola");
			$sql= "SELECT * FROM category";
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

		function select_brand() {
			// echo json_encode("holaa");
			$sql= "SELECT * FROM `brand` ORDER BY name_brand ASC LIMIT 30;";

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

		function select_type_motor() {
			$sql= "SELECT *FROM motor_type ORDER BY cod_tmotor DESC";
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

		function select_mas_visitados() {
			// echo json_encode("hola_select_mas_visitados");
			// exit;
			$sql= "SELECT m.id_car, m.contador, i.img_cars
			FROM mas_visitados m, img_cars i
			WHERE m.id_car = i.id_car
			GROUP BY m.id_car
			ORDER BY m.contador DESC";

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
	
		
	}