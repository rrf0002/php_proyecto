<?php

include("cabecera.php");
include("Conexion.php"); 
$consulta= $conexion->prepare("UPDATE usuarios SET Total_post=Total_post+1 where User='ruben' ");
            $consulta->execute();
$filename        = $_FILES['subir_archivo']['name'];
$sourceFoto      = $_FILES['subir_archivo']['tmp_name'];

date_default_timezone_set("Europe/Madrid");
setlocale(LC_ALL,"es_ES");
$fecha_imagen   = date("d/m/Y h:i A");

$logitudPass    = 15;
$newNameFoto    = substr( md5(microtime()), 1, $logitudPass);

$explode        = explode('.', $filename);
$extension_foto = array_pop($explode);
$nuevoNameFoto  = 'img-'.$_POST["usuario"].$newNameFoto.'.'.$extension_foto;

echo json_encode($nuevoNameFoto);

//Verificando si existe el directorio
$dirLocal = "C:/Users/Usuario/pruebas/src/Prueba2/upload/";
if (!file_exists($dirLocal)) {
    mkdir($dirLocal, 0777, true);
}

$miDir         = opendir($dirLocal); //Habro el directorio
$imagenCliente = $dirLocal.'/'.$nuevoNameFoto;

if(move_uploaded_file($sourceFoto, $imagenCliente)){



}

?>