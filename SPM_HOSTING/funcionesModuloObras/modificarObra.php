<?php

include '/home/pcspucv/public_html/spm/wp-load.php';
$email = get_userdata(get_current_user_id())->user_firstname;
$apellido = get_userdata(get_current_user_id())->user_lastname;
$correo = get_userdata(get_current_user_id())->user_email;
$encargadoObra = $email . " " . $apellido;
//se importa la clase de la conexion
require '../funciones/conexion.php';
//se crea un objeto para heredar los métodos
$db = new Conect_MySql();

//se obtiene la fecha del día de hoy
date_default_timezone_set("America/Santiago");
$fecha = getdate();
$dia = $fecha['mday'];
$mes = $fecha['mon'];
$anio = $fecha['year'];
//se obtiene el nombre de la obra
$nombreObra = $_POST['nombre'];
//se obtiene el select[] campus
$campus = $_POST['campus'];
$idObra = $_POST['hidden'];
//se hace un ciclo paraobtener el último valor seleccionado del select campus[]
for ($i = 0; $i < count($campus); $i++) {
    $campusSi = $campus[$i];
}
//se obtiene contratista en dos variables, pero podría ser en una
$con = $_POST['contratista'];
for ($i = 0; $i < count($con); $i++) {
    $contratista = $con[$i];
}
//se consulta el nombre y el rut de contratistas, aunque se utilizará sólo el rut
$consulta = "select nombre, rut from contratistas where nombre='$contratista'";
$execute = $db->execute($consulta);
$rut = $db->fetch_row($execute);
$rutContratista = $rut['rut'];
//se obtiene el campo observaciones, y se encodea a UTF-8 para insertar en la base de datos
//y se vean los datos con asento de ser necesario
$observaciones = $_POST['observaciones'];

//se obtiene el valor de opcion, éstos son los checkbox
//Faculta, Administración Central, Otro
$seleccion = $_POST['opcion'];
for ($i = 0; $i < count($seleccion); $i++) {
    $seleccionado = $seleccion[$i];
}
//se declaran las variables que cambiarán datos segun la opción seleccionada
$unidadOtro = "";
$usuario = "";
$edificio = "";
$piso = "";
$recinto = "";
$unidad = "";

//se declaran condiciones, para que los datos que se insertan en la base de datos cambien
//segun la selección del usuario, y previamente completada de información por éste
if ($seleccionado == 'Facultad') {
    $facu = $_POST['facultad'];
    $unidadSelect = '';
    for ($i = 0; $i < count($facu); $i++) {
        $uni = $facu[$i];
    }
    if ($uni == 1) {
        $unidadOtro = 'Facultad De Arquitectura Y Urbanismo';
        $unidadSelect = $_POST['unidad1'];
        for ($i = 0; $i < count($unidadSelect); $i++) {
            $unidad = $unidadSelect[$i];
        }
    } else if ($uni == 2) {
        $unidadOtro = 'Facultad De Ciencias Del Mar Y Geografía';
        $unidadSelect = $_POST['unidad2'];
        for ($i = 0; $i < count($unidadSelect); $i++) {
            $unidad = $unidadSelect[$i];
        }
    } else if ($uni == 3) {
        $unidadOtro = 'Facultad De Filosofía Y Educación';
        $unidadSelect = $_POST['unidad3'];
        for ($i = 0; $i < count($unidadSelect); $i++) {
            $unidad = $unidadSelect[$i];
        }
    } else if ($uni == 4) {
        $unidadOtro = 'Facultad De Ciencias';
        $unidadSelect = $_POST['unidad4'];
        for ($i = 0; $i < count($unidadSelect); $i++) {
            $unidad = $unidadSelect[$i];
        }
    } else if ($uni == 5) {
        $unidadOtro = 'Facultad De Ciencias Económicas Y Administrativas';
        $unidadSelect = $_POST['unidad5'];
        for ($i = 0; $i < count($unidadSelect); $i++) {
            $unidad = $unidadSelect[$i];
        }
    } else if ($uni == 6) {
        $unidadOtro = 'Facultad De Ingeniería';
        $unidadSelect = $_POST['unidad6'];
        for ($i = 0; $i < count($unidadSelect); $i++) {
            $unidad = $unidadSelect[$i];
        }
    } else if ($uni == 7) {
        $unidadOtro = 'Facultad De Ciencias Agronómicas Y De Los Alimentos';
        $unidadSelect = $_POST['unidad7'];
        for ($i = 0; $i < count($unidadSelect); $i++) {
            $unidad = $unidadSelect[$i];
        }
    } else if ($uni == 8) {
        $unidadOtro = 'Facultad Eclesiástica De Teología';
        $unidadSelect = $_POST['unidad8'];
        for ($i = 0; $i < count($unidadSelect); $i++) {
            $unidad = $unidadSelect[$i];
        }
    } else if ($uni == 9) {
        $unidadOtro = 'Facultad De Derecho';
        $unidadSelect = $_POST['unidad9'];
        for ($i = 0; $i < count($unidadSelect); $i++) {
            $unidad = $unidadSelect[$i];
        }
    }
    $usuario = $_POST['usuario'];
    $edificio = $_POST['edificio'];
    $piso = $_POST['piso'];
    $recinto = $_POST['recinto'];
} elseif ($seleccionado == 'Administración Central') {
    $unidadSelect = $_POST['unity'];
    for ($i = 0; $i < count($unidadSelect); $i++) {
        $unidadOtro = $unidadSelect[$i];
    }
    $unidad = $_POST['unidad'];
    $usuario = $_POST['usuario1'];
    $edificio = $_POST['edificio1'];
    $piso = $_POST['piso1'];
    $recinto = $_POST['recinto1'];
} elseif ($seleccionado == 'Otro') {
    $unidadOtro = "Otro";
    $unidad = $_POST['otro'];
    $usuario = $_POST['usuario2'];
    $edificio = $_POST['edificio2'];
    $piso = $_POST['piso2'];
    $recinto = $_POST['recinto2'];
}


