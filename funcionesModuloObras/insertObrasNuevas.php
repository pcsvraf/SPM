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

$query6 = "SELECT id FROM obraNueva order by id DESC LIMIT 1";
$resultado = $db->execute($query6);
$id_ultimo = $db->fetch_row($resultado);
$ide = $id_ultimo[0] + 1;

//se insertan los datos de la obraNueva
$query = "INSERT INTO obraNueva (id, fecha, nombreObra, campus, mandante, unidadOtro, usuario, edificio, piso,"
        . "recinto, empresaContratista, rutContratista, valor, presupuesto, neto, iva, cargoNroCuenta, observaciones, idContratista, unidad,
           estado, nombreEstado, metrosCuadrados, encargado, nuevaRemodelacion, fechaInicioContrato, fechaTerminoContrato, email)"
        . "values ('$ide','$dia-$mes-$anio','$nombreObra','$campusSi','$seleccionado','$unidadO','$usu','$edi',"
        . "'$piso1','$recin','$contratista','$rutContratista','$valor','$presupuesto','$neto','$iva','$cargoCuenta','$observaciones','1','$uni','1','Obra Ingresada',
            '$metrosCuadrados','$encargadoObra','$nuevaRemodelacion','$fechaInicio','$fechaTermino','$correo')";
$ejecutar = $db->execute($query);

