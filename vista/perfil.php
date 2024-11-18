<?php
session_start();

header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");


// Verificación de la sesión (si el usuario está logueado)
if (empty($_SESSION['Nombre']) && empty($_SESSION['Contraseña'])) {
    header('Location: login/login.php');
    exit();
} else if ($_SESSION['IsAdmin']) {
    header('location:inicioAdmin.php');
}

// Incluir la conexión a la base de datos
include "../modelo/conexion.php";

// Obtener los datos del usuario logueado
$usuarioId = $_SESSION['ID'];
$query = "SELECT * FROM usuario WHERE ID_Usuario = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $usuarioId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "No se encontraron datos del usuario.";
    exit();
}
?>


<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
  <script>
    $(function notification() {
      new PNotify({
        title: "Correcto",
        type: "success",
        text: "Informacion actualizada exitosamente",
        styling: "bootstrap3"
      });
    });
  </script>
  <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
  <script>
    $(function notification() {
      new PNotify({
        title: "Error",
        type: "error",
        text: "Hubo un error al actualizar la informacion",
        styling: "bootstrap3"
      });
    });
  </script>
  <?php endif; ?>

<!-- Cargar el topbar -->
<?php require('./layout/topbar.php'); ?>

<!-- Cargar el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- Contenido principal -->
<div class="page-content">
    <h1 class="text-center font-weight-bold">Perfil de Usuario</h1>

    <!-- Tarjeta de perfil -->
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body">
            <!-- Foto de perfil -->
            <div class="text-center mb-4">
                <?php if (!empty($usuario['Foto_Perfil'])): ?>
                    <img src="<?= $usuario['Foto_Perfil'] ?>" alt="Foto de perfil" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                <?php else: ?>
                    <img src="../public/app/publico/img/user.svg" alt="Foto de perfil predeterminada" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">
                <?php endif; ?>
            </div>

            <!-- Información del usuario -->
            <h3 class="card-title text-center">Nombre: <?= htmlspecialchars($usuario['Nombre']) ?></h3>
            <p class="text-center">Correo: <?= htmlspecialchars($usuario['Email']) ?></p>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Fecha de Registro:</strong> <?= date('d/m/Y', strtotime($usuario['Fecha_Creacion_Cuenta'])) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Último Acceso:</strong> <?= date('d/m/Y H:i', strtotime($usuario['Fecha_Ultimo_Acceso'])) ?></p>
                </div>
            </div>
            <!-- Botón para modificar perfil -->
            <div class="text-center mt-4">
                <a href="modificarPerfil.php" class="btn btn-primary">Modificar Perfil</a>
            </div>
        </div>
    </div>
</div>

<!-- Fin del contenido principal -->

<!-- Cargar el footer -->
<?php require('./layout/footer.php'); ?>
