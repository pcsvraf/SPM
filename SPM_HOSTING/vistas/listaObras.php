<?php
include '/home/pcspucv/public_html/spm/wp-load.php';
if (is_user_logged_in()) {
   $cu = wp_get_current_user();
   $nombre = $cu->user_firstname;
   $apellidos = $cu->user_lastname;
   $nombreCompleto = $nombre . " " . $apellidos;
}
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
    <center><h1>Listado de Obras Nuevas</h1></center>
    <br>
    <div class="container-fluid">
            <div class="table-responsive">
                <table id="tabla" style="font-size: 12px" class="table table-bordered table-striped anotherhover">
                    <thead>
                        <tr>
                            <th style="background-color: #337ab7; color: #FFF">ID</th>
                            <th style="background-color: #337ab7; color: #FFF">Responsable</th>
                            <th style="background-color: #337ab7; color: #FFF">Fecha</th>
                            <th style="background-color: #337ab7; color: #FFF">Obra</th>
                            <th style="background-color: #337ab7; color: #FFF">Campus</th>
                            <th style="background-color: #337ab7; color: #FFF">Mandante</th>
                            <th style="background-color: #337ab7; color: #FFF">Tipo</th>
                            <th style="background-color: #337ab7; color: #FFF">Área</th>
                            <th style="background-color: #337ab7; color: #FFF">Usuario</th>
                            <th style="background-color: #337ab7; color: #FFF">Edificio</th>
                            <th style="background-color: #337ab7; color: #FFF">Piso</th>
                            <th style="background-color: #337ab7; color: #FFF">Recinto</th>
                            <th style="background-color: #337ab7; color: #FFF">Contratista</th>
                            <th style="background-color: #337ab7; color: #FFF">Rut</th>
                            <th style="background-color: #337ab7; color: #FFF">Presupuesto</th>
                            <th style="background-color: #337ab7; color: #FFF">Neto</th>
                            <th style="background-color: #337ab7; color: #FFF">IVA</th>
                            <th style="background-color: #337ab7; color: #FFF">Cuenta</th>
                            <th style="background-color: #337ab7; color: #FFF">Observaciones</th>
                            <th style="background-color: #337ab7; color: #FFF">Metros Cuadrados</th>
                            <th style="background-color: #337ab7; color: #FFF">Estado</th>
                            <th style="background-color: #337ab7; color: #FFF">Obra Nueva / Remodelación</th>
                            <th style="background-color: #337ab7; color: #FFF">Inicio Contrato</th>
                            <th style="background-color: #337ab7; color: #FFF">Término Contrato</th>
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
                var dataTable= $('#tabla').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    "processing": true,
                    "serverSide": true,
                    "order": false,
                    "ordering": false,
                    "bInfo": false,
                    "ajax": {
                        url: "../funcionesModuloObras/datosListaObras.php",
                        type: "POST"
                    }
                });
            }
        });
    </script>
</body>
</html>
