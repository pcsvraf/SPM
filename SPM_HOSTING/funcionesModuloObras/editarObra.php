<?php

require '../funciones/conexion.php';
$db = new Conect_MySql();

$id = $_GET['id'];

$query1 = "SELECT * FROM obraNueva WHERE id='$id'";
$ejecuta = $db->execute($query1);
$fila = mysqli_fetch_object($ejecuta);
$dato = $db->fetch_row($ejecuta);

$nueva="";
$remodel="";
$facul="";
$admin="";
$otro="";
if($fila->nuevaRemodelacion=='Remodelacion'){
  $remodel="checked";
}elseif ($fila->nuevaRemodelacion=='Obra Nueva'){
  $nueva="checked";
}elseif ($fila->mandante=='Administración Central'){
  $admin="checked";
}elseif ($fila->mandante=='Facultad'){
  $facul="checked";
}elseif ($fila->mandante=='Otro'){
  $otro="checked";
}

$query = "select nombre from cargoNroCuenta";
$ejecuta = $db->execute($query);

$consu = "SELECT nombre FROM personalIngresador ORDER BY id DESC";
$exe = $db->execute($consu);

$consulta = "select nombre from cargoNroCuenta";
$execute = $db->execute($consulta);

$query2 = "select nombre from campus";
$ejecutar = $db->execute($query2);

$query3 = "select nombre from unidadAdministrativa";
$unidadAdmin = $db->execute($query3);

$query4 = "select id, nombre from facultades";
$facultad = $db->execute($query4);

$consulta2 = "select id, nombre from contratistas order by id DESC";
$contratista = $db->execute($consulta2);

//se comienza con los select que cambiarán segun la opcion que seleccione el usuario
$a = "select nombre from unidadAcademica where nombreFacu = 'Facultad De Arquitectura Y Urbanismo'";
$b = $db->execute($a);

$c = "select nombre from unidadAcademica where nombreFacu = 'Facultad De Ciencias Del Mar Y Geografía'";
$d = $db->execute($c);

$e = "select nombre from unidadAcademica where nombreFacu = 'Facultad De Filosofía Y Educación'";
$f = $db->execute($e);

$g = "select nombre from unidadAcademica where nombreFacu = 'Facultad De Ciencias'";
$h = $db->execute($g);

$i = "select nombre from unidadAcademica where nombreFacu = 'Facultad De Ciencias Económicas Y Administrativas'";
$j = $db->execute($i);

$k = "select nombre from unidadAcademica where nombreFacu = 'Facultad De Ingeniería'";
$l = $db->execute($k);

$m = "select nombre from unidadAcademica where nombreFacu = 'Facultad De Ciencias Agronómicas Y De Los Alimentos'";
$n = $db->execute($m);

$ñ = "select nombre from unidadAcademica where nombreFacu = 'Facultad Eclesiástica De Teología'";
$o = $db->execute($ñ);

