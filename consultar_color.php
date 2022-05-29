<?php
    include('cabecera.php');
    include('conexion.php');

    $usuario=$_POST["usuario"];
    $id=$_POST["id"];
        $consulta= $conexion->prepare("SELECT COUNT(*) FROM `likes_dislikes` where User='$usuario' && id_articulos=$id && color='like'");
        $consulta->execute();
        $controladorlike = $consulta->fetchColumn();
        $consulta= $conexion->prepare("SELECT COUNT(*) FROM `likes_dislikes` where User='$usuario' && id_articulos=$id && color='dislike'");
        $consulta->execute();
        $controladordislike = $consulta->fetchColumn();
    if($controladorlike==1){
        echo json_encode("verde");
    }
    if($controladorlike==0 && $controladordislike==0){
        echo json_encode("ninguno");
    }
    if($controladordislike==1){
        echo json_encode("rojo");
    }
        
        
    
?>