<?php
    include('cabecera.php');
    include('conexion.php');

    $creador=$_POST["nombre_categoria"];


    $consulta= $consulta= $conexion->prepare("SELECT Categoria,COUNT(Categoria) as algo,Total_post from articulos,usuarios where Creador=User && Creador='$creador' GROUP BY Categoria;");
    //SELECT Categoria,COUNT(Categoria) from articulos where Creador like 'jaime' GROUP BY Categoria;
    $consulta->execute();
    echo json_encode($consulta->fetchAll());
    
?>