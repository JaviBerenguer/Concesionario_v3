<?php
	class connect{
		public static function con(){
			$host = 'localhost';  
    		$cars = "root";                     
    		$pass = "";                             
    		$db = "cars_2";                      
    		$port = 3306;                           
    		$tabla="car";
    		
    		$conexion = mysqli_connect($host, $cars, $pass, $db, $port);
			return $conexion;
			
		}
		public static function close($conexion){
			mysqli_close($conexion);
		}
	}