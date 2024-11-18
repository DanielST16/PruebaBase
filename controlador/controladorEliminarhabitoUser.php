<?php
session_start();
include "../modelo/conexion.php";

if (isset($_GET['ID_Usuario_Habito'])) {
    $ID_Usuario_Habito = $_GET['ID_Usuario_Habito'];

    $sql_delete_usuario_habito = "DELETE FROM Usuario_Habito WHERE ID_Usuario_Habito = '$ID_Usuario_Habito'";
    $resultado = $conexion->query($sql_delete_usuario_habito);

    if ($resultado) {
        header('Location: ../vista/eliminarHabito.php?success=1');
    } else {
        header('Location: ../vista/eliminarHabito.php?error=1');
    }
} else {
    header('Location: ../vista/eliminarHabito.php?error=1');
}
?>
