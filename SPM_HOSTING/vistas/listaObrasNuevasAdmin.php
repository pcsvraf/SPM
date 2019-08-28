<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
mysqli_set_charset($connect, "utf8");
$query = "SELECT * FROM estado ORDER BY ide ASC";
$result = mysqli_query($connect, $query);

?>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Programa Calidad de Servicio</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="../librerias/bootstrap-3.3.6/dist/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <style type="text/css">
            .anotherhover tbody tr:hover td {
                background-color: #D3D3D3;
            }
            .table-striped tbody tr:nth-child(odd){
                background-color: #ECF7FF;
            }
            .dataTables_length select {
            }
            .dataTables_filter label {
                background-color: #fa7f28;
                color: #FFF;
                width: 200px;
                margin-right: 10px;
                padding-left: 10px;
            }
        </style>
    </head>
    <body>
        <div class="table-responsive">
            <div class="container-fluid">
                <center><h1>Ejecutar Acciones en las Obras</h1></center>
                <table id="listado" style="font-size: 12px" class="table anotherhover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="background-color: #337ab7;">
                                <select name="category" id="category" class="form-control" style="background-color: #fa7f28; color: #FFF">
                                    <option value="">Todos los Estados</option>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<option value="' . $row["ide"] . '">' . $row["nombre"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </th>
                            <th style="background-color: #337ab7; color: #FFF">ID</th>
                            <th style="background-color: #337ab7; color: #FFF">Encargado</th>
                            <th style="background-color: #337ab7; color: #FFF">Fecha</th>
                            <th style="background-color: #337ab7; color: #FFF">Obra</th>
                            <th style="background-color: #337ab7; color: #FFF">Campus</th>
                            <th style="background-color: #337ab7; color: #FFF">Mandante</th>
                            <th style="background-color: #337ab7; color: #FFF">Tipo</th>
                            <th style="background-color: #337ab7; color: #FFF">Área</th>
                            <th style="background-color: #337ab7; color: #FFF">Contratista</th>
                            <th style="background-color: #337ab7; color: #FFF">Rut</th>
                            <th style="background-color: #337ab7; color: #FFF">Presupuesto</th>
                            <th style="background-color: #337ab7; color: #FFF">Acción</th>
                            <th style="background-color: #337ab7; color: #FFF">Subir Archivos</th>
                            <th style="background-color: #337ab7; color: #FFF">Editar</th>
                            <th style="background-color: #337ab7; color: #FFF">Eliminar</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <script type="text/javascript" src="librerias/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    </body>
    <script type="text/javascript" language="javascript" >
        $(document).ready(function () {


            load_data();
            function load_data(is_category)
            {
                $('#listado').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    "lengthMenu": [15, 25, 50, 100],
                    "processing": true,
                    "serverSide": true,
                    "order": false,
                    "ordering": false,
                    "ajax": {
                        url: "../funcionesModuloObras/datosIniciarObraAdmin.php",
                        type: "POST",
                        data: {is_category: is_category}
                    },
                    "columnDefs": [
                        {
                            "targets": [2],
                            "orderable": false
                        }
                    ]
                });
            }

            $(document).on('change', '#category', function () {
                var category = $(this).val();
                $('#listado').DataTable().destroy();
                if (category != '')
                {
                    load_data(category);
                } else
                {
                    load_data();
                }
            });
        });

        $(document).on('click', '.insert', function () {
            var guardaID = $(this).val();
            var x = confirm("¿Desea iniciar la obra?");
            if (x) {
                window.location = "../funcionesModuloObras/updateObra.php?id=" + guardaID;
            } else {
                alert("La obra no se inició");
                return false;
            }
        });

    </script>
    <script type="text/javascript">
        $(document).on('click', '.documentacion', function () {
            var guarda = $(this).val();
            window.location = "subirFacturas.php?ide=" + guarda;
        });

        $(document).on('click', '.finalizada', function () {
            var id = $(this).val();
            window.location = "obraFinalizada.php?id=" + id;
        });
        $(document).on('click', '.archivos', function () {
            var id = $(this).val();
            window.location = "prueba.php?id=" + id;
        });
        $(document).on('click', '.editar', function () {
            var id = $(this).val();
            window.location = "editarObra.php?id=" + id;
        });
        $(document).on('click', '.eliminar', function () {
            var id = $(this).val();
            var x = confirm("¿Desea eliminar la obra?");
            if (x) {
                window.location = "../funcionesModuloObras/eliminarObra.php?id=" + id;
            }
        });
    </script>
</html>
