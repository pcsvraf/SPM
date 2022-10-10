<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
mysqli_set_charset($connect, "utf8");

include '/home/pcspucv/public_html/spm/wp-load.php';
if (is_user_logged_in()) {
     $cu = wp_get_current_user();
     $nombre = $cu->user_firstname;
     $apellidos = $cu->user_lastname;
     $nombreCompleto = $nombre . " " . $apellidos;
     $correo = get_userdata(get_current_user_id())->user_email;
}

$columns = array("obraNueva.id","obraNueva.fecha", "obraNueva.nombreObra", "obraNueva.campus", "obraNueva.mandante", "obraNueva.unidadOtro",
           "obraNueva.usuario", "obraNueva.edificio","obraNueva.piso","obraNueva.recinto","obraNueva.empresaContratista",
           "obraNueva.rutContratista","obraNueva.presupuesto","obraNueva.neto","obraNueva.iva","obraNueva.cargoNroCuenta","obraNueva.observaciones",
           "obraNueva.unidad","obraNueva.encargado","obraNueva.metrosCuadrados","obraNueva.nombreEstado","obraNueva.nuevaRemodelacion",
           "obraNueva.fechaInicioContrato","obraNueva.fechaTerminoContrato");

$query = "SELECT * FROM obraNueva";

$query .= " WHERE ";

if (isset($_POST["search"]["value"])) {
    $query .= '(obraNueva.id LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.fecha LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.nombreObra LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.campus LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.mandante LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.unidadOtro LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.unidad LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.usuario LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.edificio LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.piso LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.recinto LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.empresaContratista LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.rutContratista LIKE "%'. $_POST["search"]["value"]  .'%" ';
    $query .= 'OR obraNueva.presupuesto LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.neto LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.iva LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.cargoNroCuenta LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.encargado LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.metrosCuadrados LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.nombreEstado LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.nuevaRemodelacion LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.fechaInicioContrato LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.fechaTerminoContrato LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.observaciones LIKE "%' . $_POST["search"]["value"] . '%") ';
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
    $sub_array[] = $row["id"];
    $sub_array[] = $row["encargado"];
    $sub_array[] = $row["fecha"];
    $sub_array[] = $row["nombreObra"];
    $sub_array[] = $row["campus"];
    $sub_array[] = $row["mandante"];
    $sub_array[] = $row["unidadOtro"];
    $sub_array[] = $row["unidad"];
    $sub_array[] = $row["usuario"];
    $sub_array[] = $row["edificio"];
    $sub_array[] = $row["piso"];
    $sub_array[] = $row["recinto"];
    $sub_array[] = $row["empresaContratista"];
    $sub_array[] = $row['rutContratista'];
    $p = number_format($row["presupuesto"]);
    $sub_array[] = str_replace(',', '.', $p);
    $n = number_format($row["neto"]);
    $sub_array[] = str_replace(',', '.', $n);
    $i = number_format($row["iva"]);
    $sub_array[] = str_replace(',', '.', $i);
    $sub_array[] = $row["cargoNroCuenta"];
    $sub_array[] = utf8_encode($row["observaciones"]);
    $sub_array[] = $row["metrosCuadrados"];
    $sub_array[] = $row["nombreEstado"];
    $sub_array[] = $row["nuevaRemodelacion"];
    $sub_array[] = $row["fechaInicioContrato"];
    $sub_array[] = $row["fechaTerminoContrato"];
    $data[] = $sub_array;
}

function get_all_data($connect) {
    $query = "SELECT * FROM obraNueva";
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
