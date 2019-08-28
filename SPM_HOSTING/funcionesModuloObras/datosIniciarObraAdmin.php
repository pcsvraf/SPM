<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
mysqli_set_charset($connect, "utf8");
$column = array("obraNueva.id", "obraNueva.fecha", "obraNueva.nombreObra", "obraNueva.mandante",
    "obraNueva.unidadOtro", "obraNueva.unidad", "obraNueva.empresaContratista",
    "obraNueva.rutContratista", "obraNueva.valor", "obraNueva.presupuesto","obraNueva.encargado");
$query = "
 SELECT * FROM obraNueva
 INNER JOIN estado ON estado.ide = obraNueva.estado
 ";
$query .= " WHERE ";

if (isset($_POST["is_category"])) {
    $query .= "obraNueva.estado = '" . $_POST["is_category"] . "' AND ";
}
if (isset($_POST["search"]["value"])) {
    $query .= '(obraNueva.id LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.fecha LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.nombreObra LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.mandante LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.unidadOtro LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.empresaContratista LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.rutContratista LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.valor LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.presupuesto LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.encargado LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR obraNueva.unidad LIKE "%' . $_POST["search"]["value"] . '%") ';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY obraNueva.id DESC ';
}

$query1 = '';

if ($_POST["length"] != 1) {
    $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while ($row = mysqli_fetch_array($result)) {
    $sub_array = array();
    $sub_array[] = $row["nombreEstado"];
    $sub_array[] = $row["id"];
    $sub_array[] = $row["encargado"];
    $sub_array[] = $row["fecha"];
    $sub_array[] = $row["nombreObra"];
    $sub_array[] = $row["campus"];
    $sub_array[] = $row["mandante"];
    $sub_array[] = $row["unidadOtro"];
    $sub_array[] = $row["unidad"];
    $sub_array[] = $row["empresaContratista"];
    $sub_array[] = $row["rutContratista"];
    $p = number_format($row["presupuesto"]);
    $sub_array[] = str_replace(',', '.', $p);
    if ($row["estado"] == 1) {
        $sub_array[] = '<button type="button" name="insert" class="btn btn-primary btn-xs insert" value="' . $row["id"] . '">Iniciar Obra</button>';
        $sub_array[] = '<button type="button" name="archivos" class="btn btn-warning btn-xs archivos" value="' . $row["id"] . '">Subir / Ver Archivo</button>';
        $sub_array[] = '<center><a href="../funcionesModuloObras/editarObra.php?id=' . $row['id'] . '"><input type="image" src="../imagenes/Editar.png" width="30" height="30"></a></center>';
        $sub_array[] = '<button type="button" name="eliminar" class="btn btn-danger btn-xs eliminar" value="' . $row["id"] . '">Eliminar Obra</button>';
    } else if ($row["estado"] == 2) {
        $sub_array[] = '<button type="button" name="documentacion" class="btn btn-success btn-xs documentacion" value="' . $row["id"] . '">Subir Facturas</button>';
        $sub_array[] = '<button type="button" name="archivos" class="btn btn-warning btn-xs archivos" value="' . $row["id"] . '">Subir / Ver Archivo</button>';
        $sub_array[] = '<center><input type="image" src="../imagenes/block-editar.png" width="40" height="40"></center>';
        $sub_array[] = '<center><input type="image" src="../imagenes/block-eliminar.png" width="40" height="40"></center>';
    } else if ($row["estado"] == 3) {
        $sub_array[] = '<button type="button" name="finalizada" class="btn btn-info btn-xs finalizada" value="' . $row["id"] . '">Ver Obra Finalizada</button>';
        $sub_array[] = '<center><input type="image" src="../imagenes/block-archivos.png" width="30" height="30"></center>';
        $sub_array[] = '<center><input type="image" src="../imagenes/block-editar.png" width="30" height="30"></center>';
        $sub_array[] = '<center><input type="image" src="../imagenes/block-eliminar.png" width="30" height="30"></center>';
    }
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