$unidadO = $unidadOtro;
$usu = $usuario;
$edi = $edificio;
$piso1 = $piso;
$recin = $recinto;
$uni = $unidad;

//se obtiene la última opcion seleccionada en los dos checkbox
//$peso o uf
$seleccion2 = $_POST['opcion2'];
for ($i = 0; $i < count($seleccion2); $i++) {
    $seleccionado2 = $seleccion2[$i];
}


$valor = "Peso";
$presupuesto = $_POST['presupuesto'];
$neto = $_POST['neto'];
$iva = $_POST['iva'];
$cargo = $_POST['cargo'];
for ($i = 0; $i < count($cargo); $i++) {
    $cargoCuenta = $cargo[$i];
}

$metrosCuadrados = "";
if (empty($_POST['metrosCuadrados'])) {
    $metrosCuadrados = "NO APLICA";
} else {
    $metrosCuadrados = $_POST['metrosCuadrados'];
}

$nuevaRemodela = $_POST['nuevaRemodelacion'];
for ($i = 0; $i < count($nuevaRemodela); $i++) {
    $nuevaRemodelacion = $nuevaRemodela[$i];
}
$fechaInicio = $_POST['fechaInicio'];
$fechaTermino = $_POST['fechaTermino'];


//se insertan los datos de la obraNueva
$query2 = "UPDATE obraNueva SET nombreObra='$nombreObra', campus='$campusSi', mandante='$seleccionado', unidadOtro='$unidadO', usuario='$usu', edificio='$edi', piso='$piso1',
        recinto='$recin', empresaContratista='$contratista', rutContratista='$rutContratista', valor='$valor', presupuesto='$presupuesto', neto='$neto', iva='$iva', cargoNroCuenta='$cargoCuenta', observaciones='$observaciones', unidad='$uni',
        metrosCuadrados='$metrosCuadrados', encargado='$encargadoObra', nuevaRemodelacion='$nuevaRemodelacion', fechaInicioContrato='$fechaInicio', fechaTerminoContrato='$fechaTermino' WHERE id=$idObra";

$ejecutar = $db->execute($query2);

if ($ejecutar){
  echo '<script> alert("La obra ha sido actualizada"); window.location = "../vistas/iniciarObras.php" </script>';
}else{
  echo 'No se ejecutaron los cambios';
}
?>
