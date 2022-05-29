<?php
    include('cabecera.php');
    include('conexion.php');

    $id_categorias=$_POST["id_categorias"];
    $usuario=$_POST["usuario"];
    
    $consulta= $conexion->prepare("SELECT COUNT(*) FROM likes_dislikes where User='$usuario' && id_articulos=$id_categorias ");
    $consulta->execute();
    
    $controladorprimerlike = $consulta->fetchColumn();
    if($controladorprimerlike==0){//el usuario no a dado todavia ni like ni dislike a la publicacion concreta
        $consulta= $conexion->prepare("INSERT INTO likes_dislikes(id_articulos,color,User) VALUES($id_categorias,'like','$usuario')");
        $consulta->execute();
        $consulta= $conexion->prepare("UPDATE articulos SET like_totales=like_totales+1 where ID_articulo=$id_categorias ");
            $consulta->execute();
            $consulta= $conexion->prepare("UPDATE articulos SET actividad_total=actividad_total+1 where ID_articulo=$id_categorias ");
            $consulta->execute();         
            echo json_encode("funciona el like");
    }else{//el usuario ya dios like previamente

    
    $consultanonegativos= $conexion->prepare("SELECT dislike_totales FROM articulos where ID_articulo=$id_categorias ");
        $consultanonegativos->execute();
        $controladorr = $consultanonegativos->fetchColumn();

        $consulta= $conexion->prepare("SELECT COUNT(*) FROM likes_dislikes where User='$usuario' && color='like' && id_articulos=$id_categorias ");
        $consulta->execute();
        $controladorlike = $consulta->fetchColumn();
        if ($controladorlike > 0) {//el usuario tenia ya like puesto
            $consulta= $conexion->prepare("UPDATE articulos SET like_totales=like_totales-1 where ID_articulo=$id_categorias ");
        $consulta->execute();
        $consulta=$conexion->prepare("DELETE FROM likes_dislikes where id_articulos=$id_categorias && color='like' && User='$usuario'");
            $consulta->execute();
            $consulta= $conexion->prepare("UPDATE articulos SET actividad_total=actividad_total-1 where ID_articulo=$id_categorias ");
            $consulta->execute(); 
            echo json_encode("ya diste like"); 
        } else {//el usuario cambia de like a dislike
            $consulta=$conexion->prepare("DELETE FROM likes_dislikes where id_articulos=$id_categorias && color='dislike' && User='$usuario'");
            $consulta->execute();
            $consulta= $conexion->prepare("INSERT INTO likes_dislikes(id_articulos,color,User) VALUES($id_categorias,'like','$usuario')");
            $consulta->execute();
            if($controladorr==0){//el usuario cambia de like a dislike pero dislike esta en 0, los dislike no pueden ser negativos por lo que no se resta
            $consulta= $conexion->prepare("UPDATE articulos SET like_totales=like_totales+1 where ID_articulo=$id_categorias ");
            $consulta->execute();
            $consulta= $conexion->prepare("UPDATE articulos SET actividad_total=actividad_total+1 where ID_articulo=$id_categorias ");
            $consulta->execute();  
        }
        else{//el usuario cambia de like a dislike, y el dislike no esta en 0, osea que se resta el dislike dado previamente
            $consulta= $conexion->prepare("UPDATE articulos SET like_totales=like_totales+1 where ID_articulo=$id_categorias ");
            $consulta->execute();
            $consulta= $conexion->prepare("UPDATE articulos SET dislike_totales=dislike_totales-1 where ID_articulo=$id_categorias ");
            $consulta->execute();
        }
            echo json_encode("funciona el like");
        }

    }
?>