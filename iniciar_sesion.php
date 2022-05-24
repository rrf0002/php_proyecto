<?php
    include('cabecera.php');
    include('conexion.php');

    $usuario=$_POST["usuario"];
    $contra=$_POST["contra"];
    $encontrado=false;

    if($usuario!="" && $contra!=""){
        $consulta=("SELECT * FROM usuarios");
        foreach ($conexion->query($consulta) as $dato) {
            if($dato['User']==$usuario && $dato['Contra']==$contra){
                echo json_encode("Correcto");
                $encontrado=true;
            }
        }
    }
    if($encontrado==false){
        echo json_encode("Incorrecto");
    }
?>