<link rel="stylesheet" href="admin.css">
<?php
include "readsql.php";

	$login=false;
	if(isset($_POST['username'])&&isset($_POST['pass'])){
			$login=cheeckUser($_POST['username'],$_POST['pass']);
	}

	if($login){
		$orders=seeOrder();

		$table= "<table cellpadding='10'><thead><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Direccion</th><th>DNI</th><th>Teléfono</th><th>Email</th><th>Pedido</th></thead>";
		while ($row=$orders->fetch_assoc()) {
			$table.= "<tr>";
			foreach ($row as $key => $value) {
				if($key!='Pedido')
					$table.="<td>$value</td>";
				else{
					$table.="<td><table>";
					foreach (unserialize($value) as $key => $value) {
						$table.="<tr><td>$key -> $value</td>";
					}
					$table.= "</table></td>";
				}
			}
			$table.= "</tr>";	
		}
		echo "<center>".$table."</center>";
	}else{echo"<h2>Error en la identificación</h2>";}

	echo "<form action=index.php><center><button type=submit>volver</button></center><form><br><br>";

?>