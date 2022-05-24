<?php
    include('cabecera.php');
    include('conexion.php');

   
        $id_categorias=$_POST["id_categorias"];
        $usuario=$_POST["usuario"];

        $consulta= $conexion->prepare("SELECT COUNT(*) FROM likes_dislikes where User='$usuario' && id_articulos=$id_categorias ");
    $consulta->execute();
    $controladorprimerlike = $consulta->fetchColumn();
    if($controladorprimerlike==0){
        $consulta= $conexion->prepare("INSERT INTO likes_dislikes(id_articulos,color,User) VALUES($id_categorias,'dislike','$usuario')");
        $consulta->execute();
        $consulta= $conexion->prepare("UPDATE articulos SET dislike_totales=dislike_totales+1 where ID_articulo=$id_categorias ");
            $consulta->execute();
            echo json_encode("funciona");
    }else{


        $consultanonegativos= $conexion->prepare("SELECT like_totales FROM articulos where ID_articulo=$id_categorias ");
        $consultanonegativos->execute();
        $controladorr = $consultanonegativos->fetchColumn();

        $consulta= $conexion->prepare("SELECT COUNT(*) FROM likes_dislikes where User='$usuario' && color='dislike' && id_articulos=$id_categorias ");
        $consulta->execute();
        $controladorlike = $consulta->fetchColumn();
        if ($controladorlike > 0) {
            $consulta= $conexion->prepare("UPDATE articulos SET dislike_totales=dislike_totales-1 where ID_articulo=$id_categorias ");
        $consulta->execute();
        $consulta=$conexion->prepare("DELETE FROM likes_dislikes where id_articulos=$id_categorias && color='dislike' && User='$usuario'");
            $consulta->execute();
            echo json_encode("ya diste dislike"); 
        } else {
        $consulta=$conexion->prepare("DELETE FROM likes_dislikes where id_articulos=$id_categorias && color='like' && User='$usuario'");
        $consulta->execute();
        $consulta= $conexion->prepare("INSERT INTO likes_dislikes(id_articulos,color,User) VALUES($id_categorias,'dislike','$usuario')");
        $consulta->execute();
        
        if($controladorr==0){
            $consulta= $conexion->prepare("UPDATE articulos SET dislike_totales=dislike_totales+1 where ID_articulo=$id_categorias ");
        $consulta->execute();
        }
        else{
            $consulta= $conexion->prepare("UPDATE articulos SET dislike_totales=dislike_totales+1 where ID_articulo=$id_categorias ");
        $consulta->execute();
        $consulta= $conexion->prepare("UPDATE articulos SET like_totales=like_totales-1 where ID_articulo=$id_categorias ");
        $consulta->execute();
    }
        echo json_encode("funciona");
        }
    }    
?>