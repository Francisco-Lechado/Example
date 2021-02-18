<?php

define("Splitter", "#-#");

function openCon()
 {
 	$host="localhost";
	$user="root";
	$pass="";
	$db="tienda";
 	$conn = new mysqli($host, $user, $pass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function closeCon($conn)
 {
	 $conn -> close();
 }

function prodNumb(){
	$conn=openCon();
	$a=$conn->query("SELECT COUNT(ID) FROM productos");
	closeCon($conn);
	return $a->fetch_assoc()["COUNT(ID)"];
}

function prodColNumb(){
	$conn=openCon();
	$a=$conn->query("SELECT COUNT(*) AS numb FROM Information_Schema.Columns WHERE TABLE_NAME = 'productos' GROUP BY TABLE_NAME");
	closeCon($conn);
	return $a->fetch_assoc()["numb"];
}

function colNames(){
	$conn=openCon();
	$a=$conn->query("SELECT COLUMN_NAME FROM Information_Schema.Columns WHERE TABLE_NAME = 'productos'");
	$ret="";
	while ($row=$a->fetch_assoc()) {
		$ret.=$row["COLUMN_NAME"].Splitter;
	}
	$ret=substr($ret, 0,-strlen(Splitter));
	closeCon($conn);
	return $ret;
}

function getProd($class='Todas'){
	$conn=openCon();	
	if($class=='Todas'){
		$a=$conn->query("SELECT * FROM productos");
	}else{
		$a=$conn->query("SELECT * FROM productos WHERE Clase='$class'");
	}
	$ret="";
	while($row = $a->fetch_assoc()) {
		foreach ($row as $key => $value) {
			$ret.=addslashes($value).Splitter;
		}
	}  
	closeCon($conn);

	$ret=substr($ret, 0, -strlen(Splitter));
	return $ret;
}

function getProdByName($name){
	$conn=openCon();	
	$a=$conn->query("SELECT * FROM productos WHERE Nombre='".$name."'");
	
	$ret=$a->fetch_assoc();
	closeCon($conn);
	return $ret;
}

function getClases(){
	$conn=openCon();	
	$a=$conn->query("SELECT DISTINCT Clase FROM productos");

	$ret="";
	while($row = $a->fetch_assoc()){
		$ret.=$row['Clase'];
	}
	closeCon($conn);
	return $ret;
}

function saveOrder($nombre, $apellidos, $direccion, $dni, $telefono=null, $email=null, $pedido){
	$conn=openCon();	
	$a=$conn->query("INSERT INTO `pedidos`(`Nombre`, `Apellidos`, `Direccion`, `Dni`, `Telefono`, `Email`, `Pedido`) VALUES ('$nombre', '$apellidos', '$direccion', '$dni', $telefono, '$email', '$pedido')");
	closeCon($conn);
}

function seeOrder(){
	$conn=openCon();

 	$a=$conn->query("SELECT * FROM pedidos");
 	closeCon($conn);

 	return $a;
}

function cheeckUser($user,$pass){
	$conn=openCon();

	$a=$conn->query("SELECT Contraseña FROM usuarios WHERE Usuario='".$user."'");
 	closeCon($conn);

 	while ($row=$a->fetch_assoc()) {
 		if($pass==$row['Contraseña'])return true;
 	}

return false;
}

?>