<?php
//fetch.php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
mysqli_set_charset($connect, "utf8");
$columns = array("contratistas.id", "contratistas.nombre", "contratistas.rut", "contratistas.email",
"contratistas.contacto", "contratistas.direccion");

$query = "SELECT * FROM contratistas";

$query .= " WHERE ";

if (isset($_POST["search"]["value"])) {
$query .= '(contratistas.id LIKE "%' . $_POST["search"]["value"] . '%" ';
$query .= 'OR contratistas.nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
$query .= 'OR contratistas.rut LIKE "%' . $_POST["search"]["value"] . '%" ';
$query .= 'OR contratistas.email LIKE "%' . $_POST["search"]["value"] . '%" ';
$query .= 'OR contratistas.contacto LIKE "%' . $_POST["search"]["value"] . '%" ';
$query .= 'OR contratistas.direccion LIKE "%' . $_POST["search"]["value"] . '%") ';
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
$sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="nombre">' . $row["nombre"] . '</div>';
$sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="rut">' . $row["rut"] . '</div>';
$sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="email">' . $row["email"] . '</div>';
$sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="contacto">' . $row["contacto"] . '</div>';
$sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="direccion">' . $row["direccion"] . '</div>';
$sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="' . $row["id"] . '">Eliminar</button>';
$data[] = $sub_array;
}

function get_all_data($connect) {
$query = "SELECT * FROM contratistas";
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
