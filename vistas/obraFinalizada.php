<?php
//include './header.php';
require '../funciones/conexion.php';
$db = new Conect_MySql();
$id = $_GET['id'];
$query = "SELECT * FROM obraNueva WHERE id = '$id'";
$ejecuta = $db->execute($query);
$datos = $db->fetch_row($ejecuta);

$sql = "SELECT id, nombre FROM contratistas order by id DESC";
$execute = $db->execute($sql);

$query2 = "SELECT * FROM facturas WHERE idRelacion = '$id'";
$factura = $db->execute($query2);
$hayFactura = mysqli_num_rows($factura);

$consulta = "SELECT * FROM archivosObraNueva WHERE idRelacion = '$id'";
$ejecutarxd = $db->execute($consulta);
//$datitos = $db->fetch_row($ejecutarxd);
$hayArchivo = mysqli_num_rows($ejecutarxd);

$query3 = "SELECT * FROM obraRelacionada WHERE numeroRelacionObra='$id'";
$execute3 = $db->execute($query3);
$datos4 = $db->fetch_row($execute3);

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
            .pull-right {
              float: right !important;
            }
            .btn{
              margin-bottom: 2px;
              margin-top: 2px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <center><h1>Antecedentes de la Obra</h1></center>
            <center><h3><?php echo $datos['id']; ?>, <?php echo $datos['nombreObra']; ?></h3></center>
            <div class="pull-right">
              <button type="button" onclick="enviar();" class="btn btn-primary offset-sm-4" style="background-color: #12548c; border: #12548c;">Genera PDF</button>
            </div>
            <br>
            <br>
            <!--
            <div class="row">
                <label class="col-sm-2"></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><label style="height: 10px">Nombre</label></button>
                        </span>
                        <input type="text" readonly="" class="form-control" value="<?php echo $datos['nombreObra']; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><label style="height: 10px">ID</label></button>
                        </span>
                        <input type="number" id="ide" readonly="" class="form-control" value="<?php echo $datos['id']; ?>">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col-sm-2"></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><label style="height: 10px">Mandante</label></button>
                        </span>
                        <input type="text" readonly="" class="form-control" value="<?php echo $datos['mandante']; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><label style="height: 10px">Tipo</label></button>
                        </span>
                        <input type="text" readonly="" class="form-control" value="<?php echo $datos['unidadOtro']; ?>">
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
                        <input type="text" readonly="" class="form-control" value="<?php echo $datos['empresaContratista']; ?>">
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
                        $p = number_format($datos['presupuesto']);
                        echo str_replace(',', '.', $p);
                        ?>">
                    </div>
                </div>
            </div>
          -->
            <br>
            <div align="center">
              <?php
              while ($datos3 = $db->fetch_row($ejecutarxd)) {
                  ?>
                  <button class="btn btn-info" value="<?php echo $datos3['identificadorArchivo']; ?>" id="archivos"><?php echo $datos3['identificadorArchivo']; ?></button>
              <?php } ?>
              <!--
                <button class="btn btn-info" value="Acta Visita Terreno" id="visita">Acta de Visita</button>
                <button class="btn btn-info" value="Acta Recepción y Apertura" id="receptacion">Acta de Recepción</button>
                <button class="btn btn-info" value="Informes y Contrato" id="informe">Informes</button>
                <button class="btn btn-info" value="Resolución" id="resolucion">Resolución</button>
                <button class="btn btn-info" value="Planimetría" id="planimetria">Planimetrías</button>
                <button class="btn btn-info" value="Especificaciones Técnicas" id="tecnicas">Especificaciones Técnicas</button>
                <button class="btn btn-info" value="Acta Entrega de Terreno" id="terreno">Acta Entrega Terreno</button>
                <button class="btn btn-info" value="Acta Recepción Provisoria" id="recepcion">Acta Recepción Provisoria</button>
                <button class="btn btn-info" value="Acta Entrega a Mandante" id="mandante">Acta Entrega Mandante</button>-->
            </div>
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
            <center><h1>Antecedentes Obras Relacionadas</h1></center>
              <br>
              <input type="hidden" id="idR" value="<?php echo $id; ?>">
              <div class="table-responsive">
                  <table id="user_data2" class="table table-bordered table-striped anotherhover">
                      <thead>
                          <tr>

                              <th>ID</th>
                              <th>Fecha</th>
                              <th>Monto</th>
                              <th>Contratista</th>
                              <th>Rut Contratista</th>
                              <th>Acción</th>
                          </tr>
                      </thead>
                  </table>
              </div>
        </div>

    </body>
    <script type="text/javascript" language="javascript" >
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
                        url: "../funcionesFacturas/fetch2.php?id=" + id,
                        type: "POST"
                    }
                });
            }

            fetch_data2();
            var idd = $('#idR').val();

            function fetch_data2()
            {
                var idd = $('#idR').val();
                var dataTable = $('#user_data2').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    "processing": true,
                    "serverSide": true,
                    "order": false,
                    "ordering": false,
                    "bInfo": false,
                    "ajax": {
                        url: "../funcionesFacturasObraRel/fetch3.php?id=" + idd,
                        type: "POST"
                    }
                });
            }

        });

        $(document).on('click', '.archivo', function () {
            var id = $(this).val();
            window.open('../archivo_pdf.php?id=' + id, '_blank');
        });

        $(document).on('click', '#visita', function () {
           var valor = $(this).val();
           var id = $('#ide').val();
           window.open('../archivosObraNuevaFinalizada.php?id=' + id + '&valor='+ valor, '_blank');
        });

         $(document).on('click', '#receptacion', function () {
           var valor = $(this).val();
           var id = $('#ide').val();
           window.open('../archivosObraNuevaFinalizada.php?id=' + id + '&valor='+ valor, '_blank');
        });

        $(document).on('click', '#terreno', function () {
          var valor = $(this).val();
          var id = $('#ide').val();
          window.open('../archivosObraNuevaFinalizada.php?id=' + id + '&valor='+ valor, '_blank');
       });

         $(document).on('click', '#mandante', function () {
           var valor = $(this).val();
           var id = $('#ide').val();
           window.open('../archivosObraNuevaFinalizada.php?id=' + id + '&valor='+ valor, '_blank');
        });

        $(document).on('click', '#recepcion', function () {
          var valor = $(this).val();
          var id = $('#ide').val();
          window.open('../archivosObraNuevaFinalizada.php?id=' + id + '&valor='+ valor, '_blank');
       });

         $(document).on('click', '#informe', function () {
           var valor = $(this).val();
           var id = $('#ide').val();
           window.open('../archivosObraNuevaFinalizada.php?id=' + id + '&valor='+ valor, '_blank');
        });

         $(document).on('click', '#resolucion', function () {
           var valor = $(this).val();
           var id = $('#ide').val();
           window.open('../archivosObraNuevaFinalizada.php?id=' + id + '&valor='+ valor, '_blank');
        });

         $(document).on('click', '#planimetria', function () {
           var valor = $(this).val();
           var id = $('#ide').val();
           window.open('../archivosObraNuevaFinalizada.php?id=' + id + '&valor='+ valor, '_blank');
        });

         $(document).on('click', '#tecnicas', function () {
           var valor = $(this).val();
           var id = $('#ide').val();
           window.open('../archivosObraNuevaFinalizada.php?id=' + id + '&valor='+ valor, '_blank');
        });
        $(document).on('click', '#archivos', function () {
          var valor = $(this).val();
          var id = $('#ide').val();
          window.open('../archivosObraNuevaFinalizada.php?id=' + id + '&valor='+ valor, '_blank');
       });

       $(document).on('click', '.finalizada', function () {
           var id = $(this).val();
           window.location = "obraRelacionadaFinalizada.php?id=" + id;
       });

       function enviar() {
         var id = $('#ide').val();
         window.open('../finalizadaPdf.php?id=' + id, '_blank');
      }
    </script>
</html>
