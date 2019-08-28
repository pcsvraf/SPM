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
    <head>
        <link href="../librerias/bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/estilosObraRelacionada.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/headerResponsive.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <script src="../assets/js/jquery-1.11.3.js" type="text/javascript"></script>
        <script src="../librerias/bootstrap-3.3.6/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <style type="text/css">
            .btn-default {
                height: 34px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <center><h1>Formulario Obras Adicionales</h1></center>
            <br>
            <form method="POST" action="obraRelacionada.php">
                <div class="row">
                    <label class="col-sm-4"></label>
                    <div class="col-sm-4">
                      <select class="form-control" required="" name="id">
                          <option value="" disabled="" selected="">Seleccione Obra</option>
                          <?php
                          require '../funciones/conexion.php';
                          $db = new Conect_MySql();
                          $query3 = "SELECT id, nombreObra FROM obraNueva WHERE encargado='$nombreCompleto' && estado='2' ORDER BY id DESC";
                          $ejecuta3 = $db->execute($query3);
                          while ($datos3 = $db->fetch_row($ejecuta3)) {
                              ?>
                              <option value="<?php echo $datos3['id']; ?>"><?php echo $datos3['nombreObra']; ?></option>
                          <?php } ?>
                      </select>
                      <button class="btn btn-default" name="busqueda" type="submit"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                </div>
            </form>
            <br>
            <?php
            if (isset($_POST['id'])) {
                //require '../funciones/conexion.php';
                $db = new Conect_MySql();
                $id = $_POST['id'];
                $query = "SELECT * FROM obraNueva WHERE id ='$id' && estado = '2' && encargado='$nombreCompleto'";

                $ejecuta = $db->execute($query);
                $rows = mysqli_num_rows($ejecuta);
                $datos = $db->fetch_row($ejecuta);
                if ($rows == 0) {
                    echo '<script> alert("Asegurese que el ID exista y que la obra se haya iniciado"); window.location="obraRelacionada.php"; </script>';
                }
            }
            ?>
            <?php
            if ($rows != 0) {
                ?>
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
                    <label class="col-sm-4"></label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><label style="height: 10px">Nombre</label></button>
                            </span>
                            <input type="text" readonly="" class="form-control" value="<?php echo $datos['nombreObra']; ?>">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-sm-4"></label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><label style="height: 10px">Valor en</label></button>
                            </span>
                            <input type="text" readonly="" class="form-control" value="<?php echo $datos['valor']; ?>">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-sm-4"></label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><label style="height: 10px">Presupuesto</label></button>
                            </span>
                            <input type="text" readonly="" class="form-control" value="<?php
                            $p = number_format($datos['presupuesto']);
                            echo str_replace(',', '.', $p);
                            ?>">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-sm-4"></label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><label style="height: 10px">Contratista</label></button>
                            </span>
                            <input type="text" readonly="" class="form-control" value="<?php echo $datos['empresaContratista']; ?>">
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <form action="../funcionesModuloObras/insertObraRelacionada.php" enctype="multipart/form-data" method="POST">
                    <input name="idObra" type="hidden" value="<?php echo $datos['id']; ?>">
                    <div class="row">
                        <label class="col-sm-4"></label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><label style="height: 10px">$ Monto</label></button>
                                </span>
                                <input type="number" min="0" name="monto" required="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-sm-4"></label>
                        <div class="col-sm-4">
                            <!-- se hace un ciclo while para obtener todos los contratistas y así llenar el select
                       dinámicamente -->
                            <select class="form-control" required="" name="contratistas[]">
                                <option value="" disabled="" selected="">Seleccione un Contratista</option>
                                <?php
                                $db = new Conect_MySql();
                                $query2 = "SELECT id, nombre FROM contratistas ORDER BY id DESC";
                                $ejecuta2 = $db->execute($query2);
                                while ($datos2 = $db->fetch_row($ejecuta2)) {
                                    ?>
                                    <option value="<?php echo $datos2['nombre']; ?>"><?php echo $datos2['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-sm-2"></label>
                        <div class="col-sm-8">
                            <center><textarea class="form-control" name="observaciones" placeholder="Observaciones" rows="5"></textarea></center>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <label class="col-sm-3"></label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><label style="height: 21px">Informe Obras Extraordinarias (1 MB)</label></button>
                                </span>
                                <input class="btn btn-primary" required="" name="informe" id="informe" type="file" accept=".jpg, .pdf">
                            </div>
                        </div>
                    </div>
                    <br>
                    <center><input class="btn btn-primary" type="submit" style="margin-left: 740px" value="Enviar"></center>
                </form>
                <?php
            }
            ?>
        </div>
    </body>
    <script src="../librerias/bootstrap-3.3.6/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">

        $('#informe').bind('change', function () {
            var peso = this.files[0].size;
            if (peso > 1000000) {
                alert("Tamaño máximo 1MB");
                this.value = '';
            }
        });
    </script>
</html>
