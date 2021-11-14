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
$consulta = "SELECT * FROM calidad WHERE id = ".$aei;

$resultado = $con->query($consulta);





$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);


while($row = $resultado->fetch_assoc()){

$pdf->Image('../css/logo.png',10,6,30,0,'PNG');

$pdf->Ln(5);

//$pdf->Cell(180, 8,$aei, 1, 1, 'C', 0);


$pdf->Cell(80, 6,'', 0, 0);
$pdf->Cell(60, 6,'', 0, 0);
$pdf->Cell(45, 6,utf8_decode('PROTOCOLO N° : ').number_format($row['prod_code'],0,'','').' - '.date("y", strtotime($row['fecha'])), 1, 1, 'C');

$pdf->SetFont('Arial','B',13);

$pdf->Ln(7);
$pdf->Cell(185, 0,'', 1, 1, 'C', 0);

$pdf->Cell(185, 10,'PROTOCOLO DE  ENSAYO EN LABORATORIO', 0, 1, 'C', 0);
$pdf->SetFont('Arial','B',8);

$pdf->Cell(80, 6,'', 0, 0);
$pdf->Cell(60, 6,'', 0, 0);
$pdf->Cell(45, 6,'Fecha :  '.date("d/m/Y",strtotime($row['fecha'])), 0, 1, 'C');

$pdf->Ln(7);

$pdf->Cell(186, 4,'DATOS DEL INSTRUMENTO A ENSAYAR', 1, 1, 'L', 0);
$pdf->Cell(70, 4,'Marca:  Circutor', 1, 0);
$pdf->Cell(50, 4,'', 1, 0);
$pdf->Cell(22, 4,utf8_decode('Tensión (V)'), 1, 0);
$pdf->Cell(22, 4,utf8_decode('Corriente (../V)'), 1, 0);
$pdf->Cell(22, 4,utf8_decode('Energía'), 1, 1);



$pdf->Cell(70, 4,'Modelo:', 1, 0);
$pdf->Cell(30, 4,'', 1, 0);
$pdf->Cell(20, 4,utf8_decode('Alcances'), 1, 0);
$pdf->Cell(22, 4,utf8_decode('220'), 1,0 );
$pdf->Cell(22, 4,utf8_decode(''), 1,0 );
$pdf->Cell(22, 4,utf8_decode(''), 1,1 );



$pdf->Cell(70, 4,utf8_decode('N° Equipo:  ').number_format($row['prod_code'],0,'',''), 1, 0);
$pdf->Cell(30, 4,'', 1, 0);
$pdf->Cell(20, 4,utf8_decode('Clase'), 1, 0);
$pdf->Cell(22, 4,utf8_decode('0.5'), 1,0 );
$pdf->Cell(22, 4,utf8_decode(''), 1,0 );
$pdf->Cell(22, 4,utf8_decode(''), 1,1 );





$pdf->Ln(7);
$pdf->Cell(186, 4,'ENSAYO DE EXACTITUD EN LA MEDICION DE TENSION   -  Alcance 220 V', 1, 1, 'L', 0);



$pdf->Cell(60, 4,utf8_decode('Fase R'), 1,0 ,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(60, 4,utf8_decode('Fase S'), 1,0 ,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(60, 4,utf8_decode('Fase T'), 1,1 ,'C');



$pdf->Cell(20, 4,utf8_decode('Valor Indicado'), 1,0 ,'C');
$pdf->Cell(20, 4,utf8_decode('Valor patrón'), 1,0,'C');
$pdf->Cell(20, 4,utf8_decode('Error %'), 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,utf8_decode('Valor Indicado'), 1,0 ,'C');
$pdf->Cell(20, 4,utf8_decode('Valor patrón'), 1,0,'C');
$pdf->Cell(20, 4,utf8_decode('Error %'), 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,utf8_decode('Valor Indicado'), 1,0 ,'C');
$pdf->Cell(20, 4,utf8_decode('Valor patrón'), 1,0,'C');
$pdf->Cell(20, 4,utf8_decode('Error %'), 1,1,'C');



$pdf->Cell(20, 4,$row['R264A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['R264'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['R264A']-$row['R264'])*100)/$row['R264'],3).' %', 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,$row['S264A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['S264'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['S264A']-$row['S264'])*100)/$row['S264'],3).' %', 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,$row['T264A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['T264'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['T264A']-$row['T264'])*100)/$row['T264'],3).' %', 1,1,'C');

$pdf->Cell(20, 4,$row['R242A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['R242'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['R242A']-$row['R242'])*100)/$row['R242'],3).' %', 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,$row['S242A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['S242'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['S242A']-$row['S242'])*100)/$row['S242'],3).' %', 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,$row['T242A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['T242'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['T242A']-$row['T242'])*100)/$row['T242'],3).' %', 1,1,'C');

$pdf->Cell(20, 4,$row['R220A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['R220'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['R220A']-$row['R220'])*100)/$row['R220'],3).' %', 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,$row['S220A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['S220'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['S220A']-$row['S220'])*100)/$row['S220'],3).' %', 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,$row['T220A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['T220'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['T220A']-$row['T220'])*100)/$row['T220'],3).' %', 1,1,'C');

$pdf->Cell(20, 4,$row['R187A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['R187'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['R187A']-$row['R187'])*100)/$row['R187'],3).' %', 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,$row['S187A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['S187'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['S187A']-$row['S187'])*100)/$row['S187'],3).' %', 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,$row['T187A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['T187'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['T187A']-$row['T187'])*100)/$row['T187'],3).' %', 1,1,'C');

$pdf->Cell(20, 4,$row['R154A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['R154'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['R154A']-$row['R154'])*100)/$row['R154'],3).' %', 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,$row['S154A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['S154'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['S154A']-$row['S154'])*100)/$row['S154'],3).' %', 1,0,'C');
$pdf->Cell(3, 4,utf8_decode(''), 1,0 );
$pdf->Cell(20, 4,$row['T154A'], 1,0 ,'C');
$pdf->Cell(20, 4,$row['T154'], 1,0,'C');
$pdf->Cell(20, 4,number_format((($row['T154A']-$row['T154'])*100)/$row['T154'],3).' %', 1,1,'C');



$pdf->Ln(8);
$pdf->Cell(186, 4,'ENSAYO DE RIGIDEZ DIELECTRICA', 1, 1, 'L', 0);
$pdf->Cell(186, 6,utf8_decode('Tensión aplicada: 2KV        Resultado: Satisfactorio'), 1, 1, 'L', 0);
$pdf->Ln(2);
$pdf->Cell(186, 6,utf8_decode('Temperatura ambiente durante la realización del ensayo: '.$row['temperatura'].' °C'), 0, 1, 'L', 0);
$pdf->ln(8);
$pdf->Cell(186, 6,utf8_decode('Observaciones:                    Resultado: Satisfactorio'), 1,1,'L');
$pdf->ln(8);
$pdf->Cell(186, 4,utf8_decode('El ensayo fue realizado en el laboratorio de EDEA S.A. Se utilizó el siguiente equipamiento: Fuente inyectora marca ZERA modelo VCS320'), 0,1,'L:');
$pdf->Cell(186, 4,utf8_decode('N° 97-626-8 y medidor patrón marca FLUKE modelo 8846A N° 9449015.'), 0,1,'L:');

$pdf->ln(16);
$pdf->Cell(186, 4,utf8_decode('Ensayo realizado por: ____________________________                                            Supervisado por: _________________________________'), 0,1,'L:');
$pdf->Cell(100, 4,utf8_decode("Leandro D'Archivio"), 0,1,'C');

}




$pdf->Output();
?>

