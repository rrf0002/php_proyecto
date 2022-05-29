<?php
    include('cabecera.php');
    include('conexion.php');

    $Creador=$_POST['Creador'];

        $consulta= $conexion->prepare("SELECT SUM(like_totales) as suma,SUM(dislike_totales) as resta FROM `articulos` where Creador='$Creador'");
        $consulta->execute();
        echo json_encode($consulta->fetchAll());
       
?>