$p = "select nombre from unidadAcademica where nombreFacu = 'Facultad De Derecho'";
$q = $db->execute($p);
?>
<html>
    <head>
        <link href="../librerias/bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="../librerias/EasyAutocomplete-1.3.5/easy-autocomplete.min.css">
        <link href="../assets/css/estilosFormularioObras.css" rel="stylesheet" type="text/css"/>
        <script src="../assets/js/jquery-1.11.3.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <br>
            <form enctype="multipart/form-data" id="formularioxd" action="modificarObra.php" method="POST" class="form-horizontal">
                <br>
                <div id="imagenInfoObra">
                    <center><img  class="imagenes" src="../assets/img/InfoObra.png" height="70px"></center>
                </div>
                <br>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="nombre"></label>
                    <div class="col-sm-4 text-center">
                        <input type="hidden" name="hidden" value="<?php echo $id; ?>">
                        <input class="form-control" type="text" required="" placeholder="Nombre de la Obra" name="nombre" id="nombre" value="<?php echo $fila->nombreObra; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="nombre"></label>
                    <div class="col-sm-4">
                        <select class="form-control" required="" id="campus" name="campus[]">
                            <option value="" disabled="true" selected="<?php echo $fila->campus; ?>">Seleccione Campus</option>
                            <?php
                            while ($datos2 = $db->fetch_row($ejecutar)) {
                              if($fila->campus ==$datos2['nombre']){?>
                                <option value="<?php echo $datos2['nombre']; ?>" selected><?php echo $datos2['nombre']; ?></option>
                              <?php } ?>
                                <option value="<?php echo $datos2['nombre']; ?>"><?php echo $datos2['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4"></label>
                    <div class="col-sm-4">
                        <input class="form-control" name="metrosCuadrados" type="number" min="0" placeholder="Metros Cuadrados" value="<?php echo $fila->metrosCuadrados; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">Fecha Inicio Contrato<a class="invisible">asasas</a></label>
                    <div class="col-sm-2">
                        <input type="date" id="fechaInicio" name="fechaInicio" class="form-control" value="<?php echo $fila->fechaInicioContrato; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">Fecha Término Contrato<a class="invisible">asal</a></label>
                    <div class="col-sm-2">
                        <input type="date" id="fechaTermino" name="fechaTermino" class="form-control" value="<?php echo $fila->fechaTerminoContrato; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">Obra Nueva</label>
                    <input type="checkbox" id="check4" value="Obra Nueva" onclick="verificaCheck();" class="checkbox-inline" name="nuevaRemodelacion[]" <?php echo $nueva; ?>>
                    <a class="invisible">asasasasasasasasaasasaa</a>
                    <label class="control-label">Remodelación</label>
                    <a class="invisible">a</a>
                    <input type="checkbox" id="check5" value="Remodelacion" onclick="verificaCheck();" class="checkbox-inline" name="nuevaRemodelacion[]" <?php echo $remodel; ?>>
                </div>
                <br>
                <center><img class="imagenes" src="../assets/img/InfoMandante.png" height="70px"></center>
                <br>
                <div class="form-group">
                    <label class="col-sm-5 control-label">Facultad</label>
                    <input type="checkbox" id="input1" value="Facultad" onclick="verifica();" class="checkbox-inline" name="opcion[]" <?php echo $facul; ?>>
                    <a class="invisible">as</a>
                    <label class="control-label">Administración Central</label>
                    <a class="invisible">a</a>
                    <input type="checkbox" id="input2" value="Administración Central" onclick="verifica();" class="checkbox-inline" name="opcion[]" <?php echo $admin; ?>>
                    <a class="invisible">as</a>
                    <label class="control-label">Otro</label>
                    <a class="invisible">a</a>
                    <input type="checkbox" id="input3" value="Otro" onclick="verifica();" class="checkbox-inline" name="opcion[]" <?php echo $otro; ?>>
                </div>
                <!-- este div se muestra en la opion unidad Academica o se oculta segun la opción que el usuario seleccione-->
                <div id="div1" style="display: none">
                    <div class="form-group">
                        <label class="control-label col-sm-4"></label>
                        <div class="col-sm-4">
                            <select class="form-control" id="facu" name="facultad[]" onchange="unidadAcademica();">
                                <option value="" disabled="" selected="<?php echo $fila->unidadOtro; ?>>">Seleccione una de estas opciones</option>
                                <?php
                                while ($facu = $db->fetch_row($facultad)) {
                                  if($fila->unidadOtro ==$facu['nombre']){?>
                                    <option value="<?php echo $facu['id']; ?>" selected><?php echo $facu['nombre']; ?></option>
                                  <?php } ?>
                                    <option value="<?php echo $facu['id']; ?>"><?php echo $facu['nombre']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="unidadAcademica"></label>
                        <div id="primerSelect" style="display: none">
                            <div class="col-sm-4">
                                <select class="form-control unidadSelect" id="uni1" name="unidad1[]">
                                    <option value="" selected="<?php echo $fila->unidad; ?>" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($primeraUnidad = $db->fetch_row($b)) {
                                      if($fila->unidad ==$primeraUnidad['nombre']){?>
                                        <option value="<?php echo $primeraUnidad['nombre']; ?>" selected><?php echo $primeraUnidad['nombre']; ?></option>
                                      <?php } ?>
                                        <option value="<?php echo $primeraUnidad['nombre']; ?>"><?php echo $primeraUnidad['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="segundoSelect" style="display: none">
                            <div class="col-sm-4">
                                <select class="form-control unidadSelect" id="uni2" name="unidad2[]">
                                    <option value="" selected="<?php echo $fila->unidad; ?>" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($segundaUnidad = $db->fetch_row($d)) {
                                      if($fila->unidad ==$segundaUnidad['nombre']){?>
                                        <option value="<?php echo $segundaUnidad['nombre']; ?>" selected><?php echo $segundaUnidad['nombre']; ?></option>
                                      <?php } ?>
                                        <option value="<?php echo $segundaUnidad['nombre']; ?>"><?php echo $segundaUnidad['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="tercerSelect" style="display: none">
                            <div class="col-sm-4">
                                <select class="form-control unidadSelect" id="uni3" name="unidad3[]">
                                    <option value="" selected="<?php echo $fila->unidad; ?>" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($terceraUnidad = $db->fetch_row($f)) {
                                      if($fila->unidad ==$terceraUnidad['nombre']){?>
                                        <option value="<?php echo $terceraUnidad['nombre']; ?>" selected><?php echo $terceraUnidad['nombre']; ?></option>
                                      <?php } ?>
                                        <option value="<?php echo $terceraUnidad['nombre']; ?>"><?php echo $terceraUnidad['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="cuartoSelect" style="display: none">
                            <div class="col-sm-4">
                                <select class="form-control unidadSelect" id="uni4" name="unidad4[]">
                                    <option value="" selected="<?php echo $fila->unidad; ?>" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($cuartaUnidad = $db->fetch_row($h)) {
                                      if($fila->unidad ==$cuartaUnidad['nombre']){?>
                                        <option value="<?php echo $cuartaUnidad['nombre']; ?>" selected><?php echo $cuartaUnidad['nombre']; ?></option>
                                      <?php } ?>
                                        <option value="<?php echo $cuartaUnidad['nombre']; ?>"><?php echo $cuartaUnidad['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="quintoSelect" style="display: none">
                            <div class="col-sm-4">
                                <select class="form-control unidadSelect" id="uni5" name="unidad5[]">
                                    <option value="" selected="<?php echo $fila->unidad; ?>" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($quintaUnidad = $db->fetch_row($j)) {
                                      if($fila->unidad ==$quintaUnidad['nombre']){?>
                                        <option value="<?php echo $quintaUnidad['nombre']; ?>" selected><?php echo $quintaUnidad['nombre']; ?></option>
                                      <?php } ?>
                                        <option value="<?php echo $quintaUnidad['nombre']; ?>"><?php echo $quintaUnidad['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="sextoSelect" style="display: none">
                            <div class="col-sm-4">
                                <select class="form-control unidadSelect" id="uni6" name="unidad6[]">
                                    <option value="" selected="<?php echo $fila->unidad; ?>" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($sextaUnidad = $db->fetch_row($l)) {
                                      if($fila->unidad ==$sextaUnidad['nombre']){?>
                                        <option value="<?php echo $sextaUnidad['nombre']; ?>" selected><?php echo $sextaUnidad['nombre']; ?></option>
                                      <?php } ?>
                                        <option value="<?php echo $sextaUnidad['nombre']; ?>"><?php echo $sextaUnidad['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="septimoSelect" style="display: none">
                            <div class="col-sm-4">
                                <select class="form-control unidadSelect" id="uni7" name="unidad7[]">
                                    <option value="" selected="<?php echo $fila->unidad; ?>" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($septimaUnidad = $db->fetch_row($n)) {
                                      if($fila->unidad ==$septimaUnidad['nombre']){?>
                                        <option value="<?php echo $septimaUnidad['nombre']; ?>" selected><?php echo $septimaUnidad['nombre']; ?></option>
                                      <?php } ?>
                                        <option value="<?php echo $septimaUnidad['nombre']; ?>"><?php echo $septimaUnidad['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="octavoSelect" style="display: none">
                            <div class="col-sm-4">
                                <select class="form-control unidadSelect" id="uni8" name="unidad8[]">
                                    <option value="" selected="<?php echo $fila->unidad; ?>" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($octavaUnidad = $db->fetch_row($o)) {
                                      if($fila->unidad ==$octavaUnidad['nombre']){?>
                                        <option value="<?php echo $octavaUnidad['nombre']; ?>" selected><?php echo $octavaUnidad['nombre']; ?></option>
                                      <?php } ?>
                                        <option value="<?php echo $octavaUnidad['nombre']; ?>"><?php echo $octavaUnidad['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="ultimoSelect" style="display: none">
                            <div class="col-sm-4">
                                <select class="form-control unidadSelect" id="uni9" name="unidad9[]">
                                    <option value="" selected="<?php echo $fila->unidad; ?>" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($novenaUnidad = $db->fetch_row($q)) {
                                      if($fila->unidad ==$novenaUnidad['nombre']){?>
                                        <option value="<?php echo $novenaUnidad['nombre']; ?>" selected><?php echo $novenaUnidad['nombre']; ?></option>
                                      <?php } ?>
                                        <option value="<?php echo $novenaUnidad['nombre']; ?>"><?php echo $novenaUnidad['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="usuario"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Usuario" name="usuario" id="usuario" value="<?php echo $fila->usuario; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="edificio"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Edificio (información ejecución de la obra)" name="edificio" id="edificio" value="<?php echo $fila->edificio; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="piso"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Piso (información ejecución de la obra)" name="piso" id="piso" value="<?php echo $fila->piso; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="recinto"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Recinto (información ejecución de la obra)" name="recinto" id="recinto" value="<?php echo $fila->recinto; ?>">
                        </div>
                    </div>
                </div>
                <div id="div2" style="display: none">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="unidadAdministrativa"></label>
                        <div class="col-sm-4">
                            <select  class="form-control" id="unity" name="unity[]">
                                <option value="" disabled="" selected="<?php echo $fila->unidadOtro; ?>">Seleccione una Unidad</option>
                                <?php while ($uni = $db->fetch_row($unidadAdmin)) {
                                  if($fila->unidadOtro ==$uni['nombre']){?>
                                    <option value="<?php echo $uni['nombre']; ?>" selected><?php echo $uni['nombre']; ?></option>
                                  <?php } ?>
                                    <option value="<?php echo $uni['nombre']; ?>"><?php echo $uni['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4"></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="unidad" name="unidad" placeholder="Área o Unidad Administrativa" value="<?php echo $fila->unidad; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="usuario1"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Usuario" name="usuario1" id="usuario1" value="<?php echo $fila->usuario; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="edificio1"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Edificio (información ejecución de la obra)" name="edificio1" id="edificio1" value="<?php echo $fila->edificio; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="piso1"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Piso (información ejecución de la obra)" name="piso1" id="piso1" value="<?php echo $fila->piso; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="recinto1"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Recinto (información ejecución de la obra)" name="recinto1" id="recinto1" value="<?php echo $fila->recinto; ?>">
                        </div>
                    </div>
                </div>
                <div id="div3" style="display: none">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="otro"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Unidad / Área" id="otro" name="otro" value="<?php echo $fila->unidad; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="usuario2"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Usuario" name="usuario2" id="usuario2" value="<?php echo $fila->usuario; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="edificio2"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Edificio (información ejecución de la obra)" name="edificio2" id="edificio2" value="<?php echo $fila->edificio; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="piso2"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Piso (información ejecución de la obra)" name="piso2" id="piso2" value="<?php echo $fila->piso; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="recinto2"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Recinto (información ejecución de la obra)" name="recinto2" id="recinto2" value="<?php echo $fila->recinto; ?>">
                        </div>
                    </div>
                </div>
                <br>
                <center><img class="imagenes" src="../assets/img/InfoPresupuesto.png" height="70px"></center>
                <br>
                <div class="form-group">
                    <label class="control-label col-sm-4"></label>
                    <div class="col-sm-4">
                        <select class="form-control" name="contratista[]" required="">
                            <option value="" selected="<?php echo $fila->empresaContratista; ?>" disabled="">Seleccione Empresa / Contratista</option>
                            <?php
                            while ($row = $db->fetch_row($contratista)) {
                              if($fila->empresaContratista ==$row['nombre']){?>
                                <option value="<?php echo $row['nombre']; ?>" selected><?php echo $row['nombre']; ?></option>
                              <?php } ?>
                                <option value="<?php echo $row['nombre']; ?>"><?php echo $row['nombre']; ?></option>

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div id="contenedorPresupuesto">
                    <div id="divi1">
                        <div class="form-group">
                            <label class="control-label col-sm-4"></label>
                            <div class="col-sm-4">
                                <input type="number" required="" onchange="calculo(); validaSoloNumerico(this.val);" min="0" placeholder="Presupuesto ($PESO)" class="form-control" name="presupuesto" id="presupuesto" value="<?php echo $fila->presupuesto; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="neto">Neto:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" readonly="" name="neto" id="neto" value="<?php echo $fila->neto; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="iva">I.V.A:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" readonly="" name="iva" id="iva" value="<?php echo $fila->iva; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4"></label>
                            <div class="col-sm-4">
                                <select class="form-control" required="" name="cargo[]" id="cargo">
                                    <option disabled="" value="" selected="<?php echo $fila->cargoNroCuenta; ?>">Seleccione Cargo Nro. Cuenta</option>
                                    <?php
                                    while ($datos = $db->fetch_row($ejecuta)) {
                                      if($fila->cargoNroCuenta ==$datos['nombre']){?>
                                        <option value="<?php echo $datos['nombre']; ?>" selected><?php echo $datos['nombre']; ?></option>
                                      <?php } ?>
                                        <option value="<?php echo $datos['nombre']; ?>"><?php echo $datos['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <center><img class="imagenes" src="../assets/img/InfoComplementaria.png" height="70px"></center>
                <div id="observaciones">
                    <br>
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="observaciones" placeholder="Observaciones" rows="5"><?php echo $fila->observaciones; ?></textarea>
                        </div>
                    </div>
                </div>
                <br>
                    <center><input type="submit" id="enviarDatos" value="Enviar" class="btn btn-primary botonEnviar"></center>
            </form>
        </div>
        <?php // include './footer.php'; ?>
        <script src="../librerias/bootstrap-3.3.6/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../librerias/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script>
        <script>
                                    $("#formularioxd").bind('submit', function (event) {
                                        if (validar() == false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        } else if (verifica() == false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        } else if (unidadAcademica() == false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                    });
        </script>
        <script>
            function validaSoloNumerico(cadena) {
                var patron = /^\d*$/;
                if (!cadena.search(patron))
                    return true;
                else
                    return false;
            }
        </script>
        <script type="text/javascript">
            function calculo() {
                //tasa de impuesto
                var tasa = 1.19;
                //monto a calcular el impuesto
                var monto = $("input[name=presupuesto]").val();
                //calxculo del impuesto
                var iva = Math.round((monto / tasa));
                var neto = Math.round((monto - iva));
                //se carga el iva en el campo correspondien te
                $("input[name=iva]").val(parseFloat((neto)));
                //se carga el total en el campo correspondiente

                $("input[name=neto]").val(parseInt(iva));
            }
        </script>
        <script type="text/javascript">
            function validar() {
                //obteniendo el valor de los inputs
                var nombreObra = $('#nombre').val();
                var campus = $('#campus').val();
                var contratista = $('#contratista').val();
                var docResolucion = $('#resolucion').val();
                var fechaInicio = $('#fechaInicio').val();
                var fechaTermino = $('#fechaTermino').val();
                //obteniendo los checkbox
                var checkFacultad = document.getElementById('input1');
                var checkAdmin = document.getElementById('input2');
                var checkOtro = document.getElementById('input3');
                var nueva = document.getElementById('check4');
                var remodelacion = document.getElementById('check5');

                if (nombreObra == '' || campus == '' || contratista == '' || docResolucion == '' || fechaInicio == '' || fechaTermino == '') {
                    alert('Debe completar todos los campos requeridos');
                    return false;
                } else if (checkFacultad.checked == false && checkAdmin.checked == false && checkOtro.checked == false) {
                    alert('Debe seleccionar Facultas, Administración u Otro');
                    return false;
                } else if (nueva.checked == false && remodelacion.checked == false) {
                    alert('Debe seleccionar Obra Nueva o Remodelación');
                    return false;
                } else {
                    return true;
                }

            }
        </script>
        <script type="text/javascript">
            //hacer por clase
            $('#actaVisita').bind('change', function () {
                var peso = this.files[0].size;
                if (peso > 1000000) {
                    alert("Tamaño máximo 1MB");
                    this.value = '';
                }
            });
            $('#actaReceptacion').bind('change', function () {
                var peso = this.files[0].size;
                if (peso > 1000000) {
                    alert("Tamaño máximo 1MB");
                    this.value = '';
                }
            });
            $('#informes').bind('change', function () {
                var peso = this.files[0].size;
                if (peso > 6000000) {
                    alert("Tamaño máximo 6MB");
                    this.value = '';
                }
            });
            $('#resolucion').bind('change', function () {
                var peso = this.files[0].size;
                if (peso > 1000000) {
                    alert("Tamaño máximo 1MB");
                    this.value = '';
                }
            });
            $('#planimetria').bind('change', function () {
                var peso = this.files[0].size;
                if (peso > 8000000) {
                    alert("Tamaño máximo 8MB");
                    this.value = '';
                }
            });
            $('#especificaciones').bind('change', function () {
                var peso = this.files[0].size;
                if (peso > 1000000) {
                    alert("Tamaño máximo 1MB");
                    this.value = '';
                }
            });
        </script>
        <script type="text/javascript">
            function unidadAcademica() {
                var div = document.getElementById('primerSelect');
                var div2 = document.getElementById('segundoSelect');
                var div3 = document.getElementById('tercerSelect');
                var div4 = document.getElementById('cuartoSelect');
                var div5 = document.getElementById('quintoSelect');
                var div6 = document.getElementById('sextoSelect');
                var div7 = document.getElementById('septimoSelect');
                var div8 = document.getElementById('octavoSelect');
                var div9 = document.getElementById('ultimoSelect');
                var uni1 = document.getElementById('uni1');
                var uni2 = document.getElementById('uni2');
                var uni3 = document.getElementById('uni3');
                var uni4 = document.getElementById('uni4');
                var uni5 = document.getElementById('uni5');
                var uni6 = document.getElementById('uni6');
                var uni7 = document.getElementById('uni7');
                var uni8 = document.getElementById('uni8');
                var uni9 = document.getElementById('uni9');
                var select = document.getElementById('facu').value;

                if (select == 1) {
                    div.style.display = "block";
                    div2.style.display = "none";
                    div3.style.display = "none";
                    div4.style.display = "none";
                    div5.style.display = "none";
                    div6.style.display = "none";
                    div7.style.display = "none";
                    div8.style.display = "none";
                    div9.style.display = "none";
                    uni1.required = true;
                    uni2.required = false;
                    uni3.required = false;
                    uni4.required = false;
                    uni5.required = false;
                    uni6.required = false;
                    uni7.required = false;
                    uni8.required = false;
                    uni9.required = false;
                    return true;
                } else if (select == 2) {
                    div2.style.display = "block";
                    div.style.display = "none";
                    div3.style.display = "none";
                    div4.style.display = "none";
                    div5.style.display = "none";
                    div6.style.display = "none";
                    div7.style.display = "none";
                    div8.style.display = "none";
                    div9.style.display = "none";
                    uni2.required = true;
                    uni1.required = false;
                    uni3.required = false;
                    uni4.required = false;
                    uni5.required = false;
                    uni6.required = false;
                    uni7.required = false;
                    uni8.required = false;
                    uni9.required = false;
                    return true;
                } else if (select == 3) {
                    div3.style.display = "block";
                    div.style.display = "none";
                    div2.style.display = "none";
                    div4.style.display = "none";
                    div5.style.display = "none";
                    div6.style.display = "none";
                    div7.style.display = "none";
                    div8.style.display = "none";
                    div9.style.display = "none";
                    uni3.required = true;
                    uni1.required = false;
                    uni2.required = false;
                    uni4.required = false;
                    uni5.required = false;
                    uni6.required = false;
                    uni7.required = false;
                    uni8.required = false;
                    uni9.required = false;
                    return true;
                } else if (select == 4) {
                    div4.style.display = "block";
                    div3.style.display = "none";
                    div.style.display = "none";
                    div2.style.display = "none";
                    div5.style.display = "none";
                    div6.style.display = "none";
                    div7.style.display = "none";
                    div8.style.display = "none";
                    div9.style.display = "none";
                    uni4.required = true;
                    uni1.required = false;
                    uni2.required = false;
                    uni3.required = false;
                    uni5.required = false;
                    uni6.required = false;
                    uni7.required = false;
                    uni8.required = false;
                    uni9.required = false;
                    return true;
                } else if (select == 5) {
                    div5.style.display = "block";
                    div3.style.display = "none";
                    div.style.display = "none";
                    div2.style.display = "none";
                    div4.style.display = "none";
                    div6.style.display = "none";
                    div7.style.display = "none";
                    div8.style.display = "none";
                    div9.style.display = "none";
                    uni5.required = true;
                    uni1.required = false;
                    uni2.required = false;
                    uni3.required = false;
                    uni4.required = false;
                    uni6.required = false;
                    uni7.required = false;
                    uni8.required = false;
                    uni9.required = false;
                    return true;
                } else if (select == 6) {
                    div6.style.display = "block";
                    div3.style.display = "none";
                    div.style.display = "none";
                    div2.style.display = "none";
                    div4.style.display = "none";
                    div5.style.display = "none";
                    div7.style.display = "none";
                    div8.style.display = "none";
                    div9.style.display = "none";
                    uni6.required = true;
                    uni4.required = false;
                    uni1.required = false;
                    uni2.required = false;
                    uni3.required = false;
                    uni5.required = false;
                    uni7.required = false;
                    uni8.required = false;
                    uni9.required = false;
                    return true;
                } else if (select == 7) {
                    div7.style.display = "block";
                    div3.style.display = "none";
                    div.style.display = "none";
                    div2.style.display = "none";
                    div4.style.display = "none";
                    div5.style.display = "none";
                    div6.style.display = "none";
                    div8.style.display = "none";
                    div9.style.display = "none";
                    uni7.required = true;
                    uni4.required = false;
                    uni1.required = false;
                    uni2.required = false;
                    uni3.required = false;
                    uni5.required = false;
                    uni6.required = false;
                    uni8.required = false;
                    uni9.required = false;
                    return true;
                } else if (select == 8) {
                    div8.style.display = "block";
                    div3.style.display = "none";
                    div.style.display = "none";
                    div2.style.display = "none";
                    div4.style.display = "none";
                    div5.style.display = "none";
                    div6.style.display = "none";
                    div7.style.display = "none";
                    div9.style.display = "none";
                    uni8.required = true;
                    uni4.required = false;
                    uni1.required = false;
                    uni2.required = false;
                    uni3.required = false;
                    uni5.required = false;
                    uni6.required = false;
                    uni7.required = false;
                    uni9.required = false;
                    return true;
                } else if (select == 9) {
                    div9.style.display = "block";
                    div3.style.display = "none";
                    div.style.display = "none";
                    div2.style.display = "none";
                    div4.style.display = "none";
                    div5.style.display = "none";
                    div6.style.display = "none";
                    div7.style.display = "none";
                    div8.style.display = "none";
                    uni9.required = true;
                    uni4.required = false;
                    uni1.required = false;
                    uni2.required = false;
                    uni3.required = false;
                    uni5.required = false;
                    uni6.required = false;
                    uni7.required = false;
                    uni8.required = false;
                    return true;
                }
            }
        </script>
        <script type="text/javascript">
            function verifica() {
                var check1 = document.getElementById('input1');
                var check2 = document.getElementById('input2');
                var check3 = document.getElementById('input3');
                var div1 = document.getElementById('div1');
                var div2 = document.getElementById('div2');
                var div3 = document.getElementById('div3');
                var facu = document.getElementById('facu');
                var unity = document.getElementById('unity');
                var unidad = document.getElementById('unidad');
                var otro = document.getElementById('otro');
                if (check1.checked == true && check2.checked == false && check3.checked == false) {
                    div1.style.display = "block";
                    facu.required = true;
                    unity.required = false;
                    unidad.required = false;
                    otro.required = false;
                    return true;
                } else if (check1.checked == false && check2.checked == false && check3.checked == false) {
                    facu.required = false;
                    unity.required = false;
                    unidad.required = false;
                    otro.required = false;
                    div1.style.display = "none";
                    div2.style.display = "none";
                    div3.style.display = "none";
                    return false;
                } else if (check2.checked == true && check1.checked == false && check3.checked == false) {
                    div2.style.display = "block";
                    facu.required = false;
                    otro.required = false;
                    unity.required = true;
                    unidad.required = true;
                    return true;
                } else if (check3.checked == true && check2.checked == false && check1.checked == false) {
                    div3.style.display = "block";
                    otro.required = true;
                    facu.required = false;
                    unity.required = false;
                    unidad.required = false;
                    return true;
                } else if (check1.checked == true && check2.checked == true) {
                    alert('Debe dejar de seleccionar un input para seleccionar otro');
                    check1.checked = false;
                    check2.checked = false;
                    div1.style.display = "none";
                    div2.style.display = "none";
                    return false;
                } else if (check1.checked == true && check3.checked == true) {
                    alert('Debe dejar de seleccionar un input para seleccionar otro');
                    check1.checked = false;
                    check3.checked = false;
                    div1.style.display = "none";
                    div3.style.display = "none";
                    return false;
                } else if (check2.checked == true && check3.checked == true) {
                    alert('Debe dejar de seleccionar un input para seleccionar otro');
                    check2.checked = false;
                    check3.checked = false;
                    div2.style.display = "none";
                    div3.style.display = "none";
                    return false;
                } else {
                    return true;
                }
            }
        </script>
        <script>
            function verificaCheck() {
                var check = document.getElementById('check4');
                var checks = document.getElementById('check5');
                if (check.checked == true && checks.checked == true) {
                    alert('Debe dejar de seleccionar un input para seleccionar otro');
                    check.checked = false;
                    checks.checked = false;
                    return false;
                } else {
                    return true;
                }
            }
        </script>
    </body>
</html>
