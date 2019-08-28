<?php

//fetch.php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
$columns = array("obraRelacionada.id", "obraRelacionada.monto", "obraRelacionada.numeroRelacionObra", "obraRelacionada.fecha",
    "obraRelacionada.contratista", "obraRelacionada.rutContratista", "obraRelacionada.observaciones", "obraRelacionada.encargadoObra",
     );

$query = "SELECT  obraRelacionada.id, obraRelacionada.nombreEstado, obraRelacionada.numeroRelacionObra, obraNueva.nombreObra, obraRelacionada.fecha, obraRelacionada.observaciones,
 obraRelacionada.monto,obraRelacionada.encargadoObra, obraRelacionada.contratista, obraRelacionada.rutContratista, obraRelacionada.estado FROM obraRelacionada
  INNER JOIN obraNueva ON obraNueva.id=obraRelacionada.numeroRelacionObra";

$query .= " WHERE ";

if (isset($_POST["search"]["value"])) {
    $query .= '(obraRelacionada.id LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.monto LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.numeroRelacionObra LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.contratista LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.rutContratista LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.fecha LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.nombreObra LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.observaciones LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraRelacionada.encargadoObra LIKE "%' . $_POST["search"]["value"] . '%") ';
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
    $sub_array[] = $row['encargadoObra'];
    $sub_array[] = $row['numeroRelacionObra'];
    $sub_array[] = utf8_encode($row['nombreObra']);
    $sub_array[] = $row['fecha'];
    $p = number_format($row["monto"]);
    $sub_array[] = str_replace(',', '.', $p);
    $sub_array[] = utf8_encode($row['contratista']);
    $sub_array[] = $row['rutContratista'];
    $sub_array[] = utf8_encode($row['observaciones']);
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
