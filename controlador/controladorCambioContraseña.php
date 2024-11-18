<?php

if(!empty($_POST["btnCambiarContraseña"])){
    $contraseñaActual = $_POST["contraseñaActual"];
    $nuevaContraseña = $_POST["nuevaContraseña"];
    $confirmarContraseña = $_POST["confirmarContraseña"];


    if(password_verify($contraseñaActual, $_SESSION["Contraseña"])){
        if($nuevaContraseña === $confirmarContraseña){
                $nuevaContraseña_encriptada = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
            if($_SESSION["IsAdmin"]){
                $conexion->query("UPDATE administrador SET contraseña = '$nuevaContraseña_encriptada' WHERE ID_Admin = '".$_SESSION['ID']."'");
                $_SESSION['Contraseña'] = $nuevaContraseña_encriptada;
            } else {
                $conexion->query("UPDATE usuario SET contraseña = '$nuevaContraseña_encriptada' WHERE ID_Usuario = '".$_SESSION['ID']."'");
                $_SESSION['Contraseña'] = $nuevaContraseña_encriptada;
            }
            echo "<div class='alert alert-success'>Contraseña cambiada exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Confirma bien la nueva contraseña.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Contraseña actual incorrecta.</div>";
    }
}
?>
