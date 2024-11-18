<?php
if (!empty($_GET["id"])){
        $id=$_GET["id"];
        $sql=$conexion->query("delete from usuario where ID_Usuario=$id");
    if ($sql==true) {?>
        <script>
            $(function notification(){
                new PNotify({
                    title:"Correcto",
                    type:"success",
                    text:"Usuario eliminado correctamente",
                    styling:"bootstrap3"
                })
            })
        </script>
    <?php } else { ?>
        <script>
            $(function notification(){
                new PNotify({
                    title:"Incorrecto",
                    type:"error",
                    text:"No se pudo eliminar el Usuario",
                    styling:"bootstrap3"
                })
            })
        </script>
    <?php   } ?>

    <script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
    </script>

<?php  }