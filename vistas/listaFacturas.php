<?php// include './header.php'; 
$id = $_GET['id'];
?>
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
        </style>
    </head>
    <body>
        <div class="table-responsive">
        <div class="container-fluid">
            <center><h1>Lista de Facturas</h1></center>
            <table id="tabla" style="font-size: 12px" class="table anotherhover table-bordered table-striped">
                <thead>
                <input type="hidden" id="ide" value="<?php echo $id; ?>">
                    <tr>
                        <th style="background-color: #337ab7; color: #FFF">ID</th>
                        <th style="background-color: #337ab7; color: #FFF">ID Obra</th>
                        <th style="background-color: #337ab7; color: #FFF">Fecha</th>
                        <th style="background-color: #337ab7; color: #FFF">Razon Social</th>
                        <th style="background-color: #337ab7; color: #FFF">Rut</th>
                        <th style="background-color: #337ab7; color: #FFF">Monto</th>
                        <th style="background-color: #337ab7; color: #FFF">Observaciones</th>
                        <th style="background-color: #337ab7; color: #FFF">Devolución de Retención</th>
                        <th style="background-color: #337ab7; color: #FFF">Factura</th>
                    </tr>
                </thead>
            </table>
        </div>
        </div>
        <?php// include './footer.php'; ?>
        <script type="text/javascript" src="librerias/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
         <script>
        $(document).ready(function () {

            fetch_data();
            
            function fetch_data()
            {
                var id = $('#ide').val();
                var dataTable = $('#tabla').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    "processing": true,
                    "serverSide": true,
                    "order": false,
                    "ordering": false,
                    "ajax": {
                        url: "../funcionesModuloObras/datosFacturas.php?id=" + id,
                        type: "POST"
                    }
                });
            }
        });
        
        $(document).on('click', '.insert', function () {
        var guardaID = $(this).val();
            window.location = "../funcionesModuloObras/archivo_pdf.php?id=" + guardaID;
    });
    </script>
    </body>
</html>