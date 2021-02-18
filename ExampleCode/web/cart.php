<?php 
include "readsql.php";
if(isset($_COOKIE['cart'])){
	$cart=unserialize($_COOKIE['cart']);

		if(isset($_POST['eliminar'])){
			$p=$_POST['eliminar'];
			unset($cart[$p]);
			setcookie('cart',serialize($cart),time()+86400,"/");
			if($cart==null){unset($_COOKIE['cart']);}
		}
	}
?>

<link rel="stylesheet" href="cart.css">
<link rel="stylesheet" href="cartBtn.css">

<!DOCTYPE html>
<html>
<head>
	<title>myStore</title>
</head>
<body>

<button type="button" onclick="loadIndex()" class="hideB"><img src="images/logo.png"></button>

<?php if(isset($_COOKIE['cart'])){
	echo "<div id='cartList'>";
		echo "<form method='POST' action='cart.php'><table cellpadding='10'>";
			$total=0;
			foreach($cart as $name => $quantity){
				$prod=getProdByName($name);
				echo "<tr><td>$name <br> <img src='images/".$prod['ID'].".jpg'> </td><td>$quantity x ".$prod['Precio']." € </td>
					<td><button type='submit' name='eliminar' value='".$prod['Nombre']."'>Eliminar</button></td></tr>";
				$total+=$prod['Precio']*$quantity;
			}
		echo "<tr><td>Total:</td><td>".$total." €</td></tr></table></form>";
	echo "</div> <br>";

	echo "<form action='buy.php'> <button type='submit' style='margin-left: 58%'>comprar</button><form>";
} else{
	echo "<p style='text-align: center;'><b>No hay productos seleccionados</b> <button type='button' onclick='loadIndex()'>Volver</button></p>";
}?>



<script type="text/javascript" script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
<script type="text/javascript">
	function loadIndex(){window.open("index.php","_self");}
</script>