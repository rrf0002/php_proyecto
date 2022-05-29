<?php
    include('cabecera.php');
    include('conexion.php');

    $creador=$_POST["creador"];

        $consulta= $conexion->prepare("SELECT * FROM `articulos`,`likes_dislikes` where User='$creador' && id_articulos=ID_articulo ");
        $consulta->execute();
        echo json_encode($consulta->fetchAll());
    
?>