<?php
session_start();
if (empty($_SESSION['Nombre']) and empty($_SESSION['Contraseña'])) {
    header('location:login/login.php');
} else if ($_SESSION['IsAdmin']){
    header('location:inicioAdmin.php');
}
?>

<!-- Carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- Carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- Contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">LISTA DE HABITOS</h4>
    <?php
    include "../modelo/conexion.php";
    $nombre_categoria = $conexion->real_escape_string($_GET['nombre_categoria']);
    $id_usuario = $_SESSION['ID'];

    // Ejecutar la consulta para traer los hábitos de la categoría
    $sql = $conexion->query("
        SELECT h.ID_Habito, h.Nombre AS nombre_habito, h.Descripcion,
               (SELECT COUNT(*) 
                FROM usuario_habito uh 
                WHERE uh.ID_Habito = h.ID_Habito AND uh.ID_Usuario = '$id_usuario') AS seleccionado
        FROM habito h
        JOIN categoria c ON h.ID_Categoria = c.ID_Categoria
        WHERE c.Nombre = '$nombre_categoria'
    ");

    // Verificar si la consulta trae resultados
    if ($sql && $sql->num_rows > 0) {
        ?>
        <table class="table table-bordered table-hover col-12" id="example">
            <thead class="table-light col-12">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php
                while ($datos = $sql->fetch_object()) {
                    ?>
                    <tr>
                        <td scope="row"><?= htmlspecialchars($datos->nombre_habito) ?></td>
                        <td scope="row"><?= htmlspecialchars($datos->Descripcion) ?></td>
                        <td>
                            <?php if ($datos->seleccionado > 0): ?>
                                <!-- Mostrar mensaje si ya está seleccionado -->
                                <button class="btn btn-secondary" disabled>Ya seleccionado</button>
                            <?php else: ?>
                                <!-- Mostrar botón de selección si no está seleccionado -->
                                <form method="POST" action="../controlador/controladorSeleccionarNuevoHabito.php">
                                    <input type="hidden" name="ID_Habito" value="<?= htmlspecialchars($datos->ID_Habito) ?>">
                                    <button name="seleccionarNuevoHabito" type="submit" class="btn btn-primary">Seleccionar</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "No se encontraron hábitos para esta categoría.";
    }
    ?>

</div>
</div>
<!-- fin del contenido principal -->

<!-- Carga el footer -->
<?php require('./layout/footer.php'); ?>
