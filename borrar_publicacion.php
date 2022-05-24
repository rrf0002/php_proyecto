<?php
    include('cabecera.php');
    include('conexion.php');

    $id_publicacion=$_POST["id_publicacion"];


    $consulta= $conexion->prepare("DELETE FROM 'articulos' WHERE 'ID_articulo'=$id_publicacion");
    $consulta->execute();
?>