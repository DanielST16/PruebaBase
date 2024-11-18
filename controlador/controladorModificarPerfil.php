<?php
session_start();
include "../modelo/conexion.php";

        $ID = $_POST["txtID"];

        // Validar el nombre: mínimo 3 caracteres y solo letras
        if (!empty($_POST["txtNombre"]) && preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]{3,}$/", $_POST["txtNombre"])) {
            $Nombre = $_POST["txtNombre"];
        } else {
            header('Location: ../vista/modificarPerfil.php?error=1');
            exit();
        }

        // Validar el usuario: al menos una letra, un número, sin espacios, y mínimo 3 caracteres
        if (!empty($_POST["txtUsuario"]) && preg_match("/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{3,}$/", $_POST["txtUsuario"]) && !preg_match("/\s/", $_POST["txtUsuario"])) {
            $Usuario = $_POST["txtUsuario"];
        } else {
            header('Location: ../vista/modificarPerfil.php?error=1');
            exit();
        }

        // Validar el email: debe ser un formato válido
        if (!empty($_POST["txtEmail"]) && filter_var($_POST["txtEmail"], FILTER_VALIDATE_EMAIL)) {
            $Email = $_POST["txtEmail"];
        } else {
            header('Location: ../vista/modificarPerfil.php?error=1');
            exit();
        }

        // Verificar si el usuario o email ya existen en la base de datos, excluyendo el actual
        $sqlCheck = $conexion->query("SELECT ID_Usuario FROM usuario WHERE (Usuario = '$Usuario' OR Email = '$Email') AND ID_Usuario != $ID");

        $sqlCheckAdmin = $conexion->query("SELECT ID_Admin FROM administrador WHERE (UsuarioAdmin = '$Usuario' OR Email = '$Email')");

        if ($sqlCheckAdmin->num_rows > 0 OR $sqlCheck->num_rows > 0) {
            header('Location: ../vista/modificarPerfil.php?error=2');
            exit();
        }

        // Actualizar datos
        $sql = $conexion->query("UPDATE usuario SET Usuario = '$Usuario', Nombre = '$Nombre', Email = '$Email' WHERE ID_Usuario = $ID");

        if ($sql === true) {
            $_SESSION["Usuario"] = $Usuario;
            $_SESSION["Email"] = $Email;
            $_SESSION["Nombre"] = $Nombre;
            header("location:../vista/Perfil.php?success=1");
            exit();
        
        } else { 
            header("location:../vista/Perfil.php?error=1");
            exit();
        }

?>
