<?php
//include './header.php';
?>
<html>
    <head>
        <link href="../librerias/bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/estilosMenuObras.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <br>
            <center><h1 id="tittle">
                    PRESIONE UNO DE LOS SIGUIENTES BOTONES PARA REALIZAR UN ACCIÓN
                </h1></center>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <center><div class="input-group">
                    <a class="boton_personalizado" href="obrasNuevas.php">OBRA NUEVA</a>
                    <a class="invisible">as</a>
                    <a class="boton_personalizado" href="obraRelacionada.php">OBRA ADICIONAL</a>
                    <a class="invisible">as</a>
                    <a class="boton_personalizado" href="listaObras.php">LISTA DE OBRAS NUEVAS</a>
                    <a class="invisible">as</a>
                    <a class="boton_personalizado" href="registroPersonal.php">MÓDULO PERSONAL REGISTRADOR</a>
                </div></center>
            <br>
            <br>
            <center><div class="input-group">
                    <a class="boton_personalizado" href="iniciarObras.php">EJECUTAR ACCIONES EN OBRAS NUEVAS</a>
                    <a class="invisible">as</a>
                    <a class="boton_personalizado" href="listaObrasRelacionadas.php">EJECUTAR ACCIONES EN OBRAS ADICIONALES</a>
                </div></center>
        </div>
        <br>
        <?php// include './footer.php'; ?>
        <script src="../librerias/bootstrap-3.3.6/dist/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>