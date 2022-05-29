<?php
    include('cabecera.php');
    include('conexion.php');

    $Creador=$_POST["nombre_categoria"];

        $consulta= $conexion->prepare("SELECT COUNT(Categoria) from articulos where Creador='$Creador'");
        $consulta->execute();
        echo json_encode($consulta->fetchAll());
    
?>