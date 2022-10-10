<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
if(isset($_POST["nombre"], $_POST["rut"]))
{
 $nombre = mysqli_real_escape_string($connect, $_POST["nombre"]);
 $rut = mysqli_real_escape_string($connect, $_POST["rut"]);

 $query1 = "SELECT id FROM personalIngresador order by id DESC LIMIT 1";
                    $resultado = mysqli_query($connect,$query1);
                    $id = mysqli_fetch_row($resultado);
                    $ide = $id[0] + 1;
 $nombresito = utf8_decode($nombre);

 $query = "INSERT INTO personalIngresador(id, nombre, rut)"
         . " VALUES('$ide', '$nombresito', '$rut')";
 if(mysqli_query($connect, $query))
 {
  echo 'Personal agregado';
 }
 else{
  echo 'Error al agregar personal';
 }
}
?>
