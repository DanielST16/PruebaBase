<?php
if (!empty($_POST["btnModificar"])) {
    if (!empty($_POST["txtNombre"]) and !empty($_POST["txtDescripcion"])) {
        $nombre = $_POST["txtNombre"];
        $descripcion = $_POST["txtDescripcion"];
        $ID_Habito = $_POST["txtID_Habito"];
        $sql = $conexion->query("select count(*) as 'total' from habito where Nombre='$nombre' and ID_Habito!=$ID_Habito");
        if ($sql->fetch_object()->total > 0) { ?>
            <script>
                $(function notification() {
                    new PNotify({
                        title: "Error",
                        type: "error",
                        text: "El habito ya existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else {
            $modificar = $conexion->query("update habito set Nombre='$nombre', Descripcion='$descripcion'  where ID_Habito=$ID_Habito");
            if ($modificar == true) { ?>
                <script>
                    $(function notification() {
                        new PNotify({
                            title: "Correcto",
                            type: "success",
                            text: "El habito se modificio correctamente",
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