<?php
session_start();
include "../modelo/conexion.php";

// Verificar si el usuario está autenticado
if (empty($_SESSION['ID'])) {
    header('location:login/login.php');
    exit;
}

// Verificar si se ha enviado el ID del hábito
$ID_Habito = $_POST['ID_Habito'];
$ID_Usuario = $_SESSION['ID'];

// Insertar el hábito seleccionado en la tabla Usuario_Habito
$sql_insert = $conexion->query("INSERT INTO Usuario_Habito (ID_Usuario, ID_Habito) VALUES ($ID_Usuario, $ID_Habito)");
// Proporcionar un enlace para regresar a la página de selección
header("location:../vista/inicio.php?success=1");
?>