//se hace una consulta con el nombre de la obra para obtener el ID de ésta
//para posteriormente agregarselo a los archivos
/*
$query1 = "SELECT id FROM obraNueva order by id DESC LIMIT 1";
$resultado = $db->execute($query1);
$id = $db->fetch_row($resultado);
$idObra = $id[0];
var_dump($idObra);
//se obtiene el nombre de los archivos, para hacer una validación
$resolucion = $_FILES['resolucion']['name'];
$informes = $_FILES['informes']['name'];
$actaVisita = $_FILES['actaVisita']['name'];
$actaReceptacion = $_FILES['actaReceptacion']['name'];
$planimetria = $_FILES['planimetria']['name'];
$especificaciones = $_FILES['especificaciones']['name'];
//se comienza a hacer una validación, para insertar los archivos
if ($resolucion != '' && $informes == '' && $actaVisita == '' && $actaReceptacion == '' && $planimetria == '' &&
        $especificaciones == '') {

    $tipo = $_FILES['resolucion']['type'];
    $tamanio = $_FILES['resolucion']['size'];
    $prefix = "doc_";
    $ext = explode(".", $resolucion);
    $extencion = $ext[1];
    $ruta = $_FILES['resolucion']['tmp_name'];
    $destino = "..//archivosObrasNuevas/" . $resolucion;
    $realName = uniqid($prefix, TRUE) . '.' . $extencion;

    if (move_uploaded_file($ruta, $destino)) {
        $sql = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio','$tipo','$resolucion','$realName','resolucion')";
        $isInsert = $db->execute($sql);
        if ($isInsert) {
            echo '<script> alert("Se ingresó correctamente"); window.location = "../vistas/obrasNuevas.php" </script>';
        }
    } else {
        echo 'Lo sentimos, ocurrio un error';
    }
} else if ($resolucion != '' && $informes != '' && $actaVisita == '' && $actaReceptacion == '' && $planimetria == '' &&
        $especificaciones == '') {

    //se obtienen todos los datos de resolucion
    $tipo = $_FILES['resolucion']['type'];
    $tamanio = $_FILES['resolucion']['size'];
    $prefix = "doc_";
    $ext = explode(".", $resolucion);
    $extencion = $ext[1];
    $ruta = $_FILES['resolucion']['tmp_name'];
    $destino = "..//archivosObrasNuevas/" . $resolucion;
    $realName = uniqid($prefix, TRUE) . '.' . $extencion;

    //se obtienen todos los datos de informes
    $tipo2 = $_FILES['informes']['type'];
    $tamanio2 = $_FILES['informes']['size'];
    $prefix2 = "doc_";
    $ext2 = explode(".", $informes);
    $extencion2 = $ext[1];
    $ruta2 = $_FILES['informes']['tmp_name'];
    $destino2 = "..//archivosObrasNuevas/" . $informes;
    $realName2 = uniqid($prefix2, TRUE) . '.' . $extencion2;

    $subirResolucion = move_uploaded_file($ruta, $destino);
    $subirInformes = move_uploaded_file($ruta2, $destino2);
    if ($subirResolucion && $subirInformes) {
        //se insertan los datos de la resolucion
        $sql = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio','$tipo','$resolucion','$realName','resolucion')";
        $insertResolucion = $db->execute($sql);
        //se insertan los datos de los informes
        $sql2 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio2','$tipo2','$informes','$realName2','informes')";
        $insertInformes = $db->execute($sql2);
        if ($insertInformes && $insertResolucion) {
            echo '<script> alert("Se ingresó correctamente"); window.location = "../vistas/obrasNuevas.php" </script>';
        }
    } else {
        echo 'Lo sentimos, ocurrio un error';
    }
} else if ($resolucion != '' && $informes != '' && $actaVisita != '' && $actaReceptacion == '' && $planimetria == '' &&
        $especificaciones == '') {

    //se obtienen todos los datos de resolucion
    $tipo = $_FILES['resolucion']['type'];
    $tamanio = $_FILES['resolucion']['size'];
    $prefix = "doc_";
    $ext = explode(".", $resolucion);
    $extencion = $ext[1];
    $ruta = $_FILES['resolucion']['tmp_name'];
    $destino = "..//archivosObrasNuevas/" . $resolucion;
    $realName = uniqid($prefix, TRUE) . '.' . $extencion;

    //se obtienen todos los datos de informes
    $tipo2 = $_FILES['informes']['type'];
    $tamanio2 = $_FILES['informes']['size'];
    $prefix2 = "doc_";
    $ext2 = explode(".", $informes);
    $extencion2 = $ext2[1];
    $ruta2 = $_FILES['informes']['tmp_name'];
    $destino2 = "..//archivosObrasNuevas/" . $informes;
    $realName2 = uniqid($prefix2, TRUE) . '.' . $extencion2;

    //se obtienen todos los datos de acta de visita
    $tipo3 = $_FILES['actaVisita']['type'];
    $tamanio3 = $_FILES['actaVisita']['size'];
    $prefix3 = "doc_";
    $ext3 = explode(".", $actaVisita);
    $extencion3 = $ext3[1];
    $ruta3 = $_FILES['actaVisita']['tmp_name'];
    $destino3 = "..//archivosObrasNuevas/" . $actaVisita;
    $realName3 = uniqid($prefix3, TRUE) . '.' . $extencion3;

    $subirResolucion = move_uploaded_file($ruta, $destino);
    $subirInformes = move_uploaded_file($ruta2, $destino2);
    $subirActaVisita = move_uploaded_file($ruta3, $destino3);
    if ($subirResolucion && $subirInformes && $subirActaVisita) {
        //se insertan los datos de la resolucion
        $sql = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio','$tipo','$resolucion','$realName','resolucion')";
        $insertResolucion = $db->execute($sql);
        //se insertan los datos de los informes
        $sql2 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio2','$tipo2','$informes','$realName2','informes')";
        $insertInformes = $db->execute($sql2);
        //se insertan los datos de acta de visita
        $sql3 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio3','$tipo3','$actaVisita','$realName3','acta de visita')";
        $insertActaVisita = $db->execute($sql3);
        if ($insertInformes && $insertResolucion && $insertActaVisita) {
            echo '<script> alert("Se ingresó correctamente"); window.location = "../vistas/obrasNuevas.php" </script>';
        }
    } else {
        echo 'Lo sentimos, ocurrio un error';
    }
} else if ($resolucion != '' && $informes != '' && $actaVisita != '' && $actaReceptacion != '' && $planimetria == '' &&
        $especificaciones == '') {

    //se obtienen todos los datos de resolucion
    $tipo = $_FILES['resolucion']['type'];
    $tamanio = $_FILES['resolucion']['size'];
    $prefix = "doc_";
    $ext = explode(".", $resolucion);
    $extencion = $ext[1];
    $ruta = $_FILES['resolucion']['tmp_name'];
    $destino = "..//archivosObrasNuevas/" . $resolucion;
    $realName = uniqid($prefix, TRUE) . '.' . $extencion;

    //se obtienen todos los datos de informes
    $tipo2 = $_FILES['informes']['type'];
    $tamanio2 = $_FILES['informes']['size'];
    $prefix2 = "doc_";
    $ext2 = explode(".", $informes);
    $extencion2 = $ext2[1];
    $ruta2 = $_FILES['informes']['tmp_name'];
    $destino2 = "..//archivosObrasNuevas/" . $informes;
    $realName2 = uniqid($prefix2, TRUE) . '.' . $extencion2;

    //se obtienen todos los datos de acta de visita
    $tipo3 = $_FILES['actaVisita']['type'];
    $tamanio3 = $_FILES['actaVisita']['size'];
    $prefix3 = "doc_";
    $ext3 = explode(".", $actaVisita);
    $extencion3 = $ext3[1];
    $ruta3 = $_FILES['actaVisita']['tmp_name'];
    $destino3 = "..//archivosObrasNuevas/" . $actaVisita;
    $realName3 = uniqid($prefix3, TRUE) . '.' . $extencion3;

    //se obtienen todos los datos de acta de receptacion
    $tipo4 = $_FILES['actaReceptacion']['type'];
    $tamanio4 = $_FILES['actaReceptacion']['size'];
    $prefix4 = "doc_";
    $ext4 = explode(".", $actaReceptacion);
    $extencion4 = $ext4[1];
    $ruta4 = $_FILES['actaReceptacion']['tmp_name'];
    $destino4 = "..//archivosObrasNuevas/" . $actaReceptacion;
    $realName4 = uniqid($prefix4, TRUE) . '.' . $extencion4;

    $subirResolucion = move_uploaded_file($ruta, $destino);
    $subirInformes = move_uploaded_file($ruta2, $destino2);
    $subirActaVisita = move_uploaded_file($ruta3, $destino3);
    $subirReceptacion = move_uploaded_file($ruta4, $destino4);
    if ($subirResolucion && $subirInformes && $subirActaVisita && $subirReceptacion) {
        //se insertan los datos de la resolucion
        $sql = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio','$tipo','$resolucion','$realName','resolucion')";
        $insertResolucion = $db->execute($sql);
        //se insertan los datos de los informes
        $sql2 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio2','$tipo2','$informes','$realName2','informes')";
        $insertInformes = $db->execute($sql2);
        //se insertan los datos de acta de visita
        $sql3 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio3','$tipo3','$actaVisita','$realName3','acta de visita')";
        $insertActaVisita = $db->execute($sql3);
        //se insertan los datos de acta de receptacion
        $sql4 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio4','$tipo4','$actaReceptacion','$realName4','acta de receptacion')";
        $insertActaReceptacion = $db->execute($sql4);
        if ($insertInformes && $insertResolucion && $insertActaVisita && $insertActaReceptacion) {
            echo '<script> alert("Se ingresó correctamente"); window.location = "../vistas/obrasNuevas.php" </script>';
        }
    } else {
        echo 'Lo sentimos, ocurrio un error';
    }
} else if ($resolucion != '' && $informes != '' && $actaVisita != '' && $actaReceptacion != '' && $planimetria != '' &&
        $especificaciones == '') {

    //se obtienen todos los datos de resolucion
    $tipo = $_FILES['resolucion']['type'];
    $tamanio = $_FILES['resolucion']['size'];
    $prefix = "doc_";
    $ext = explode(".", $resolucion);
    $extencion = $ext[1];
    $ruta = $_FILES['resolucion']['tmp_name'];
    $destino = "..//archivosObrasNuevas/" . $resolucion;
    $realName = uniqid($prefix, TRUE) . '.' . $extencion;

    //se obtienen todos los datos de informes
    $tipo2 = $_FILES['informes']['type'];
    $tamanio2 = $_FILES['informes']['size'];
    $prefix2 = "doc_";
    $ext2 = explode(".", $informes);
    $extencion2 = $ext2[1];
    $ruta2 = $_FILES['informes']['tmp_name'];
    $destino2 = "..//archivosObrasNuevas/" . $informes;
    $realName2 = uniqid($prefix2, TRUE) . '.' . $extencion2;

    //se obtienen todos los datos de acta de visita
    $tipo3 = $_FILES['actaVisita']['type'];
    $tamanio3 = $_FILES['actaVisita']['size'];
    $prefix3 = "doc_";
    $ext3 = explode(".", $actaVisita);
    $extencion3 = $ext3[1];
    $ruta3 = $_FILES['actaVisita']['tmp_name'];
    $destino3 = "..//archivosObrasNuevas/" . $actaVisita;
    $realName3 = uniqid($prefix3, TRUE) . '.' . $extencion3;

    //se obtienen todos los datos de acta de receptacion
    $tipo4 = $_FILES['actaReceptacion']['type'];
    $tamanio4 = $_FILES['actaReceptacion']['size'];
    $prefix4 = "doc_";
    $ext4 = explode(".", $actaReceptacion);
    $extencion4 = $ext4[1];
    $ruta4 = $_FILES['actaReceptacion']['tmp_name'];
    $destino4 = "..//archivosObrasNuevas/" . $actaReceptacion;
    $realName4 = uniqid($prefix4, TRUE) . '.' . $extencion4;

    //se obtienen todos los datos de planimetria
    $tipo5 = $_FILES['planimetria']['type'];
    $tamanio5 = $_FILES['planimetria']['size'];
    $prefix5 = "doc_";
    $ext5 = explode(".", $planimetria);
    $extencion5 = $ext5[1];
    $ruta5 = $_FILES['planimetria']['tmp_name'];
    $destino5 = "..//archivosObrasNuevas/" . $planimetria;
    $realName5 = uniqid($prefix5, TRUE) . '.' . $extencion5;

    $subirResolucion = move_uploaded_file($ruta, $destino);
    $subirInformes = move_uploaded_file($ruta2, $destino2);
    $subirActaVisita = move_uploaded_file($ruta3, $destino3);
    $subirReceptacion = move_uploaded_file($ruta4, $destino4);
    $subirPlanimetria = move_uploaded_file($ruta5, $destino5);
    if ($subirResolucion && $subirInformes && $subirActaVisita && $subirReceptacion && $subirPlanimetria) {
        //se insertan los datos de la resolucion
        $sql = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio','$tipo','$resolucion','$realName','resolucion')";
        $insertResolucion = $db->execute($sql);
        //se insertan los datos de los informes
        $sql2 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio2','$tipo2','$informes','$realName2','informes')";
        $insertInformes = $db->execute($sql2);
        //se insertan los datos de acta de visita
        $sql3 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio3','$tipo3','$actaVisita','$realName3','acta de visita')";
        $insertActaVisita = $db->execute($sql3);
        //se insertan los datos de acta de receptacion
        $sql4 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio4','$tipo4','$actaReceptacion','$realName4','acta de receptacion')";
        $insertActaReceptacion = $db->execute($sql4);
        //se insertan los datos de la planimetria
        $sql5 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio5','$tipo5','$planimetria','$realName5','planimetria')";
        $insertPlanimetria = $db->execute($sql5);

        if ($insertInformes && $insertResolucion && $insertActaVisita && $insertActaReceptacion && $insertPlanimetria) {
            echo '<script> alert("Se ingresó correctamente"); window.location = "../vistas/obrasNuevas.php" </script>';
        }
    } else {
        echo 'Lo sentimos, ocurrio un error';
    }
} else if ($resolucion != '' && $informes != '' && $actaVisita != '' && $actaReceptacion != '' && $planimetria != '' &&
        $especificaciones != '') {

    //se obtienen todos los datos de resolucion
    $tipo = $_FILES['resolucion']['type'];
    $tamanio = $_FILES['resolucion']['size'];
    $prefix = "doc_";
    $ext = explode(".", $resolucion);
    $extencion = $ext[1];
    $ruta = $_FILES['resolucion']['tmp_name'];
    $destino = "..//archivosObrasNuevas/" . $resolucion;
    $realName = uniqid($prefix, TRUE) . '.' . $extencion;

    //se obtienen todos los datos de informes
    $tipo2 = $_FILES['informes']['type'];
    $tamanio2 = $_FILES['informes']['size'];
    $prefix2 = "doc_";
    $ext2 = explode(".", $informes);
    $extencion2 = $ext2[1];
    $ruta2 = $_FILES['informes']['tmp_name'];
    $destino2 = "..//archivosObrasNuevas/" . $informes;
    $realName2 = uniqid($prefix2, TRUE) . '.' . $extencion2;

    //se obtienen todos los datos de acta de visita
    $tipo3 = $_FILES['actaVisita']['type'];
    $tamanio3 = $_FILES['actaVisita']['size'];
    $prefix3 = "doc_";
    $ext3 = explode(".", $actaVisita);
    $extencion3 = $ext3[1];
    $ruta3 = $_FILES['actaVisita']['tmp_name'];
    $destino3 = "..//archivosObrasNuevas/" . $actaVisita;
    $realName3 = uniqid($prefix3, TRUE) . '.' . $extencion3;

    //se obtienen todos los datos de acta de receptacion
    $tipo4 = $_FILES['actaReceptacion']['type'];
    $tamanio4 = $_FILES['actaReceptacion']['size'];
    $prefix4 = "doc_";
    $ext4 = explode(".", $actaReceptacion);
    $extencion4 = $ext4[1];
    $ruta4 = $_FILES['actaReceptacion']['tmp_name'];
    $destino4 = "..//archivosObrasNuevas/" . $actaReceptacion;
    $realName4 = uniqid($prefix4, TRUE) . '.' . $extencion4;

    //se obtienen todos los datos de planimetria
    $tipo5 = $_FILES['planimetria']['type'];
    $tamanio5 = $_FILES['planimetria']['size'];
    $prefix5 = "doc_";
    $ext5 = explode(".", $planimetria);
    $extencion5 = $ext5[1];
    $ruta5 = $_FILES['planimetria']['tmp_name'];
    $destino5 = "..//archivosObrasNuevas/" . $planimetria;
    $realName5 = uniqid($prefix5, TRUE) . '.' . $extencion5;

    //se obtienen todos los datos de especificaciones
    $tipo6 = $_FILES['especificaciones']['type'];
    $tamanio6 = $_FILES['especificaciones']['size'];
    $prefix6 = "doc_";
    $ext6 = explode(".", $especificaciones);
    $extencion6 = $ext6[1];
    $ruta6 = $_FILES['especificaciones']['tmp_name'];
    $destino6 = "..//archivosObrasNuevas/" . $especificaciones;
    $realName6 = uniqid($prefix6, TRUE) . '.' . $extencion6;

    $subirResolucion = move_uploaded_file($ruta, $destino);
    $subirInformes = move_uploaded_file($ruta2, $destino2);
    $subirActaVisita = move_uploaded_file($ruta3, $destino3);
    $subirReceptacion = move_uploaded_file($ruta4, $destino4);
    $subirPlanimetria = move_uploaded_file($ruta5, $destino5);
    $subirEspecificaciones = move_uploaded_file($ruta6, $destino6);
    if ($subirResolucion && $subirInformes && $subirActaVisita && $subirReceptacion && $subirPlanimetria && $subirEspecificaciones) {
        //se insertan los datos de la resolucion
        $sql = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio','$tipo','$resolucion','$realName','resolucion')";
        $insertResolucion = $db->execute($sql);
        //se insertan los datos de los informes
        $sql2 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio2','$tipo2','$informes','$realName2','informes')";
        $insertInformes = $db->execute($sql2);
        //se insertan los datos de acta de visita
        $sql3 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio3','$tipo3','$actaVisita','$realName3','acta de visita')";
        $insertActaVisita = $db->execute($sql3);
        //se insertan los datos de acta de receptacion
        $sql4 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio4','$tipo4','$actaReceptacion','$realName4','acta de receptacion')";
        $insertActaReceptacion = $db->execute($sql4);
        //se insertan los datos de la planimetria
        $sql5 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio5','$tipo5','$planimetria','$realName5','planimetria')";
        $insertPlanimetria = $db->execute($sql5);
        //se insertan los datos de especificaciones
        $sql6 = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
            VALUES(null,$idObra,'$tamanio6','$tipo6','$especificaciones','$realName6','especificaciones')";
        $insertEspecificaciones = $db->execute($sql6);
        if ($insertInformes && $insertResolucion && $insertActaVisita && $insertActaReceptacion && $insertPlanimetria && $insertEspecificaciones) {
            echo '<script> alert("Se ingresó correctamente"); window.location = "../vistas/obrasNuevas.php" </script>';
        }
    } else {
        echo 'Lo sentimos, ocurrio un error';
    }
} else {
    echo 'ocurrio un problema';
}*/
//if ($ejecutar) {
//    echo '<script> alert("Obra Insertada Correctamente!"); window.location.href = "http://spm.pucv.cl/vistas/obrasNuevas.php";</script>';
//} else {
//    echo '<script> alert("Lo sentimos, Ocurrio un Problema!"); window.location.href = "http://spm.pucv.cl/vistas/obrasNuevas.php";</script>';
//}
echo '<script> alert("Se ingresó correctamente"); window.location = "../vistas/iniciarObras.php" </script>';
?>
