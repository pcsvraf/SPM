<?php
//include './header.php';

?>
<html>
    <head>
        <title>Módulo Contratistas</title>
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
        <div class="container">
            <div align="left">
                <button type="button" name="add" id="add" class="btn btn-info">Agregar</button>
            </div>
            <br>
            <div id="alert_message"></div>
            <div class="table-responsive">
                <table id="user_data" class="table table-bordered table-striped anotherhover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre o Razón Social</th>
                            <th>Rut</th>
                            <th>E-mail</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Eliminar/Ingresar</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <?php// include './footer.php'; ?>

    </body>
    <script type="text/javascript" language="javascript" >
        $(document).ready(function () {

            fetch_data();

            function fetch_data()
            {
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
                        url: "../funcionesModuloContratistas/fetch.php",
                        type: "POST",
                        dataType: "json"
                    }
                });
            }

            function update_data(id, column_name, value)
            {
                $.ajax({
                    url: "../funcionesModuloContratistas/update.php",
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
                var value = $(this).text();
                var validaRut = /^\d{7,8}-[k|K|\d]{1}$/;
                var reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;
                if (column_name != "rut" && column_name != "email") {
                    update_data(id, column_name, value);
                } else if (column_name == "rut" && validaRut.test(value)) {
                    update_data(id, column_name, value);
                } else if (column_name == "email" && reg.test(value)) {
                    update_data(id, column_name, value);
                } else {
                    alert("El rut o el E-mail no son validos");
                    window.location = "table.php";
                }
            });
            $('#add').click(function () {
                var html = '<tr>';
                html += '<td></td>';
                html += '<td contenteditable id="data1"></td>';
                html += '<td contenteditable id="data2"></td>';
                html += '<td contenteditable id="data3"></td>';
                html += '<td contenteditable id="data4"></td>';
                html += '<td contenteditable id="data5"></td>';
                html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insertar</button></td>';
                html += '</tr>';
                $('#user_data tbody').prepend(html);
            });
            $(document).on('click', '#insert', function () {
                var nombre = $('#data1').text();
                var rut = $('#data2').text();
                var email = $('#data3').text();
                var contacto = $('#data4').text();
                var direccion = $('#data5').text();
                var validaRut = /^\d{7,8}-[k|K|\d]{1}$/;
                var reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;
                if (nombre != '' && rut != '' && email == '' && validaRut.test(rut)) {
                    $.ajax({
                        url: "../funcionesModuloContratistas/insert.php",
                        method: "POST",
                        data: {nombre: nombre, rut: rut, email: email, contacto: contacto, direccion: direccion},
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
                } else if (nombre != '' && rut != '' && email != '' && reg.test(email) && validaRut.test(rut))
                {
                    $.ajax({
                        url: "../funcionesModuloContratistas/insert.php",
                        method: "POST",
                        data: {nombre: nombre, rut: rut, email: email, contacto: contacto, direccion: direccion},
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
                } else if (validaRut.test(rut) == false) {
                    alert('El Rut debe ingresarse sin puntos y con guión ejemplo: 19542715-1');
                } else
                {
                    alert("Los campos deben ser completados o Su E-mail o Rut son incorrectos");
                }
            });
            $(document).on('click', '.delete', function () {
                var id = $(this).attr("id");
                if (confirm("Estas seguro de que deseas Eliminarlo?"))
                {
                    $.ajax({
                        url: "../funcionesModuloContratistas/delete.php",
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
    </script>
</html>
