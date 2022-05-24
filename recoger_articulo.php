<?php
    include('cabecera.php');
    include('conexion.php');

    $id=$_POST['id'];

    $consulta= $conexion->prepare("SELECT * FROM articulos WHERE ID_articulo='$id'");
    $consulta->execute();
    echo json_encode($consulta->fetchAll());
    
?>