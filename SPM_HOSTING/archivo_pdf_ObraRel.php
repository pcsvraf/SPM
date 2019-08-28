<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Archivo</title>
        <style type="text/css">
            .embed-container {
                position: relative;
                padding-bottom: 56.25%;
                height: 0;
                overflow: hidden;
            }
            .embed-container iframe {
                position: absolute;
                top:0;
                left: 0;
                width: 100%;
                height: 100%;
            }

        </style>
    </head>
    <body>
        <?php
        include 'funciones/conexion.php';
        $id = $_GET['id'];
        $db = new Conect_MySql();
        $sql = "SELECT * FROM archivosFacturasObraRel WHERE idRelacion='$id'";
        $ejecuta = $db->execute($sql);
        $datos = $db->fetch_row($ejecuta);
        $cuenta = mysqli_num_rows($ejecuta);
        if($cuenta != 0){
            ?>
            <div class="embed-container">
                <iframe width="1200" height="630" src="archivosFacturasRelacionada/<?php echo $datos['nombreArchivo']; ?>" frameborder="0" allowfullscreen>
                </iframe>
            </div>
        <?php
        }
        else {
            echo utf8_decode('NO EXISTE ARCHIVO');
        }
        ?>
    </body>
</html>


