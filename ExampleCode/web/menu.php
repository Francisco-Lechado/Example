<?php
$cat="Todas";
if(isset($_GET['categoria'])){
	$cat=$_GET['categoria'];
}
?>
<!DOCTYPE html>
<script type="text/javascript" script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
<?php include "readsql.php"; ?>
<link rel="stylesheet" href="cartBtn.css">
<link rel="stylesheet" href="menu.css">


<html>
<head>
	<title>myStore</title>
</head>
<body>
	<button type="button" onclick="loadIndex()" class="hideB"><img src="images/logo.png"></button>
	<button type="button" onclick="loadCart()" class="hideB"><img id="cart" src="images/cart.jpg" style="transform: translate(750px,-140px)"></button>
	<br><br>
	<form id="Products" action="myStore.php"></form>

</body>
</html>

<script type="text/javascript">

function arrProd(){
		var cols="<?php echo prodColNumb(); ?>";
		var prod="<?php echo getProd($cat); ?>";
		var rows=prod.length/cols;
		prod=prod.split("<?php echo Splitter;?>");
		rows=prod.length/cols;
		var prods=[];
		for(var i=0; i<rows; i++){prods[i]=[];}
		for(var i=0; i< rows; i++){
			for (var x = 0; x < cols; x++) {
				prods[i][x]=prod[(i*cols)+x];
			}
		}
		return(prods);
	}

function product(prod){
	return "<button name='product' class='hideB' value='"+prod[1]+"' type='submit'> <p>"+prod[1]+"</p> <img src='images/"+prod[0]+".jpg' width=200dp></img></button>";
}

function setProducts(){
	prod=arrProd();
	tprod="<table><tr>";
	for(var i=0; i<prod.length; i++){
		tprod+="<td>"+product(prod[i])+"</td>";
		if((i+1)%7==0){tprod+="</tr><tr>"};
	}
	tprod+="</tr></table>";
	$("#Products").append(tprod);
	}

function loadIndex(){window.open("index.php","_self");}
function loadCart(){window.open("cart.php","_self");}

$(document).ready(setProducts());
</script> 