<?php
//include './header.php';
require '../funciones/conexion.php';

$db = new Conect_MySql();
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
              <!--<script src="../assets/js/funcionMuestraOculta.js" type="text/javascript"></script>-->
              <!--<script src="../assets/js/funcionMuestraPresupuesto.js" type="text/javascript"></script>-->
    </head>
    <body>
        <div class="container-fluid">
            <br>
            <form enctype="multipart/form-data" id="formularioxd" action="../funcionesModuloObras/insertObrasNuevas.php" method="POST" class="form-horizontal">
                <br>
                <div id="imagenInfoObra">
                    <center><img  class="imagenes" src="../assets/img/InfoObra.png" height="70px"></center>
                </div>
                <br>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="nombre"></label>
                    <div class="col-sm-4 text-center">
                        <input class="form-control" type="text" required="" placeholder="Nombre de la Obra" name="nombre" id="nombre">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="nombre"></label>
                    <div class="col-sm-4">
                        <select class="form-control" required="" id="campus" name="campus[]">
                            <option value="" disabled="true" selected="">Seleccione Campus</option>
                            <?php
                            while ($datos2 = $db->fetch_row($ejecutar)) {
                                ?>
                                <option value="<?php echo $datos2['nombre']; ?>"><?php echo $datos2['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4"></label>
                    <div class="col-sm-4">
                        <input class="form-control" name="metrosCuadrados" type="number" min="0" placeholder="Metros Cuadrados (de no aplicar ingresar 0)">
                    </div>
                </div>
               <!-- <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-4">
                        <select class="form-control" required="" name="encargado[]">
                            <option value="">Seleccione Encargado de Obra</option>
                            <?php
                            while ($encargado = $db->fetch_row($exe)) {
                                ?>
                                <option value="<?php echo $encargado['nombre']; ?>"><?php echo $encargado['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>-->
                <div class="form-group">
                    <label class="col-sm-6 control-label">Fecha Inicio Contrato<a class="invisible">asasas</a></label>
                    <div class="col-sm-2">
                        <input type="date" id="fechaInicio" name="fechaInicio" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">Fecha Término Contrato<a class="invisible">asal</a></label>
                    <div class="col-sm-2">
                        <input type="date" id="fechaTermino" name="fechaTermino" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">Obra Nueva</label>
                    <input type="checkbox" id="check4" value="Obra Nueva" onclick="verificaCheck();" class="checkbox-inline" name="nuevaRemodelacion[]">
                    <a class="invisible">asasasasasasasasaasasaa</a>
                    <label class="control-label">Remodelación</label>
                    <a class="invisible">a</a>
                    <input type="checkbox" id="check5" value="Remodelacion" onclick="verificaCheck();" class="checkbox-inline" name="nuevaRemodelacion[]">
                </div>
                <br>
                <center><img class="imagenes" src="../assets/img/InfoMandante.png" height="70px"></center>
                <br>
                <!--<div class="form-group">
                    <label class="control-label col-sm-4" for="select"></label>
                    <div class="col-sm-4">
                        <select class="form-control" required="" id="select" name="select[]">
                            <option value="" disabled="" selected="">Seleccione una de estas opciones</option>
                            <option value="div1">Facultad</option>
                            <option value="div2"><?php echo utf8_decode('Administración Central'); ?></option>
                            <option value="div3">Otro</option>
                        </select>
                    </div>
                </div>-->
                <div class="form-group">
                    <label class="col-sm-5 control-label">Facultad</label>
                    <input type="checkbox" id="input1" value="Facultad" onclick="verifica();" class="checkbox-inline" name="opcion[]">
                    <a class="invisible">as</a>
                    <label class="control-label">Administración Central</label>
                    <a class="invisible">a</a>
                    <input type="checkbox" id="input2" value="Administración Central" onclick="verifica();" class="checkbox-inline" name="opcion[]">
                    <a class="invisible">as</a>
                    <label class="control-label">Otro</label>
                    <a class="invisible">a</a>
                    <input type="checkbox" id="input3" value="Otro" onclick="verifica();" class="checkbox-inline" name="opcion[]">
                </div>
                <!-- este div se muestra en la opion unidad Academica o se oculta segun la opción que el usuario seleccione-->
                <div id="div1" style="display: none">
                    <div class="form-group">
                        <label class="control-label col-sm-4"></label>
                        <div class="col-sm-4">
                            <select class="form-control" id="facu" name="facultad[]" onchange="unidadAcademica();">
                                <option value="" disabled="" selected="">Seleccione una de estas opciones</option>
                                <?php
                                while ($facu = $db->fetch_row($facultad)) {
                                    ?>
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
                                    <option value="" selected="" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($primeraUnidad = $db->fetch_row($b)) {
                                        ?>
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
                                    <option value="" selected="" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($segundaUnidad = $db->fetch_row($d)) {
                                        ?>
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
                                    <option value="" selected="" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($terceraUnidad = $db->fetch_row($f)) {
                                        ?>
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
                                    <option value="" selected="" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($cuartaUnidad = $db->fetch_row($h)) {
                                        ?>
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
                                    <option value="" selected="" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($quintaUnidad = $db->fetch_row($j)) {
                                        ?>
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
                                    <option value="" selected="" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($sextaUnidad = $db->fetch_row($l)) {
                                        ?>
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
                                    <option value="" selected="" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($septimaUnidad = $db->fetch_row($n)) {
                                        ?>
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
                                    <option value="" selected="" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($octavaUnidad = $db->fetch_row($o)) {
                                        ?>
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
                                    <option value="" selected="" disabled="">Seleccione una unidad</option>
                                    <?php
                                    while ($novenaUnidad = $db->fetch_row($q)) {
                                        ?>
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
                            <input class="form-control" type="text" placeholder="Usuario" name="usuario" id="usuario">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="edificio"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Edificio (información ejecución de la obra)" name="edificio" id="edificio">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="piso"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Piso (información ejecución de la obra)" name="piso" id="piso">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="recinto"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Recinto (información ejecución de la obra)" name="recinto" id="recinto">
                        </div>
                    </div>
                </div>
                <div id="div2" style="display: none">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="unidadAdministrativa"></label>
                        <div class="col-sm-4">
                            <select  class="form-control" id="unity" name="unity[]">
                                <option value="" disabled="" selected="">Seleccione una Unidad</option>
                                <?php while ($uni = $db->fetch_row($unidadAdmin)) { ?>
                                    <option value="<?php echo $uni['nombre']; ?>"><?php echo $uni['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4"></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="unidad" name="unidad" placeholder="Área o Unidad Administrativa">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="usuario1"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Usuario" name="usuario1" id="usuario1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="edificio1"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Edificio (información ejecución de la obra)" name="edificio1" id="edificio1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="piso1"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Piso (información ejecución de la obra)" name="piso1" id="piso1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="recinto1"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Recinto (información ejecución de la obra)" name="recinto1" id="recinto1">
                        </div>
                    </div>
                </div>
                <div id="div3" style="display: none">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="otro"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Unidad / Área" id="otro" name="otro">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="usuario2"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Usuario" name="usuario2" id="usuario2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="edificio2"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Edificio (información ejecución de la obra)" name="edificio2" id="edificio2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="piso2"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Piso (información ejecución de la obra)" name="piso2" id="piso2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="recinto2"></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Recinto (información ejecución de la obra)" name="recinto2" id="recinto2">
                        </div>
                    </div>
                </div>
                <br>
                <center><img class="imagenes" src="../assets/img/InfoPresupuesto.png" height="70px"></center>
                <br>
                <!--<div class="form-group">
                    <label class="control-label col-sm-4"></label>
                    <div class="col-sm-4">
                        <input type="text" id="birds" class="form-control" required="" placeholder="Busque Empresa / Contratista" name="contratista" id="contratista">
                    </div>
                </div>-->
                <div class="form-group">
                    <label class="control-label col-sm-4"></label>
                    <div class="col-sm-4">
                        <select class="form-control" name="contratista[]" required="">
                            <option value="" selected="" disabled="">Seleccione Empresa / Contratista</option>
                            <?php
                            while ($row = $db->fetch_row($contratista)) {
                                ?>
                                <option value="<?php echo $row['nombre']; ?>"><?php echo $row['nombre']; ?></option>

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- <div class="form-group">
                     <label class="control-label col-sm-4" for="select"></label>
                     <div class="col-sm-4">
                         <select class="form-control" required="" id="select2" name="select2[]">
                             <option value="" disabled="" selected="">Seleccione una de estas opciones</option>
                             <option value="divi1">$ PESO</option>
                             <option value="divi2">UF</option>
                         </select>
                     </div>
                 </div>-->
                <div id="contenedorPresupuesto">
                    <div id="divi1">
                        <div class="form-group">
                            <label class="control-label col-sm-4"></label>
                            <div class="col-sm-4">
                                <input type="number" required="" onchange="calculo(); validaSoloNumerico(this.val);" min="0" placeholder="Presupuesto ($PESO)" class="form-control" name="presupuesto" id="presupuesto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="neto">Neto:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" readonly="" name="neto" id="neto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="iva">I.V.A:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" readonly="" name="iva" id="iva">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4"></label>
                            <div class="col-sm-4">
                                <select class="form-control" required="" name="cargo[]" id="cargo">
                                    <option disabled="" value="" selected="">Seleccione Cargo Nro. Cuenta</option>
                                    <?php
                                    while ($datos = $db->fetch_row($ejecuta)) {
                                        ?>
                                        <option value="<?php echo $datos['nombre']; ?>"><?php echo $datos['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!--
                <center><img class="imagenes" src="../assets/img/InfoArchivos.png" height="70px"></center>
                <br>
                <br>
                <div class="form-group">
                    <label class="control-label col-sm-2" style="font-weight: normal;">Acta Visita terreno (1 MB)</label>
                    <div class="col-sm-3">
                        <input id="actaVisita" name="actaVisita" type="file" accept=".pdf, .jpg" class="btn btn-primary">
                    </div>
                    <label class="control-label col-sm-3" style="font-weight: normal">Acta Recepción y Apertura (1 MB)</label>
                    <div class="col-sm-4">
                        <input id="actaReceptacion" name="actaReceptacion" type="file" accept=".pdf, .jpg" class="btn btn-primary">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="control-label col-sm-2" style="font-weight: normal">Informes y Contrato (6 MB)</label>
                    <div class="col-sm-4">
                        <input id="informes" name="informes" type="file" accept=".pdf, .jpg" class="btn btn-primary">
                    </div>
                    <label class="control-label col-sm-2" style="font-weight: normal">Resolución (1 MB, Obligatoria)</label>
                    <div class="col-sm-4">
                        <input id="resolucion" name="resolucion" required="" type="file" accept=".pdf, .jpg" class="btn btn-primary">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="control-label col-sm-2" style="font-weight: normal">Planimetrías (8 MB)</label>
                    <div class="col-sm-3">
                        <input id="planimetria" name="planimetria" type="file" accept=".pdf, .jpg" class="btn btn-primary">
                    </div>
                    <label class="control-label col-sm-3" style="font-weight: normal">Especificaciones Técnicas (1MB)</label>
                    <div class="col-sm-4">
                        <input id="especificaciones" name="especificaciones" type="file" accept=".pdf, .jpg" class="btn btn-primary">
                    </div>
                </div>
              -->
                <br>
                <br>
                <center><img class="imagenes" src="../assets/img/InfoComplementaria.png" height="70px"></center>
                <div id="observaciones">
                    <br>
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="observaciones" placeholder="Observaciones" rows="5"></textarea>
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
                                        } else if (tipoValor() == false) {
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
                <!--<script>
                   $('#unidadAcademica').easyAutocomplete({

                        url: function (phrase) {
                            if (phrase !== "") {
                                return window.origin + "/funcionesModuloObras/filtroUnidadAcademica.php?palabra=" + phrase;
                            }
                        },
                        ajaxSettings: {
                            dataType: "json"
                        },
                        requestDelay: 100,
                        getValue: function (element) {
                            return element;
                        }
                    });
                </script>-->
               <!-- <script>
                    $('#contratista').easyAutocomplete({
                        url: function (phrase) {
                            if (phrase !== "") {
                                return window.location.origin + "/funcionesModuloObras/filtroContratista.php?palabra=" + phrase;
                            }
                        },
                        ajaxSettings: {
                            dataType: "json"
                        },
                        requestDelay: 100,
                        getValue: function (element) {
                            return element;
                        }
                    });
                </script>-->
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
                    alert('Debe seleccionar Facultad, Administración u Otro');
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
<!-- <script type="text/javascript">
function tipoValor() {
    var cbx1 = document.getElementById('check1');
    var cbx2 = document.getElementById('check2');
    var divi1 = document.getElementById('divi1');
    var divi2 = document.getElementById('divi2');
    var peso = document.getElementById('presupuesto');
    var uf = document.getElementById('uf');
    var cuentaPeso = document.getElementById('cargo');
    var cuentaUF = document.getElementById('cargo2');

    if (cbx1.checked == true && cbx2.checked == false) {
        divi1.style.display = "block";
        peso.required = true;
        cuentaPeso.required = true;
        return true;
    } else if (cbx2.checked == true && cbx1.checked == false) {
        divi2.style.display = "block";
        uf.required = true;
        cuentaUF.required = true;
        return true;
    } else if (cbx1.checked == true && cbx2.checked == true) {
        alert("solo puede seleccionar una de las dos opciones");
        peso.required = false;
        uf.required = false;
        cuentaPeso.required = false;
        cuentaUF.required = false;
        cbx1.checked = false;
        cbx2.checked = false;
        divi1.style.display = "none";
        divi2.style.display = "none";
        return false;
    } else if (cbx1.checked == false && cbx2.checked == false) {
        divi1.style.display = "none";
        divi2.style.display = "none";
        peso.required = false;
        cuentaPeso.required = false;
        uf.required = false;
        cuentaUF.required = false;
        return false;
    } else {
        return true;
    }
}
</script>-->
    </body>
</html>
