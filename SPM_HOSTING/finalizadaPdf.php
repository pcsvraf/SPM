<?php
require_once ('tcpdf/config/lang/eng.php');
require_once ('tcpdf/tcpdf.php');
//require_once('../core/conexion.php');
include 'funciones/conexion.php';

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Obra Finalizada'); //Titulo del pdf
$pdf->setPrintHeader(true); //No se imprime cabecera
$pdf->setPrintFooter(false); //No se imprime pie de pagina
$pdf->SetMargins(30, 40, 30, false); //Se define margenes izquierdo, alto, derecho
$pdf->SetAutoPageBreak(true, 20); //Se define un salto de pagina con un limite de pie de pagina
$pdf->setHeaderMargin(5);
$imagen = "logo.png";
$pdf->SetHeaderData($imagen, '70px', '', '');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->addPage();
$htm = "<h1>Documento Obra Finalizada</h1> <br>";

// print a block of text using Write()
$pdf->writeHTML($htm, true, false, true, false, '');

//$sql = "SELECT * FROM rescate ORDER BY id ASC";
//$cosas = $mysqli->query($sql);
$html = '';
$item = 1;

$id = $_GET['id'];
$db = new Conect_MySql();
$sql = "SELECT * FROM obraNueva WHERE id='$id'";
$ejecuta = $db->execute($sql);
$datos = $db->fetch_row($ejecuta);

$query = "SELECT * FROM facturas WHERE idRelacion='$id'";
$ejecuta2 = $db->execute($query);

$query3 = "SELECT * FROM obraRelacionada WHERE numeroRelacionObra='$id'";
$ejecuta3 = $db->execute($query3);

$query4 = "SELECT * FROM facturasObraRel WHERE idRelacion='$id'";
$ejecuta4 = $db->execute($query4);

$html .= '<h1>Datos Obra Nueva</h1>
    <table border="1" cellpadding="4">
    <tr>
        <td width="150" bgcolor="#E6E6E6"><b>ID obra nueva: </b></td>
        <td width="270">' . $id . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Nombre Obra: </b></td>
        <td>' . $datos['nombreObra'] . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Mandante: </b></td>
        <td>' . $datos['mandante'] . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Tipo: </b></td>
        <td>' . $datos['unidadOtro'] . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Contratista: </b></td>
        <td>' . $datos['empresaContratista'] . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Rut Contratista: </b></td>
        <td>' . $datos['rutContratista'] . '</td>
    </tr>
     <tr>
        <td bgcolor="#E6E6E6"><b>Fecha Inicio: </b></td>
        <td>' . $datos['fechaInicio'] . '</td>
    </tr>
     <tr>
        <td bgcolor="#E6E6E6"><b>Presupuesto: </b></td>
        <td>' . $datos['presupuesto'] . '</td>
    </tr>

</table><br><br><br>';
while ($datos2 = $db->fetch_row($ejecuta2)) {
  $html2 .= '<h1>Datos Facturas</h1>
      <table border="1" cellpadding="5">
      <tr>
          <td width="150" bgcolor="#E6E6E6"><b>Id: </b></td>
          <td width="270">' . $datos2['id'] . '</td>
      </tr>
      <tr>
          <td bgcolor="#E6E6E6"><b>Número Factura: </b></td>
          <td>' . $datos2['numeroFactura'] . '</td>
      </tr>
      <tr>
          <td bgcolor="#E6E6E6"><b>Fecha: </b></td>
          <td>' . $datos2['fecha'] . '</td>
      </tr>
      <tr>
          <td bgcolor="#E6E6E6"><b>Detalle Glosa Servicio: </b></td>
          <td>' . $datos2['detalleServicio'] . '</td>
      </tr>
      <tr>
          <td bgcolor="#E6E6E6"><b>Total Factura: </b></td>
          <td>' . $datos2['totalFactura'] . '</td>
      </tr>
      <tr>
          <td bgcolor="#E6E6E6"><b>Devolución de Retención: </b></td>
          <td>' . $datos2['devolucionDeRetencion'] . '</td>
      </tr>
  </table><br><br><br>';
}

while ($datos3 = $db->fetch_row($ejecuta3)) {
  $html3 .= '<h1>Datos Obra Relacionada</h1>
      <table border="1" cellpadding="5">
      <tr>
          <td width="150" bgcolor="#E6E6E6"><b>Id: </b></td>
          <td width="270">' . $datos3['id'] . '</td>
      </tr>
      <tr>
          <td bgcolor="#E6E6E6"><b>Contratista: </b></td>
          <td>' . $datos3['contratista'] . '</td>
      </tr>
      <tr>
          <td bgcolor="#E6E6E6"><b>Rut: </b></td>
          <td>' . $datos3['rutContratista'] . '</td>
      </tr>
      <tr>
          <td bgcolor="#E6E6E6"><b>Fecha Inicio: </b></td>
          <td>' . $datos3['fecha'] . '</td>
      </tr>
      <tr>
          <td bgcolor="#E6E6E6"><b>Presupuesto: </b></td>
          <td>' . $datos3['monto'] . '</td>
      </tr>
      <tr>
          <td bgcolor="#E6E6E6"><b>Observaciones: </b></td>
          <td>' . $datos3['observaciones'] . '</td>
      </tr>
      </table>';
  }
  while ($datos4 = $db->fetch_row($ejecuta4)) {
    $html4 .= '<h1>Datos Facturas</h1>
        <table border="1" cellpadding="5">
        <tr>
            <td width="150" bgcolor="#E6E6E6"><b>Id: </b></td>
            <td width="270">' . $datos4['id'] . '</td>
        </tr>
        <tr>
            <td bgcolor="#E6E6E6"><b>Número Factura: </b></td>
            <td>' . $datos4['numeroFactura'] . '</td>
        </tr>
        <tr>
            <td bgcolor="#E6E6E6"><b>Fecha: </b></td>
            <td>' . $datos4['fecha'] . '</td>
        </tr>
        <tr>
            <td bgcolor="#E6E6E6"><b>Detalle Glosa Servicio: </b></td>
            <td>' . $datos4['detalleServicio'] . '</td>
        </tr>
        <tr>
            <td bgcolor="#E6E6E6"><b>Total Factura: </b></td>
            <td>' . $datos4['totalFactura'] . '</td>
        </tr>
        <tr>
            <td bgcolor="#E6E6E6"><b>Devolución de Retención: </b></td>
            <td>' . $datos4['devolucionDeRetencion'] . '</td>
        </tr>
    </table><br><br><br>';
  }


$item = $item + 1;
//}


$pdf->SetFont('Helvetica', '', 10);
$pdf->writeHTML($html, true, 0, true, 0);
$pdf->writeHTML($html2, true, 0, true, 0);
$pdf->writeHTML($html3, true, 0, true, 0);
$pdf->writeHTML($html4, true, 0, true, 0);

$pdf->lastPage();
$pdf->output('Reporte.pdf', 'I');
?>
