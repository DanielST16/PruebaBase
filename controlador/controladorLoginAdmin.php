<?php

session_start();

if(!empty($_POST["btningresarAdmin"])){
    if (!empty($_POST["usuario"]) and !empty($_POST["contraseña"])) {
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        
        // Consultar los datos del administrador
        $sql = $conexion->query("SELECT * FROM administrador WHERE usuarioAdmin = '$usuario'");
        
        if ($datos = $sql->fetch_object()) {
            // Verificar si la contraseña es correcta usando password_verify
            if (password_verify($contraseña, $datos->Contraseña)) {
                // Si la contraseña es correcta, iniciar sesión
                $_SESSION["ID"] = $datos->ID_Admin;
                $_SESSION["Usuario"] = $datos->UsuarioAdmin;
                $_SESSION["Email"] = $datos->Email;
                $_SESSION["Nombre"] = $datos->Nombre;
                $_SESSION["Contraseña"] = $datos->Contraseña;
                $_SESSION["IsAdmin"] = $datos->IsAdmin;

                // Redirigir al panel de administración
                header("location:../../inicioAdmin.php");
            } else {
                // Contraseña incorrecta
                echo "<div class='alert alert-danger'>Contraseña incorrecta.</div>";
            }
        } else {
            // Usuario no encontrado
            echo "<div class='alert alert-danger'>El Administrador no existe.</div>";
        }
    } else {
        // Campos vacíos
        echo "<div class='alert alert-danger'>Los Campos están vacíos.</div>";
    }
}

?>
