<?php
    include('cabecera.php');
    include('conexion.php');

    $creador=$_POST["Creador"];


    $consulta= $conexion->prepare("SELECT * FROM articulos where Creador='$creador'");
    // $consulta= $conexion->prepare("SELECT DISTINCT Categoria from articulos where Creador like '$creador'");
    $consulta->execute();
    echo json_encode($consulta->fetchAll());
    
?>