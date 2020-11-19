<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Generator</title>
</head>
<body>
    <div class="form">
    <form action="index.php" method="get">
    <input type="hidden" name="accion" value="iniciar_sesion">
    <label for="correo">Correo</label>
    <input type="text" placeholder="Ingrese correo" name="correo" required>              
    <label for="contraseña">Contraseña</label>
     <input type="password" placeholder="Ingrese contraseña" required name="contra">
    <input type="submit" value="Iniciar sesion"><br>
    <a href="index.php?accion=register">Registrarse</a>
      <h3> <?php echo $error ?></h3>
     </form>

    
        