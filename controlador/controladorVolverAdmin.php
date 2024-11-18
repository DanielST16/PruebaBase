<?php
// Archivo de conexión
include "../modelo/conexion.php";

// Obtener el ID del usuario a transferir
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Obtener los datos del usuario
    $sql = $conexion->query("SELECT * FROM Usuario WHERE ID_Usuario = $id_usuario");

    if ($sql->num_rows > 0) {
        // Obtener el objeto de los datos del usuario
        $usuario = $sql->fetch_object();

        // Insertar el usuario en la tabla Administrador
        $insertSql = "INSERT INTO Administrador (UsuarioAdmin, Nombre, Email, Contraseña) 
                      VALUES ('{$usuario->Usuario}', '{$usuario->Nombre}', '{$usuario->Email}', '{$usuario->Contraseña}')";
        
        if ($conexion->query($insertSql)) {
            // Si la inserción es exitosa, eliminamos al usuario de la tabla Usuario
            $deleteSql = "DELETE FROM Usuario WHERE ID_Usuario = $id_usuario";
            if ($conexion->query($deleteSql)) {
                header('Location: ../vista/inicioAdmin.php?success=1');
            } else {
                echo "<script>alert('Error al eliminar al usuario de la tabla Usuario');</script>";
            }
        } else {
            echo "<script>alert('Error al transferir el usuario a la tabla Administrador');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado');</script>";
    }
} else {
    echo "<script>alert('ID de usuario no especificado');</script>";
}
exit();
?>
