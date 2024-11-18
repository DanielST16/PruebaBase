<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    
    // Primero, eliminar los registros dependientes en la tabla usuario_habito
    $sqlEliminarRelaciones = $conexion->query("DELETE FROM usuario_habito WHERE ID_Habito = $id");
    
    // Luego, eliminar el hábito de la tabla habito
    if ($sqlEliminarRelaciones) {
        $sqlEliminarHabito = $conexion->query("DELETE FROM habito WHERE ID_Habito = $id");

        if ($sqlEliminarHabito == true) { ?>
            <script>
                $(function notification() {
                    new PNotify({
                        title: "Correcto",
                        type: "success",
                        text: "Hábito eliminado correctamente",
                        styling: "bootstrap3"
                    });
                })
            </script>
        <?php } else { ?>
            <script>
                $(function notification() {
                    new PNotify({
                        title: "Incorrecto",
                        type: "error",
                        text: "No se pudo eliminar el hábito",
                        styling: "bootstrap3"
                    });
                })
            </script>
        <?php }
    } else {
        // Si no se pudo eliminar las relaciones, mostrar mensaje de error
        ?>
        <script>
            $(function notification() {
                new PNotify({
                    title: "Incorrecto",
                    type: "error",
                    text: "No se pudieron eliminar las relaciones con el hábito",
                    styling: "bootstrap3"
                });
            })
        </script>
        <?php
    }

    ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

<?php }
?>
