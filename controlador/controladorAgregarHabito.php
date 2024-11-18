<?php
if (!empty($_POST["btnAgregar"])) {
    if (!empty($_POST["txtNombre"]) && !empty($_POST["txtDescripcion"]) && !empty($_POST["selectCategoria"])) {
        $nombre = $_POST["txtNombre"];
        $descripcion = $_POST["txtDescripcion"];
        $categoria = $_POST["selectCategoria"];

        // Verificar si el hábito ya existe
        $sql = $conexion->query("SELECT COUNT(*) AS 'total' FROM habito WHERE Nombre='$nombre'");
        if ($sql->fetch_object()->total > 0) { ?>
            <script>
                $(function notification() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El hábito '<?=$nombre?>' ya existe",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php } else {
            // Insertar el hábito con la categoría seleccionada
            $agregar = $conexion->query("INSERT INTO habito (Nombre, Descripcion, ID_Categoria) VALUES ('$nombre', '$descripcion', '$categoria')");
            if ($agregar == true) { ?>
                <script>
                    $(function notification() {
                        new PNotify({
                            title: "Correcto",
                            type: "success",
                            text: "El hábito '<?=$nombre?>' se agregó correctamente",
                            styling: "bootstrap3"
                        });
                    });
                </script>
            <?php } else { ?>
                <script>
                    $(function notification() {
                        new PNotify({
                            title: "ERROR",
                            type: "error",
                            text: "El hábito '<?=$nombre?>' no se pudo agregar",
                            styling: "bootstrap3"
                        });
                    });
                </script>
            <?php }
        }
    } else { ?>
        <script>
            $(function notification() {
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "Todos los campos son obligatorios",
                    styling: "bootstrap3"
                });
            });
        </script>
    <?php } ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
<?php }
?>
