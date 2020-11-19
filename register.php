<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Generator</title>
</head>
<body>  
        <form action="index.php" method="get">
            <input type="hidden" name="accion" value="realizar_registro">
            <label for="correo">Correo</label>
            <input type="text" placeholder="Ingrese correo" required name="correo">
            <label for="contraseña">Contraseña</label>
            <input type="password" placeholder="Ingrese contraseña" required name="contra1">
            <label for="contraseña">Repetir Contraseña</label>
            <input type="password" placeholder="Ingrese contraseña" required name="contra2">
            <input type="submit" value="Registrarse">
            <h3> <?php echo $error ?></h3> 
            <a href="index.php?accion=login">Iniciar sesion</a> 
        </form>


