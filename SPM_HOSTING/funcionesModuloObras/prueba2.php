<?php
$ide = $_GET['id'];
//fetch.php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");

$columns = array("archivosObraNueva.id", "archivosObraNueva.idRelacion", "archivosObraNueva.tamanio", "archivosObraNueva.tipo",
    "archivosObraNueva.nombreArchivo", "archivosObraNueva.nombreRandom", "archivosObraNueva.identificadorArchivo", "archivosObraNueva.idArchivo");

$query = "SELECT * FROM archivosObraNueva";

$query .= " WHERE idRelacion='$ide' &&";

if (isset($_POST["search"]["value"])) {
    $query .= '(archivosObraNueva.id LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR archivosObraNueva.idRelacion LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR archivosObraNueva.nombreArchivo LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR archivosObraNueva.identificadorArchivo LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR archivosObraNueva.tipo LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR archivosObraNueva.nombreRandom LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR archivosObraNueva.idArchivo LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR archivosObraNueva.tamanio LIKE "%' . $_POST["search"]["value"] . '%") ';
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
    $consulta1 = "SELECT nombreArchivo FROM archivosObraNueva WHERE idRelacion=" . $ide;
    $ejecuta = mysqli_query($connect, $consulta1);
    $hayArchivo = mysqli_num_rows($ejecuta);
    $sub_array = array();
    $sub_array[] = '<input type="text" contenteditable class="form-control" data-id="' . $row["id"] . '" data-column="detalleServicio" value="' . utf8_encode($row["identificadorArchivo"]) . '" disabled>';
    $sub_array[] = '<button value="' . $row['id'] . '" name="subirArchivo" class="btn btn-primary subirArchivo" id="' . $row["id"] . '">Subir Archivo</button>';
    if ($hayArchivo == 0) {
      $sub_array[] = '<button value="' . $row['id'] . '" class="btn btn-info archivo">Ver Archivo</button>';
    } else {
        $sub_array[] = '<button value="' . $row['id'] . '" class="btn btn-info archivo">Ver Archivo</button>';
    }
    $sub_array[] = '<button type="button" value="' . $row['id'] . '" name="delete" class="btn btn-danger delete" id="' . $row["id"] . '">Eliminar</button>';
    $data[] = $sub_array;
}

function get_all_data($connect) {
    $query = "SELECT * FROM archivosObraNueva";
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
