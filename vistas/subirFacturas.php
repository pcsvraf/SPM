<?php
//include './header.php';
require '../funciones/conexion.php';
$db = new Conect_MySql();
$id = $_GET['ide'];
$query = "SELECT * FROM obraNueva WHERE id = '$id'";
$ejecuta = $db->execute($query);
$datos = $db->fetch_row($ejecuta);

$sql = "SELECT id, nombre FROM contratistas order by id DESC";
$execute = $db->execute($sql);

$query2 = "SELECT * FROM facturas WHERE idRelacion = '$id'";
$factura = $db->execute($query2);
$hayFactura = mysqli_num_rows($factura);
?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <link href="../librerias/bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/estilosFacturas.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <center><h1>Subir Facturas Obra Nueva</h1></center>
            <center><h3><?php echo $datos['id']; ?>, <?php echo $datos['nombreObra']; ?></h3></center>
            <br>
            <br>
            <!--<div class="row">
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
                </div>-->
                <!--<div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><label style="height: 10px">Presupuesto</label></button>
                        </span>

                    </div>
                </div>-->
                <input type="hidden" id="presupuesto" readonly="" class="form-control" value="<?php
                $p = number_format($datos['presupuesto']);
                echo str_replace(',', '.', $p);
                ?>">
            <!--</div>
            <br>
            <br>
            <div id="titulo">
                <br>
                <center><h1 style="font-weight: bold; color: #848484; font-size: 50px">ANTECEDENTES FACTURAS</h1></center>
                <center><h3 style="font-size: 15px">Complete los campos de la tabla para ingresar Facturas</h3></center>
                <br>
            </div>
            <br>
            <br>-->
            <div align="left">
                <button type="button" name="add" id="add" class="btn btn-info">Agregar</button>
            </div>
            <br>
            <a>La Suma Total de las Facturas es: </a>$<span id="totalFact"></span>
            <a>, y su presupuesto es: </a>$<span id="totalPresu"></span>
            <br>
            <br>
            <div id="alert_message"></div>
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
                            <th>Eliminar/Ingresar</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <input type="hidden" id="ide" value="<?php echo $id; ?>">
            <div id="id01" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('id01').style.display = 'none'"
                              class="w3-button w3-display-topright">&times;</span>
                        <center><h1>Subir Factura</h1></center>
                        <br>
                        <br>
                        <center><form method="POST" id="subeArchivo" name="subeArchivo" action="../funcionesFacturas/subirArchivo.php" enctype="multipart/form-data">
                                <input type="hidden" name="inputHidden" id="inputHidden">
                                <input type="hidden" name="hidden" value="<?php echo $id; ?>">
                                <input type="file" name="archivo" required="" class="btn btn-primary">
                                <br>
                                <input type="submit" class="btn btn-success">
                            </form></center>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
            <br>
            <center><input type="button" id="cerrarObra" class="btn btn-danger" value="CERRAR OBRA"></center>
            <br>
        </div>
    </body>
    <?php // include './footer.php'; ?>
    <script type="text/javascript" language="javascript" >
        $(document).ready(function () {

            fetch_data();
            var id = $('#ide').val();
            getJsonDataByUrl("../funcionesFacturas/jsonFacturas.php?id=" + id);

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
                        url: "../funcionesFacturas/fetch.php?id=" + id,
                        type: "POST"
                    }
                });
            }


            function getJsonDataByUrl($url, async = false) {
                var $ajax = $.ajax({
                    type: "GET",
                    url: $url,
                    async: async,
                    dataType: "json"
                }).responseJSON;
                //return $ajax;
                var totalSuma = 0;
                for (var clave in $ajax) {
                    // Controlando que json realmente tenga esa propiedad
                    if ($ajax.hasOwnProperty(clave)) {
                        // Mostrando en pantalla la clave junto a su valor
                        //console.log("La clave es " + clave + " y el valor es " + $ajax[clave]);
                        //sumando los resultados de la variable $ajax
                        totalSuma += parseInt($ajax[clave]);
                    }
                }
                var presupuesto = $('#presupuesto').val();
                $('#totalFact').text(totalSuma.toLocaleString());
                $('#totalPresu').text(presupuesto);
            }

            function update_data(id, column_name, value)
            {
                $.ajax({
                    url: "../funcionesFacturas/update.php",
                    method: "POST",
                    data: {id: id, column_name: column_name, value: value},
                    success: function (data)
                    {
                        $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                        $('#user_data').DataTable().destroy();
                        fetch_data();
                    }
                });
                setInterval(function () {
                    $('#alert_message').html('');
                }, 5000);
            }

            $(document).on('blur', '.update', function () {
                var id = $(this).data("id");
                var column_name = $(this).data("column");
                var value = $(this).val();
                var check = $('.checkDevolucion');

                if (column_name == "devolucionDeRetencion") {

                    for (var i = 0; i < check.length; i++) {

                        if ($(check[i]).val() == id) {
                            if ($(check[i]).prop('checked')) {
                                value = "SI";
                            } else {
                                value = "NO";
                            }
                            break;
                        }
                    }
                } else {
                    value = $(this).val();
                }
                update_data(id, column_name, value);
            });

            $('#add').click(function () {
                var html = '<tr>';
                html += '<td></td>';
                html += '<td><input type="number" contenteditable id="data1" min="0" class="form-control"></td>';
                html += '<td><input type="date" id="data2" conteditable class="form-control"></td>';
                html += '<td><input type="text" contenteditable id="data3" class="form-control"></td>';
                html += '<td><input type="number" contenteditable id="data4" min="0" class="form-control"></td>';
                html += '<td><input type="checkbox" contenteditable id="data5" class="form-control checkDevolucion"></td>';
                html += '<td><button class="btn btn-danger">No hay Archivo</button></td>';
                html += '<td><button type="button" name="insert" id="insert" class="btn btn-success">Insertar</button></td>';
                html += '</tr>';
                $('#user_data tbody').prepend(html);
            });
            $(document).on('click', '#insert', function () {
                var idRelacion = <?php echo $id; ?>;
                var numeroFactura = $('#data1').val();
                var fecha = $('#data2').val();
                var detalleServicio = $('#data3').val();
                var totalFactura = $('#data4').val();
                var devolucionDeRetencion = "";
                if ($('.checkDevolucion').prop('checked')) {
                    devolucionDeRetencion = "SI";
                } else {
                    devolucionDeRetencion = "NO";
                }
                if (idRelacion != '' && numeroFactura != '' && fecha != '' && detalleServicio != '' && totalFactura != '') {
                    $.ajax({
                        url: "../funcionesFacturas/insert.php",
                        method: "POST",
                        data: {idRelacion: idRelacion, numeroFactura: numeroFactura, fecha: fecha, detalleServicio: detalleServicio, totalFactura: totalFactura, devolucionDeRetencion: devolucionDeRetencion},
                        success: function (data)
                        {
                            $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                            $('#user_data').DataTable().destroy();
                            fetch_data();
                        }
                    });
                    setInterval(function () {
                        $('#alert_message').html('');
                    }, 5000);
                } else
                {
                    alert("Los campos deben ser completados");
                    return false;
                }
            });
            $(document).on('click', '.delete', function () {
                var id = $(this).attr("id");
                if (confirm("¿Estas seguro de que deseas eliminar?"))
                {
                    $.ajax({
                        url: "../funcionesFacturas/delete.php",
                        method: "POST",
                        data: {id: id},
                        success: function (data) {
                            $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                            $('#user_data').DataTable().destroy();
                            fetch_data();
                        }
                    });
                    setInterval(function () {
                        $('#alert_message').html('');
                    }, 5000);
                }
            });
        });
        $(document).on('click', '.archivo', function () {
            var id = $(this).val();
            window.open('../archivo_pdf.php?id=' + id, '_blank');
        });

        $(document).on('click', '.subirArchivo', function () {
            var id = $(this).val();
            $('#inputHidden').val(id);
            var sub= "subido";
            document.getElementById('id01').style.display = 'block';
        });

        $(document).on('click', '#cerrarObra', function () {
                var id = <?php echo $id ?>;
                if (confirm("¿Estas seguro de que deseas cerrar la obra?")){
                  window.location = "../funcionesFacturas/cerrarObra.php?id=" + id;
                }
        });

    </script>
</html>
