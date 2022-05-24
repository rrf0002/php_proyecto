<?php
    include('cabecera.php');
    include('conexion.php');

    $nombre_categoria=$_POST["nombre_categoria"];


    $consulta= $conexion->prepare("SELECT * FROM articulos where Categoria='$nombre_categoria'");
    $consulta->execute();
    echo json_encode($consulta->fetchAll());
    
?>
