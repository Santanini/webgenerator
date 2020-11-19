<?php
session_start();
   $error ="";
   ?>
    
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Generator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php

    if (isset($_GET['accion'])){
        $accion = $_GET['accion'];
    } else {
        $accion = 'login';
    }

    
    if (isset($_SESSION['id']) and $accion <> 'cerrar_sesion' and $accion <> 'generar') {
        $accion = 'panel';
    }
    switch ($accion) {
        case 'login':
            include('login.php');
            break;
        case 'register':
            include('register.php');
            break;
        case 'realizar_registro':
            $correo=$_GET['correo'];
            $contra1 = $_GET['contra1'];
            $contra2 =$_GET['contra2'];
            if ($contra1 <> $contra2){
                $error = "Las contraseñas no coinciden.";
               include('register.php');
            }else{
                if(existe_correo($correo)){
                    $error = "El correo que intenta registrar ya esta en uso.";
                    include('register.php');
                }else{
                    $hoy = getdate();
                    $fecha = $hoy["mday"] ."/".$hoy["mon"] ."/".$hoy["year"];
                    registrar_usuario($correo,$contra1,$fecha);
                    header('Location:index.php?accion=login');
                }
            }
            break;
        case 'iniciar_sesion': 
                $correo=$_GET['correo'];
                $contra=$_GET['contra'];
                if (iniciar_sesion($correo,$contra)) {
                    $res=obtener_usuario($correo,$contra);
                    $arrayDatos=mysqli_fetch_array($res);
                    $_SESSION['id']=$arrayDatos['idUsuario'];
                    if ($correo=='admin@server' and $contra == 'serveradmin') {
                        $_SESSION['admin']="si";
                    }                   
                    header('Location: index.php?accion=panel');
                }else {
                    $error = "El usuario no existe";
                     include('login.php');
                }
            break;
        case 'panel':
            include('panel.php');

            break;
        case 'cerrar_sesion':
            session_unset();
            session_destroy();
            header('Location:index.php?accion=login');
            break;

        case 'generar':
            $nombre = $_GET['nombreWeb'];
            $dominio = $_SESSION['id'].$nombre;
            if (existe_dominio($dominio)) {
                $error = "Ese dominio ya esta en uso";
                include('panel.php');
            }else {
                $hoy = getdate();
                $fecha = $hoy["mday"]."/".$hoy["mon"]."/".$hoy["year"];
                generar_web($_SESSION['id'],$dominio,$fecha);
                shell_exec('./wix.sh '.$dominio);
                shell_exec('zip -r '.$dominio.' '.$dominio);
                header('Location: index.php?accion=panel');
                $error ="";
            }
            
            break;
    }
?>
    </div>


    
    </div>
    </body>
     </html>

<?php

    function registrar_usuario($correo,$contra,$fecha){

        $con=mysqli_connect("localhots","adm_webgenerator","webgenerator2020","webgenerator");
            $sql="INSERT INTO usuarios(email,password,fechaRegistro) VALUES('$correo','$contra','$fecha')";
            $db = mysqli_query($con,$sql);
    }

    function existe_correo($correo){
         $con=mysqli_connect("localhots","adm_webgenerator","webgenerator2020","webgenerator");
        $sql = "SELECT * from usuarios where email = '$correo' ";
        $res = mysqli_query($con,$sql);

        
        if(mysqli_num_rows($res)>0){
    
            return true;
    
        }else{

            return false;
    
        }
        
    
    
    }
    function iniciar_sesion($correo, $contra){
       $con=mysqli_connect("localhots","adm_webgenerator","webgenerator2020","webgenerator");
        $sql = "SELECT * from usuarios where email = '$correo' and password='$contra'";
        $res = mysqli_query($con,$sql);
        if(mysqli_num_rows($res)>0){

            return true;

        }else{
            return false;

        }
        
    }
    function obtener_usuario($correo,$contra){
        $con=mysqli_connect("localhots","adm_webgenerator","webgenerator2020","webgenerator");
        $sql = "SELECT idUsuario from usuarios where email = '$correo' and password='$contra'";
        $res = mysqli_query($con,$sql);
        return $res;
    }

    function existe_dominio($dominio){
         $con=mysqli_connect("localhots","adm_webgenerator","webgenerator2020","webgenerator");
        $sql = "SELECT * from webs where dominio = '$dominio' ";
        $res = mysqli_query($con,$sql);

        
        if(mysqli_num_rows($res)>0){
    
            return true;
    
        }else{

            return false;
    
        }
    
    }
    function generar_web($idUser,$dominio,$fecha){

        $con=mysqli_connect("localhots","adm_webgenerator","webgenerator2020","webgenerator");
            $sql="INSERT INTO webs(idUsuario,dominio,fechaCreacion) VALUES('$idUser','$dominio','$fecha')";
            $db = mysqli_query($con,$sql);
    }
    function obtener_dominios($id){

    $con=mysqli_connect("localhots","adm_webgenerator","webgenerator2020","webgenerator");
    $sql = "SELECT dominio FROM webs WHERE idUsuario=$id";
    $db = mysqli_query($con,$sql);
    
    return $db;

    }
    function obtener_dominios_admin(){

    $con=mysqli_connect("localhots","adm_webgenerator","webgenerator2020","webgenerator");
    $sql = "SELECT * FROM webs";
    $db = mysqli_query($con,$sql);
    
    return $db;

    }
   
?>
