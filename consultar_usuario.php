<?php
    include('cabecera.php');
    include('conexion.php');

    $usuario=$_POST['usuario'];

    $consulta= $conexion->prepare("SELECT * FROM usuarios WHERE User='$usuario'");
    $consulta->execute();

    echo json_encode($consulta->fetchAll());
?>