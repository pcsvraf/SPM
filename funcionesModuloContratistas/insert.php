<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
if(isset($_POST["nombre"], $_POST["rut"],  $_POST["email"], $_POST["contacto"], $_POST["direccion"]))
{
 $nombre = mysqli_real_escape_string($connect, $_POST["nombre"]);
 $rut = mysqli_real_escape_string($connect, $_POST["rut"]);
 $email = mysqli_real_escape_string($connect, $_POST["email"]);
 $contacto = mysqli_real_escape_string($connect, $_POST["contacto"]);
 $direccion = mysqli_real_escape_string($connect, $_POST["direccion"]);

 $query1 = "SELECT id FROM contratistas order by id DESC LIMIT 1";
                    $resultado = mysqli_query($connect,$query1);
                    $id = mysqli_fetch_row($resultado);
                    $ide = $id[0] + 1;
 $nombresito = utf8_decode($nombre);
 $direction = utf8_decode($direccion);

 $query = "INSERT INTO contratistas(id, nombre, rut, email, contacto, direccion)"
         . " VALUES('$ide', '$nombresito', '$rut', '$email', '$contacto', '$direction')";
 if(mysqli_query($connect, $query))
 {
  echo 'Contratista agregado';
 }
 else{
  echo 'Error al agregar contratista';
 }
}
?>
