<?php
//include './header.php';
require '../funciones/conexion.php';

$db = new Conect_MySql();
$id = $_GET['id'];

$query = "SELECT * FROM obraRelacionada WHERE id='$id'";
$ejecuta = $db->execute($query);
$datos = $db->fetch_row($ejecuta);

$query2 = "SELECT * FROM obraNueva WHERE id= ".$datos['numeroRelacionObra']."";
$ejecuta2 = $db->execute($query2);
$datos2 = $db->fetch_row($ejecuta2);

?>
<html>
    <head>
        <link href="../librerias/bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/estilosFacturas.css" rel="stylesheet" type="text/css"/>
        <script src="../assets/js/jquery-1.11.3.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="../librerias/bootstrap-3.3.6/dist/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="../librerias/bootstrap-3.3.6/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <style>
            .btn-default {
                height: 34px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <center><h1>Obra Relacionada: informe y facturas</h1></center>
            <center><h3><?php echo $datos['id']; ?>, <?php echo utf8_encode($datos2['nombreObra']); ?></h3></center>
            <br>
            <br>
            <!--
            <div class="row">
                <label class="col-sm-4"></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><label style="height: 10px">ID</label></button>
                        </span>
                        <input type="number" readonly="" class="form-control" value="<?php echo $datos['id']; ?>">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col-sm-2"></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><label style="height: 10px">Contratista</label></button>
                        </span>
                        <input type="text" readonly="" class="form-control" value="<?php echo utf8_encode($datos['contratista']); ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><label style="height: 10px">Rut</label></button>
                        </span>
                        <input type="text" readonly="" class="form-control" value="<?php echo $datos['rutContratista']; ?>">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col-sm-2"></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><label style="height: 10px">Fecha Inicio</label></button>
                        </span>
                        <input type="text" readonly="" class="form-control" value="<?php echo $datos['fechaInicio']; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><label style="height: 10px">Presupuesto</label></button>
                        </span>
                        <input type="text" id="presupuesto" readonly="" class="form-control" value="<?php
                        $p = number_format($datos['monto']);
                        echo str_replace(',', '.', $p);
                        ?>">
                    </div>
                </div>
            </div>-->
            <br>
            <center><button id="archivo" class="btn btn-info">Informe Obra Extraordinaria</button></center>
            <br>
            <br>
            <!--<div id="titulo">
                <br>
                <center><h1 style="font-weight: bold; color: #848484; font-size: 50px">ANTECEDENTES FACTURAS</h1></center>
                <center><h3 style="font-size: 15px">A continuación se muestran las facturas de la obra</h3></center>
                <br>
            </div>-->
            <br>
            <input type="hidden" id="ide" value="<?php echo $id; ?>">
            <div class="table-responsive">
                <table id="user_data" class="table table-bordered table-striped anotherhover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>N° Factura</th>
                            <th>Fecha Factura</th>
                            <th>Detalle Glosa Servicio</th>
                            <th>Total Factura</th>
                            <th>Devolución de Retención</th>
                            <th>Archivo</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <br>
        </div>
    </body>
    <script>
         $(document).ready(function () {

            fetch_data();
            var id = $('#ide').val();

            function fetch_data()
            {
                var id = $('#ide').val();
                var dataTable = $('#user_data').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    "processing": true,
                    "serverSide": true,
                    "order": false,
                    "ordering": false,
                    "bInfo": false,
                    "ajax": {
                        url: "../funcionesFacturasObraRel/fetch2.php?id=" + id,
                        type: "POST"
                    }
                });
            }
        });

        $(document).on('click', '.archivo', function () {
            var id = $(this).val();
            window.open('../archivo_pdf_ObraRel.php?id=' + id, '_blank');
        });

        $(document).on('click', '#archivo', function () {
            var ide = $('#ide').val();
           window.open('../archivoObraRel.php?id=' + ide, '_BLANK');
        });
    </script>
</html>
