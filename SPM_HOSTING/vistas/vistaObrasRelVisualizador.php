
<html>
    <head>
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
    <center><h1>Listado de Obras Adicionales</h1></center>
    <br>
    <div class="container-fluid">
            <div class="table-responsive">
                <table id="tabla" style="font-size: 12px" class="table table-bordered table-striped anotherhover">
                    <thead>
                        <tr>
                            <th style="background-color: #337ab7; color: #FFF">Responsable</th>
                            <th style="background-color: #337ab7; color: #FFF">ID</th>
                            <th style="background-color: #337ab7; color: #FFF">Nombre Obra</th>
                            <th style="background-color: #337ab7; color: #FFF">Fecha Ingreso</th>
                            <th style="background-color: #337ab7; color: #FFF">Monto</th>
                            <th style="background-color: #337ab7; color: #FFF">Contratista</th>
                            <th style="background-color: #337ab7; color: #FFF">Rut Contratista</th>
                            <th style="background-color: #337ab7; color: #FFF">Observaciones</th>
                            <th style="background-color: #337ab7; color: #FFF">Finalizada</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    <script src="../librerias/bootstrap-3.3.6/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {

            fetch_data();

            function fetch_data()
            {
                $('#tabla').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    "processing": true,
                    "serverSide": true,
                    "order": false,
                    "ordering": false,
                    "bInfo": false,
                    "ajax": {
                        url: "../funcionesModuloObras/datosVistaObraRelVis.php",
                        type: "POST"
                    }
                });
            }
        });
        $(document).on('click', '.finalizada', function () {
            var id = $(this).val();
            window.location = "obraRelacionadaFinalizada.php?id=" + id;
        });
    </script>
</body>
</html>
