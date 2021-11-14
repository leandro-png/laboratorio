<?php
require('../pdf/fpdf.php');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
//    $this->Cell(60);

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página '.$this->PageNo().'/{nb}',0,0,'C'));
}
}


require '../conexion.php';


$aei = $_GET["id"];
$consulta = "SELECT * FROM ensayo_trifasicos WHERE id = ".$aei;

$resultado = $con->query($consulta);





$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);


while($row = $resultado->fetch_assoc()){

$pdf->Ln(5);

//$pdf->Cell(180, 8,$aei, 1, 1, 'C', 0);


$pdf->Cell(180, 8,'CONTRASTE DE EQUIPOS DE MEDICION ', 1, 1, 'C', 0);
$pdf->Cell(60, 8,utf8_decode('N° Equipo: ').number_format($row['price'],0,'',''), 1, 0, 'C', 0);
$pdf->Cell(60, 8,'Cliente: N/Asignado', 1, 0, 'C', 0);
$pdf->Cell(60, 8,utf8_decode('Tensión: 3 x 380 / 220 V.'), 1, 1, 'C', 0);

$pdf->Ln(5);

$pdf->Cell(60, 8,'MEDIDOR ACTIVO PRINCIPAL ', 1, 1, 'C', 0);

$pdf->Ln(5);

$pdf->Cell(45, 8,'Tipo: '.$row['prod_ctry'], 1, 0, 'C', 0);
$pdf->Cell(45, 8,utf8_decode('N° Laboratorio: ').$row['prod_code'], 1, 0, 'C', 0);
$pdf->Cell(45, 8,utf8_decode('N° Fábrica: ').$row['prod_name'], 1, 0, 'C', 0);
$pdf->Cell(45, 8,'ERROR', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'Estado anterior: ---------- KWh', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'Estado Posterior: 00000000.00 KWh', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'Posterior', 1, 1, 'C', 0);

$pdf->Cell(45, 8,utf8_decode('I. Máxima'), 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'0.00 %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'100% Cos = 1', 1, 0, 'C', 0);
$pdf->Cell(15, 8,'R: '.$row['R100cos1'].' %', 1, 0, 'C', 0);
$pdf->Cell(15, 8,'S: '.$row['S100cos1'].' %', 1, 0, 'C', 0);
$pdf->Cell(15, 8,'T: '.$row['T100cos1'].' %', 1, 0, 'C', 0);
$pdf->Cell(45, 8,utf8_decode('Trifásico'), 1, 0, 'C', 0);
$pdf->Cell(45, 8,$row['RST100cos1'].' %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,utf8_decode('100% Cos = 0,5'), 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,$row['RST100cos05'].' %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'20% Cos = 0,5', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,$row['RST20cos05'].' %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'5% Cos = 1', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,$row['RST5cos1'].' %', 1, 1, 'C', 0);

$pdf->Ln(5);

$pdf->Cell(60, 8,'MEDIDOR REACTIVO PRINCIPAL ', 1, 1, 'C', 0);

$pdf->Ln(5);

$pdf->Cell(45, 8,'Tipo: '.$row['prod_ctry'], 1, 0, 'C', 0);
$pdf->Cell(45, 8,utf8_decode('N° Laboratorio: ').$row['prod_code'], 1, 0, 'C', 0);
$pdf->Cell(45, 8,utf8_decode('N° Fábrica: ').$row['prod_name'], 1, 0, 'C', 0);
$pdf->Cell(45, 8,'ERROR', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'Estado anterior: ---------- KWh', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'Estado Posterior: 00000000.00 KWh', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'Posterior', 1, 1, 'C', 0);

$pdf->Cell(45, 8,utf8_decode('I. Máxima'), 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'0.00 %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'100% Cos = 1', 1, 0, 'C', 0);
$pdf->Cell(15, 8,'R: 0.00%', 1, 0, 'C', 0);
$pdf->Cell(15, 8,'S: 0.00%', 1, 0, 'C', 0);
$pdf->Cell(15, 8,'T: 0.00%', 1, 0, 'C', 0);
$pdf->Cell(45, 8,utf8_decode('Trifásico'), 1, 0, 'C', 0);
$pdf->Cell(45, 8,$row['RST100sen1'].'%', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'100% Cos = 0,5', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,$row['RST100sen05'].' %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'20% Cos = 0,5', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,$row['RST20sen05'].' %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'5% Cos = 1', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,$row['RST5sen1'].' %', 1, 1, 'C', 0);



$pdf->Ln(5);

$pdf->Cell(60, 8,'MEDIDOR ACTIVO RESPALDO', 1, 1, 'C', 0);

$pdf->Ln(5);

$pdf->Cell(45, 8,'-', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'-', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'-', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'ERROR', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'Estado anterior: ----------', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'Estado Posterior: ----------', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'Posterior', 1, 1, 'C', 0);

$pdf->Cell(45, 8,utf8_decode('I. Máxima'), 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'0.00 %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'100% Cos = 1', 1, 0, 'C', 0);
$pdf->Cell(15, 8,'R: 0.00 %', 1, 0, 'C', 0);
$pdf->Cell(15, 8,'S: 0.00 %', 1, 0, 'C', 0);
$pdf->Cell(15, 8,'T: 0.00 %', 1, 0, 'C', 0);
$pdf->Cell(45, 8,utf8_decode('Trifásico'), 1, 0, 'C', 0);
$pdf->Cell(45, 8,'0.00 %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'100% Cos = 0,5', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'0.00 %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'20% Cos = 0,5', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'0.00 %', 1, 1, 'C', 0);

$pdf->Cell(45, 8,'5% Cos = 1', 1, 0, 'C', 0);
$pdf->Cell(90, 8,'', 1, 0, 'C', 0);
$pdf->Cell(45, 8,'0.00 %', 1, 1, 'C', 0);

$pdf->Ln(6);


$pdf->Cell(90, 8,"Contrastador : D'Archivio Leandro", 1, 0, 'C', 0);
$pdf->Cell(90, 8,'Fecha: '.(date("d/m/Y", strtotime($row['fecha']))), 1, 1, 'C', 0);
$pdf->Cell(180, 8,utf8_decode('Contrastado con: Inyector ZERA VCS 320 NR.97-626-8 y Patrón ZERA TPZ303 NR.97-855-2'), 1, 1, 'C', 0);

$pdf->AddPage();

$pdf->Cell(60, 4,utf8_decode('N° Equipo: ').number_format($row['price'],0,'',''), 1, 0, 'C', 0);
$pdf->Cell(45, 4,utf8_decode('N° Laboratorio: ').$row['prod_code'], 1, 0, 'C', 0);
$pdf->Cell(45, 4,utf8_decode('N° Fábrica: ').$row['prod_name'], 1, 1, 'C', 0);

$pdf->Cell(75, 4,"Contrastador : D'Archivio Leandro", 1, 0, 'C', 0);
$pdf->Cell(40, 4,'Fecha: '.(date("d/m/Y", strtotime($row['fecha']))), 1, 0, 'C', 0);
$pdf->Cell(35, 4,"Inyector: Zera VCS 320", 1, 1, 'C', 0);




$pdf->Cell(20, 4,"Act.Principal:", 1, 0, 'C', 0);
$pdf->Cell(15, 4,"IM: 0.00 %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,$row['RST100cos1']." %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,$row['RST100cos05']." %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,$row['RST20cos05']." %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,$row['RST5cos1']." %", 1, 0, 'C', 0);
$pdf->Cell(35, 4,"NR.97-626-8", 1, 1, 'C', 0);


$pdf->Cell(20, 4,"Reactivo:", 1, 0, 'C', 0);
$pdf->Cell(15, 4,"IM: 0.00 %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,$row['RST100sen1']." %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,$row['RST100sen05']." %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,$row['RST20sen05']." %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,$row['RST5sen1']." %", 1, 0, 'C', 0);
$pdf->Cell(35, 4,utf8_decode("Patrón: TPZ 303"), 1, 1, 'C', 0);



$pdf->Cell(20, 4,"Act.Respaldo:", 1, 0, 'C', 0);
$pdf->Cell(15, 4,"IM: 0.00 %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,"0.00 %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,"0.00 %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,"0.00 %", 1, 0, 'C', 0);
$pdf->Cell(20, 4,"0.00 %", 1, 0, 'C', 0);
$pdf->Cell(35, 4,"NR.97-855-2", 1, 1, 'C', 0);









}



$pdf->Output();
?>

