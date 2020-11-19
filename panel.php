<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Generator</title>
</head>
<body>
	<div class="panel">
	
	<h1>Bienvenido a tu panel</h1>
	<a href="index.php?accion=cerrar_sesion">Cerrar sesion de <?php echo $_SESSION['id']; ?></a>
	<br>
	<br>
            <?php 
            if (isset($_SESSION['admin'])) {
            	 echo "<h2>Sitios webs</h2>";     
	            	$cont=0;
	            	$dominios=obtener_dominios_admin();
					$arrayDatos=array();
					while($row=mysqli_fetch_array($dominios)){
						$arrayDatos[$cont] = $row;
						$cont++;
					}
					echo "<div style='display:block; width:70%;'>";
					foreach ($array as $key) {
						$id = $key['idUsuario'];
						$dominio = $key['dominio'];
						echo "<div style='display:block; border-top:1px grey solid;'>";
							echo "<h3>Id usuario: $id</h3>";
							echo "<h3>Sitio: <a href='$dominio/index.php'>$dominio </a></h3>";
							echo "<h4><a href='$dominio.zip'> Descargar web</a></h4><br>";
						echo "</div>";
					}
					echo "</div>";
            }else{
            	 echo "<form action='index.php' method='get'>
            	<input type='hidden' name='accion' value='generar'>
		       	<h2>Generar web de: <input type='text' placeholder='Nombre de la web' name='nombreWeb' required></h2>
		            <input type='submit' value='Generar web'>
		        </form>
		        <h3> $error</h3>
		        <br>
		        <br>";
	            	$cont=0;
	            	$dominios=obtener_dominios($_SESSION['id']);
					$arrayDatos=array();
					while($row=mysqli_fetch_array($dominios)){
						$arrayDatos[$cont]=$row;
						$cont++;
					}
					echo "<div style='display:block; width:70%;'>";
					foreach ($arrayDatos as $key) {
						$dominio = $key['dominio'];
						echo "<div style='display:block;'>";
							echo "<h3 style='float:left;'><a href='$dominio/index.php'> $dominio </a></h3>";
							echo "<h4 style='float:right;'><a href='$dominio.zip'> Descargar web</a></h4>";
						echo "</div>";
					}
					echo "</div>";
			}
             ?>

</div>