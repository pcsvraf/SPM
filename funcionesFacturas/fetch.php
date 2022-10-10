<?php
$id = $_GET['id'];
//fetch.php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
$columns = array("facturas.id", "facturas.numeroFactura", "facturas.fecha", "facturas.detalleServicio",
    "facturas.totalFactura", "facturas.devolucionDeRetencion");

$query = "SELECT * FROM facturas";

$query .= " WHERE idRelacion='$id' &&";

if (isset($_POST["search"]["value"])) {
    $query .= '(facturas.id LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR facturas.numeroFactura LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR facturas.fecha LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR facturas.detalleServicio LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR facturas.devolucionDeRetencion LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR facturas.totalFactura LIKE "%' . $_POST["search"]["value"] . '%") ';
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
    $consulta1 = "SELECT nombreArchivo FROM archivosFacturas WHERE idRelacion=" . $row["id"];
    $ejecuta = mysqli_query($connect, $consulta1);
    $hayArchivo = mysqli_num_rows($ejecuta);
    $sub_array = array();
    $p = number_format($row["totalFactura"]);
    $sub_array[] = $row["id"];
    $sub_array[] = $row["numeroFactura"];
    $sub_array[] = $row["fecha"];
    $sub_array[] = utf8_encode($row["detalleServicio"]);
    $sub_array[] = str_replace(',', '.', $p);
    //$sub_array[] = '<input type="number" min="0" contenteditable class="update form-control" data-id="' . $row["id"] . '" data-column="numeroFactura" value="' . $row["numeroFactura"] . '" disabled>';
    //$sub_array[] = '<input contenteditable class="update form-control" data-id="' . $row["id"] . '" data-column="fecha" type="date" value="' . $row["fecha"] . '" disabled>';
    //$sub_array[] = '<input type="text" contenteditable class="update form-control" data-id="' . $row["id"] . '" data-column="detalleServicio" value="' . utf8_encode($row["detalleServicio"]) . '" disabled>';
    //$sub_array[] = '<input type="number" min="0" contenteditable class="update form-control totalFac" data-id="' . $row["id"] . '" data-column="totalFactura" value="'.$row["totalFactura"].'" disabled>';
    if($row['devolucionDeRetencion'] == "SI"){
    $sub_array[] = '<input type="checkbox" checked="" contenteditable class="update form-control checkDevolucion" data-column="devolucionDeRetencion" data-id="'. $row['id'] .'" value="' . $row['id'] . '" disabled><a class="invisible">asas</a><label>'. $row['devolucionDeRetencion'] .'</label>';
    }else{
      $sub_array[] = '<input type="checkbox" contenteditable class="update form-control checkDevolucion" data-column="devolucionDeRetencion" data-id="'. $row['id'] .'" value="' . $row['id'] . '" disabled><a class="invisible">asas</a><label>'. $row['devolucionDeRetencion'] .'</label>';
    }
    if ($hayArchivo == 0) {
        $sub_array[] = '<button value="' . $row['id'] . '" class="btn btn-primary subirArchivo">Subir Archivo</button>';
    } else {
        $sub_array[] = '<button value="' . $row['id'] . '" class="btn btn-success archivo">Ver Archivo</button>';
    }
    $sub_array[] = '<button type="button" value="' . $row['id'] . '" name="delete" class="btn btn-danger delete" id="' . $row["id"] . '">Eliminar</button>';
    $data[] = $sub_array;
}

function get_all_data($connect) {
    $query = "SELECT * FROM facturas";
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
