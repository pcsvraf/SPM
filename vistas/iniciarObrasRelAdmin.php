<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
mysqli_set_charset($connect, "utf8");
$query = "SELECT * FROM estado ORDER BY ide ASC";
$result = mysqli_query($connect, $query);
?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
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
    <center>
        <h1>Ejecutar Acciones en otras Obras Adicionales</h1>
    </center>
    <br>
    <div class="table-responsive">
        <div class="container-fluid">
            <table id="tabla" class="table anotherhover table-bordered table-striped">
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
                        <th style="background-color: #337ab7; color: #FFF">Encargado</th>
                        <th style="background-color: #337ab7; color: #FFF">ID</th>
                        <th style="background-color: #337ab7; color: #FFF">Nombre Obra</th>
                        <th style="background-color: #337ab7; color: #FFF">Fecha</th>
                        <th style="background-color: #337ab7; color: #FFF">Monto</th>
                        <th style="background-color: #337ab7; color: #FFF">Contratista</th>
                        <th style="background-color: #337ab7; color: #FFF">Rut</th>
                        <th style="background-color: #337ab7; color: #FFF">Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script src="../librerias/bootstrap-3.3.6/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {

            fetch_data();

            function fetch_data(is_category)
            {
                $('#tabla').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    "processing": true,
                    "serverSide": true,
                    "order": false,
                    "ordering": false,
                    "ajax": {
                        url: "../funcionesModuloObras/datosObraRelAdmin.php",
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
                $('#tabla').DataTable().destroy();
                if (category != '')
                {
                    fetch_data(category);
                } else
                {
                    fetch_data();
                }
            });

        });

        $(document).on('click', '.insert', function () {
            var guardaID = $(this).val();
            var x = confirm("¿Desea Inciar La Obra?");
            if (x) {
                window.location = "../funcionesModuloObras/updateObraRel.php?id=" + guardaID;
            } else {
                alert("La Obra no se Inició");
                return false;
            }
        });

        $(document).on('click', '.documentacion', function () {
            var guarda = $(this).val();
            window.location = "subirFacturasObraRel.php?ide=" + guarda;
        });

        $(document).on('click', '.finalizada', function () {
            var id = $(this).val();
            window.location = "obraRelacionadaFinalizada.php?id=" + id;
        });

    </script>
</body>
</html>
