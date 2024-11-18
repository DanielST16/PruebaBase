<?php
if (!empty($_POST["btnModificar"])) {
    if (!empty($_POST["txtNombre"]) and !empty($_POST["txtDescripcion"])) {
        $nombre = $_POST["txtNombre"];
        $descripcion = $_POST["txtDescripcion"];
        $ID_Categoria = $_POST["txtID_Categoria"];
        $sql = $conexion->query("select count(*) as 'total' from categoria where Nombre='$nombre' and ID_Categoria!=$ID_Categoria");
        if ($sql->fetch_object()->total > 0) { ?>
            <script>
                $(function notification() {
                    new PNotify({
                        title: "Error",
                        type: "error",
                        text: "La categoria ya existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else {
            $modificar = $conexion->query("update categoria set Nombre='$nombre', Descripcion='$descripcion'  where ID_Categoria=$ID_Categoria");
            if ($modificar == true) { ?>
                <script>
                    $(function notification() {
                        new PNotify({
                            title: "Correcto",
                            type: "success",
                            text: "La categoria se modificio correctamente",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php } else { ?>
                <script>
                    $(function notification() {
                        new PNotify({
                            title: "Error",
                            type: "error",
                            text: "Los campos estan vacios",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php } ?>

            <script>
                setTimeout(() => {
                    window.history.replaceState(null, null, window.location.pathname);
                }, 0);
            </script>

        <?php }

    } else { ?>
        <script>
                    $(function notification() {
                        new PNotify({
                            title: "Error",
                            type: "error",
                            text: "Los campos estan vacios",
                            styling: "bootstrap3"
                        })
                    })
                </script>
    <?php }

    ?>

    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

<?php
}

?>