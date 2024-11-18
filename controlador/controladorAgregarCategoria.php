<?php
if (!empty($_POST["btnAgregar"])) {
    // Verificamos si los campos no están vacíos
    if (!empty($_POST["txtNombre"]) && !empty($_POST["txtDescripcion"]) && !empty($_POST["txtImagen"])) {
        $nombre = $_POST["txtNombre"];
        $descripcion = $_POST["txtDescripcion"];
        $imagen = $_POST["txtImagen"];

        // Verificamos si la categoría ya existe
        $sql = $conexion->query("SELECT count(*) AS 'total' FROM categoria WHERE Nombre='$nombre'");
        if ($sql->fetch_object()->total > 0) {
            // Si la categoría ya existe, mostramos el error
            ?>
            <script>
                $(function notification() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "La categoría <?=$nombre?> ya existe",
                        styling: "bootstrap3"
                    });
                });
            </script>
            <?php
        } else {
            // Si no existe, insertamos la nueva categoría
            $agregar = $conexion->query("INSERT INTO categoria (Nombre, Descripcion, Imagen) VALUES ('$nombre', '$descripcion', '$imagen')");
            if ($agregar) {
                // Si la inserción fue exitosa
                ?>
                <script>
                    $(function notification() {
                        new PNotify({
                            title: "Correcto",
                            type: "success",
                            text: "La categoría <?=$nombre?> se agregó correctamente",
                            styling: "bootstrap3"
                        });
                    });
                </script>
                <?php
            } else {
                // Si hubo un error al insertar
                ?>
                <script>
                    $(function notification() {
                        new PNotify({
                            title: "ERROR",
                            type: "error",
                            text: "La categoría <?=$nombre?> no se pudo agregar",
                            styling: "bootstrap3"
                        });
                    });
                </script>
                <?php
            }
        }
    } else {
        // Si los campos están vacíos
        ?>
        <script>
            $(function notification() {
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "Los campos están vacíos",
                    styling: "bootstrap3"
                });
            });
        </script>
        <?php
    }
}
?>

<script>
    // Recarga la página después de un tiempo
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
</script>
