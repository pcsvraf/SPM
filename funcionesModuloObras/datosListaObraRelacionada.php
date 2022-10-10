<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
include '/home/pcspucv/public_html/spm/wp-load.php';
if (is_user_logged_in()) {
    $cu = wp_get_current_user();
    $nombre = $cu->user_firstname;
    $apellidos = $cu->user_lastname;
    $nombreCompleto = $nombre . " " . $apellidos;
}
$columns = array("obraRelacionada.id", "obraRelacionada.monto", "obraRelacionada.numeroRelacionObra", "obraRelacionada.fecha",
    "obraRelacionada.contratista", "obraRelacionada.rutContratista", "obraRelacionada.observaciones", "obraRelacionada.encargadoObra", "obraRelacionada.nombreArchivo");

$query = "SELECT obraRelacionada.id, obraRelacionada.nombreEstado, obraRelacionada.numeroRelacionObra, obraNueva.nombreObra, obraRelacionada.fecha,
 obraRelacionada.monto, obraRelacionada.contratista, obraRelacionada.observaciones, obraRelacionada.rutContratista, obraRelacionada.estado FROM ((obraRelacionada
          INNER JOIN estado ON estado.ide = obraRelacionada.estado)
          INNER JOIN obraNueva ON obraNueva.id= obraRelacionada.numeroRelacionObra)";

if ($nombreCompleto != "Juan Pavez" and $nombreCompleto != "Begona Arellano" and $nombreCompleto != "Camila Tapia Zamora"){
  $query .= " WHERE obraRelacionada.encargadoObra='$nombreCompleto' &&";
}else {
  $query .= " WHERE";
}
if (isset($_POST["is_category"])) {
    $query .= "obraRelacionada.estado = '" . $_POST["is_category"] . "' AND ";
}

if (isset($_POST["search"]["value"])) {
    $query .= '(obraRelacionada.id LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.monto LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.numeroRelacionObra LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.contratista LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.rutContratista LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.nombreObra LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.fecha LIKE "%' . $_POST["search"]["value"] . '%") ';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . '
 ';
} else {
    $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while ($row = mysqli_fetch_array($result)) {
    $sub_array = array();
    $sub_array[] = $row["nombreEstado"];
    $sub_array[] = $row['numeroRelacionObra'];
    $sub_array[] = utf8_encode($row['nombreObra']);
    $sub_array[] = $row['fecha'];
    $p = number_format($row["monto"]);
    $sub_array[] = str_replace(',', '.', $p);
    $sub_array[] = utf8_encode($row['contratista']);
    $sub_array[] = $row['rutContratista'];
    $sub_array[] = utf8_encode($row['observaciones']);
    if ($row["estado"] == 1) {
        $sub_array[] = '<button type="button" name="insert" class="btn btn-primary btn-xs insert" value="' . $row["id"] . '">Iniciar Obra</button>';
        $sub_array[] = '<button type="button" name="eliminar" class="btn btn-danger btn-xs eliminar" value="' . $row["id"] . '">Eliminar Obra</button>';
    } else if ($row["estado"] == 2) {
        $sub_array[] = '<button type="button" name="documentacion" class="btn btn-success btn-xs documentacion" value="' . $row["id"] . '">Subir Facturas</button>';
        $sub_array[] = '<button type="button" name="eliminar" class="btn btn-danger btn-xs eliminar" value="' . $row["id"] . '">Eliminar Obra</button>';
    } else if ($row['estado'] == 3) {
        $sub_array[] = '<button type="button" name="finalizada" class="btn btn-info btn-xs finalizada" value="' . $row["id"] . '">Ver Obra Finalizada</button>';
        $sub_array[] = '<center><input type="image" src="../imagenes/block-eliminar.png" width="30" height="30"></center>';
    }
    $data[] = $sub_array;
}

function get_all_data($connect) {
    $query = "SELECT * FROM obraRelacionada";
    $result = mysqli_query($connect, $query);
    return mysqli_num_rows($result);
}

$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => get_all_data($connect),
    "recordsFiltered" => $number_filter_row,
    "data" => $data
);

echo json_encode($output);
?>
