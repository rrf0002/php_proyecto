<?php
    include('cabecera.php');
    include('conexion.php');




    $consulta= $consulta= $conexion->prepare("SELECT COUNT(Categoria) as contar from articulos where Creador like 'jaime'");
    //SELECT Categoria,COUNT(Categoria) from articulos where Creador like 'jaime' GROUP BY Categoria;
    $consulta->execute();
    echo json_encode($consulta->fetchAll());
    
?>