<?php
    include('cabecera.php');
    include('conexion.php');

    $consulta= $conexion->prepare("SELECT * FROM servicios");
    $consulta->execute();
    echo json_encode($consulta->fetchAll());
?>