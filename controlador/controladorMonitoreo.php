<?php
session_start();

// Verificar si la sesión está iniciada
if (empty($_SESSION['Nombre']) && empty($_SESSION['Contraseña'])) {
    header('location:login/login.php');
    exit();
}

// Incluir el archivo de conexión a la base de datos
include "../modelo/conexion.php";

// Obtener las variables del formulario
$id_habito = isset($_GET['id_habito']) ? $_GET['id_habito'] : '';
$estadistica = isset($_GET['estadistica']) ? $_GET['estadistica'] : 'Progreso_Total';

// Consulta SQL para obtener los datos de progreso filtrados por hábito y estadística
$sql = "
    SELECT 
        u.Nombre AS Usuario, 
        h.Nombre AS Habito, 
        p.Progreso_Total, 
        p.Progreso_Mensual, 
        p.Mejor_Racha, 
        p.Racha_Actual,
        p.Ultima_Fecha
    FROM progreso p
    JOIN Usuario_Habito uh ON p.ID_Usuario_Habito = uh.ID_Usuario_Habito
    JOIN Usuario u ON uh.ID_Usuario = u.ID_Usuario
    JOIN Habito h ON uh.ID_Habito = h.ID_Habito
    WHERE h.ID_Habito = '$id_habito'
    ORDER BY p.Ultima_Fecha DESC
";

// Ejecutar la consulta
$result = $conexion->query($sql);

// Obtener los datos para la gráfica
$labels = [];
$data = [];

while ($datos = $result->fetch_object()) {
    $labels[] = $datos->Ultima_Fecha;
    $data[] = $datos->$estadistica;
}

// Incluir la vista y pasar los datos
include 'vista.php';
?>
