<?php
    include('cabecera.php');
    include('conexion.php');

    $id=$_POST['id'];

        $consulta= $conexion->prepare("DELETE FROM `articulos` where ID_articulo=$id ");
        $consulta->execute();
        
       
?>