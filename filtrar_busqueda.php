<?php
    include('cabecera.php');
    include('conexion.php');

    $barra_busqueda=$_POST['barra_busqueda'];
    $arr2 = str_split($barra_busqueda, 3);
    $consulta= $conexion->prepare("SELECT * FROM articulos WHERE Creador like '%$arr2[0]%' or Categoria like '%$arr2[0]%' or Titulo like '%$arr2[0]%' or Cuerpo like '%$arr2[0]%'");

    $consulta->execute();
    echo json_encode($consulta->fetchAll());
    
?>