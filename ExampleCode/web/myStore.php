<?php 
include "readsql.php";

$prod=$_GET['product'];

$quantity=0;
if (isset($_GET['quantity'])) {
	$quantity=$_GET['quantity'];
	
	if(isset($_COOKIE['cart'])){
		$cart=unserialize($_COOKIE['cart']);
		$cart[$prod]=$quantity;
		setcookie('cart',serialize($cart),time()+86400,"/");
		echo "<center><h2 id=inCart>$quantity en el carrito</h2></center>";
	}else{setcookie('cart', serialize($cart), time()+86400,"/");}
}

$prod=getProdByName($prod);

?>

<link rel="stylesheet" href="cartBtn.css">
<link rel="stylesheet" href="myStore.css">

<!DOCTYPE html>
<html>
<head>
	<title>myStore</title>
</head>
<body>

<button type="button" onclick="loadIndex()" class="hideB"><img src="images/logo.png" style="position: absolute;"></button>
<button type="button" onclick="loadCart()" class="hideB" style="margin-left: 85%"><img id="cart" src="images/cart.jpg"></button>
<br><br><br>

<h1><?php echo $prod['Nombre']; ?> </h1>
<?php if ($prod['Stock']>0) echo "<h2 style='color:#6BF820'>Disponible"; else echo "<h2 style='color:Red'> No Disponible"; ?> </h2>
<div id="price">
	<a>Precio:</a><input type="text" readonly value="<?php echo $prod["Precio"]; ?>€" style="text-align: right;"><br>
	<a>Total:</a><input type="text" readonly id="total" value="<?php echo($prod['Precio']*$quantity); ?>€" style="text-align: right;">
</div>
<img src="images/<?php echo $prod['ID'];?>.jpg" class="center" style="transform: translate(0, -2em);">

<div class="center">  
	<form action="myStore.php">
		<button type="button" onclick="inc()">+</button> 
		<input type="text" id="quantity" name="quantity" value="<?php echo($quantity)?>" readonly style="text-align: center;"> 
		<button type="button" onclick="dec()">-</button> <br> <br> 
		<button id="buy" name="product" disabled value="<?php echo($prod['Nombre'])?>" type="submit">Añadir al carrito</button>
	</form> 
</div>

<textarea readonly class="center" id="description"><?php echo $prod["Inf.Adicional"]; ?></textarea>
</body>
</html>

<script type="text/javascript" script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
<script type="text/javascript">
	function inc(){
		var val=parseInt($("#quantity").val())+1;
		if(val>"<?php echo($prod['Stock']) ?>"){alert("No hay más unidades disponibles");}else{
			$("#quantity").val(val);
			$("#total").val((val*"<?php echo $prod['Precio']; ?>").toFixed(2)+"€");
			document.getElementById("buy").disabled=false;
		}
	}

	function dec(){
		var val=parseInt($("#quantity").val())-1;
		if(val>=0){$("#quantity").val(val);}
		$("#total").val((val*"<?php echo $prod['Precio']; ?>").toFixed(2)+"€");
		if(val==0){document.getElementById("buy").disabled=true;}
	}

	function loadIndex(){window.open("index.php","_self");}
	function loadCart(){window.open("cart.php","_self");}
</script>