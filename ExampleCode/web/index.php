<!DOCTYPE html>
<link rel="stylesheet" href="index.css">
<html>
<head>
	<title>myStore</title>
</head>
<body>
	<center>
	<h1>CATEGORIAS</h1>
	</center>
	<form action="login.php"><button id="login" type="submit">Iniciar sesion</button></form>
	<center>
	<form action="menu.php" method="get">
		<?php
		include "readsql.php";
		$clases= getClases();
		$clases= preg_split('/(?=[A-Z])/', $clases);
		echo "<button type='submit' value='Todas' name='categoria'><h2>Todas</h2><img src='images/Todas.jpg'></button>";
		for ($i=1; $i < count($clases); $i++) { 
			echo "<button type='submit' value=$clases[$i] name='categoria'><h2>$clases[$i]</h2><img src='images/$clases[$i].jpg'></button>";
		}
		?>
	</form>
	</center>

</body>
</html>