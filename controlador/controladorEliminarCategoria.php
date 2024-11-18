<?php
if (!empty($_GET["id"])){
        $id=$_GET["id"];
        $sql=$conexion->query("delete from categoria where ID_Categoria=$id");
    if ($sql==true) {?>
        <script>
            $(function notification(){
                new PNotify({
                    title:"Correcto",
                    type:"success",
                    text:"Categoria eliminada correctamente",
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
                    text:"No se pudo eliminar la categoria",
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