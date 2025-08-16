<?php

    session_start();

    include("../config/conexion.php");

    if(isset($_POST['email']) && isset($_POST['password'])){
        $resultado = $conexion->query("SELECT *
                                            FROM usuario
                                            WHERE email='".$_POST['email']."' AND
                                            contraseña='".sha1($_POST['password'])."' LIMIT 1")or die($conexion->error);
        if(mysqli_num_rows($resultado)> 0){
            $datos_usuario = mysqli_fetch_row($resultado);

            // ID
            $id_usuario = $datos_usuario[0];
            // NOMBRE
            $nombre = $datos_usuario[1];
            // APELLIDO
            $apellido = $datos_usuario[2];
            // EMAIL
            $email = $datos_usuario[6];
            // IMAGEN
            $imagen = $datos_usuario[8];
            // NIVEL
            $nivel = $datos_usuario[9];

            $_SESSION['login'] = array(
                'nombre' => $nombre,
                'apellido' => $apellido,
                'id_usuario' => $id_usuario,
                'email' => $email,
                'imagen' => $imagen,
                'nivel' => $nivel
            );
            header("Location: ../admin/index");
        }else{
            header("Location: ../links/login?error=Credeciales Incorrectas");
        }
    }else{
        header("Location: ../links/login");
    }
?>