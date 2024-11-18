<?php
session_start();

if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["contraseña"])) {
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        
        // Consultar los datos del usuario
        $sql = $conexion->query("SELECT * FROM Usuario WHERE Usuario = '$usuario'");
        
        if ($datos = $sql->fetch_object()) {
            if (password_verify($contraseña, $datos->Contraseña)) {
                // Iniciar sesión
                $_SESSION["ID"] = $datos->ID_Usuario;
                $_SESSION["Usuario"] = $datos->Usuario;
                $_SESSION["Email"] = $datos->Email;
                $_SESSION["Nombre"] = $datos->Nombre;
                $_SESSION["Contraseña"] = $datos->Contraseña;
                $_SESSION["Fecha_Creacion_Cuenta"] = $datos->Fecha_Creacion_Cuenta;
                $_SESSION["Fecha_Ultimo_Acceso"] = $datos->Fecha_Ultimo_Acceso;
                $_SESSION["IsAdmin"] = $datos->IsAdmin;

                // Actualizar el último acceso
                $conexion->query("UPDATE Usuario SET Fecha_Ultimo_Acceso = NOW() WHERE Usuario = '$usuario'");

                // Mensaje de éxito
                $_SESSION["success"] = "Inicio de sesión exitoso.";
                header("location:../inicio.php");
                exit();
            } else {
                // Contraseña incorrecta
                $_SESSION["error"] = "Contraseña incorrecta.";
                header("location:../vista/login/login.php");
                exit();
            }
        } else {
            // Usuario no encontrado
            $_SESSION["error"] = "El usuario no existe.";
            header("location:../vista/login/login.php");
            exit();
        }
    } else {
        // Campos vacíos
        $_SESSION["error"] = "Los campos están vacíos.";
        header("location:../vista/login/login.php");
        exit();
    }
}
?>
