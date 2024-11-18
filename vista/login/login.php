<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="../../public/Estilos/LoginStyle.css">
</head>

<body>
    <div class="wrapper">
        <form action="" class="form" method="POST">
            <h1 class="tittle">Inicio</h1>

            <!-- Mostrar mensaje de error o éxito -->
            <?php
            if (!empty($_SESSION["error"])) {
                echo "<div class='alert alert-danger'>{$_SESSION["error"]}</div>";
                unset($_SESSION["error"]); // Limpiar el mensaje después de mostrarlo
            }
            if (!empty($_SESSION["success"])) {
                echo "<div class='alert alert-success'>{$_SESSION["success"]}</div>";
                unset($_SESSION["success"]); // Limpiar el mensaje después de mostrarlo
            }
            ?>

            <div class="inp">
                <input type="text" name="usuario" class="input" placeholder="Usuario" required>
                <i class="fa-solid- fa-user"></i>
            </div>
            <div class="inp">
                <input type="password" name="contraseña" class="input" placeholder="Contraseña" required>
                <i class="fa-solid- fa-lock"></i>
            </div>
            <input type="submit" name="btningresar" value="Iniciar Sesión" class="submit" />
            <p class="footer">¿No tienes cuenta? <a href="Registro.php" class="link">Por favor, regístrate</a></p>
        </form>

        <div></div>

        <div class="banner">
            <h1 class="wel_text">BIENVENIDO</h1>
            <p class="footer">¿Eres administrador? <a href="loginAdmin/loginAdmin.php" class="link">Inicia sesión aquí</a></p>
            <p class="footer">Volver a la <a class="link" href="../../index.php">Página principal</a></p>
        </div>
    </div>
</body>

</html>
