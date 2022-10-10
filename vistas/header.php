<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="../assets/css/footer-basic-centered_1.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link href="../assets/css/headerResponsive.css" rel="stylesheet" type="text/css"/>
        <script src="../librerias/bootstrap-3.3.6/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <style>
            .footer-basic-centered2 .footer-links .titulo {
                float: left;
                margin-left: 20px;
            }
            @media only screen and (max-width: 600px){
                .footer-basic-centered2 .footer-links a {
                    font-size: 10.2px;
                }
                .footer-basic-centered2 .footer-links .icono{
                    margin-right: 24px;
                }
                .footer-basic-centered2 .footer-links .titulo{
                    margin-left: 0px;
                }
            }
        </style>
    </head>
    <body>
        <footer class="footer-basic-centered2">
            <p class="footer-links">
                <a class="titulo"><?php echo utf8_decode('Sistema Gestión de Obras de Plan Maestro'); ?></a>
                <a class="icono1">dgaea@pucv.cl</a>
                <i class="fa fa-envelope icono2"></i>
                <a class="icono" target="_blank">+56-32-2273213</a>
                <i class="fa fa-phone icono3"></i>
            </p>
        </footer>
        <div class="container-fluid">
            <div class="topnav" id="myTopnav">
                <a href="http://spm.pucv.cl/vistas/menu.php"><img src="https://vaf.ucv.cl:8443/Circulares/archivo?codNivel=0001054000&codDcto=00010540001802271628&type=doc"></a>
                <a class="href" href="menu.php">INICIO</a>
                <a class="href" href="table.php"><?php echo utf8_decode('MÓDULO CONTRATISTAS'); ?></a>
                <a class="href" href="menuIngresoObras.php"><?php echo utf8_decode('MÓDULO OBRAS'); ?></a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>

    </body>
</html>
