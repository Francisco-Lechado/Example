<?php 
include "readsql.php";

if(isset($_POST["compra"])){
		if(isset($_COOKIE)){
			saveOrder($_POST['nombre'], $_POST['apellidos'], $_POST['direccion'], $_POST['dni'], $_POST['telefono'], $_POST['email'], $_COOKIE['cart']);
			unset($_COOKIE['cart']);
		}
		echo("<script> window.open('index.php','_self'); </script>");
	}else{
			echo " <br><br><br><br><br><br><br>
			<center>
			<form action='buy.php' method='POST'>
				<input type='text' name='nombre' placeholder='Nombre'>
				<input type='text' name='apellidos' placeholder='Apellidos'>
				<br>
				<br>
				<input type='text' name='direccion' placeholder='Dirección'>
				<input type='text' name='dni' placeholder='DNI'>
				<br>
				<br>
				<input type='text' name='telefono' placeholder='Teléfono'>
				<input type='text' name='email' placeholder='email'>
				<br>
				<br>
				<button type='submit' name='compra'>Proceder con la compra</button>
			</form> </center>";
		}

?>