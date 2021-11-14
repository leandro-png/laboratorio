<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Laboratorio de Mediciones</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/custom.css">
</head>
<body>

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
<a href="../index.php"><img style="float:left; display:inline-block"  class="header-img" src="../css/rubik.png" alt="logo" height="35px" width="35px"/></a>
						<h4>Seguimiento de Medidores - Consultar</h4>
					</div>
            </div>
            </div>
			</div>
		<hr>


<style>
table, th, td {
  border: 1px solid black;
padding:3px;}

table.center {
  margin-left: auto;
  margin-right: auto;}
  
.padre {
  display: flex;
  justify-content: left;}
  
.hijo {
  padding: 1px;
  margin: 1px;
padding-right:100px;
 // background-color: yellow;}
</style>


<form action="consultar.php" method="GET" name="form3">

<div class="padre">
<div class="hijo">

<input type="radio" name="labfab" value="lab" checked="checked">
<label for="labora">Laboratorio:</label>
<input type="radio" name="labfab" value="fab">
<label for="fabric">Fábrica:</label>
</div>
<div class="hijo">
<input type="text" name="medidor"/>
<input type="submit" value="Buscar"/>
</div>

<?php
$labfab  = $_GET['labfab'];
$medidor = $_GET['medidor'];
require_once("../conexion.php");


if ($labfab == "lab")  
{
$resultado=mysqli_query($con,"SELECT * from seguimiento_med inner join seguimiento_situacion on 
((seguimiento_situacion.id_medidores = seguimiento_med.id) and ($medidor = seguimiento_med.laboratorio)) ORDER BY id ASC LIMIT 1,30");
}
else 
{
$resultado=mysqli_query($con,"SELECT * from seguimiento_med inner join seguimiento_situacion on 
((seguimiento_situacion.id_medidores = seguimiento_med.id) and ($medidor = seguimiento_med.fabrica)) ORDER BY id ASC LIMIT 1,30");
}






$registro=mysqli_fetch_array($resultado);



if (isset($registro[1])) {
?>

<div class="hijo">

<?php
echo "<hr>";
echo "</div>";
echo "</div>";
echo "<div class='padre'>";
echo "<div class='hijo'>";

echo "<fieldset>";
echo "<legend>Medidor</legend>";
$id = $registro['id'];
//echo "<p><b>Id: </b>".$registro['id'];
echo "<p><b>N° Lab: </b>".$registro['laboratorio'];


   if (($registro['marca'] == 'DISCAR') and ($registro['corriente'] == '5-(80)')  and (substr($registro['fabrica'],0,4) != 'DTGA')   )  
   {echo "<p><b>N° Fab: </b><a href='https://edea.mrdims.com/admin/Terminales/MostrarGeneral3?SerieTerminal=DTGA000".$registro['fabrica']."' target='_BLANK'>DTGA000".$registro['fabrica']."</a></p>";}  

   elseif (($registro['marca'] == 'DISCAR') and ($registro['corriente'] == '5-(10)')  and (substr($registro['fabrica'],0,4) != 'DIGA')   )  
   {echo "<p><b>N° Fab: </b><a href='https://edea.mrdims.com/admin/Terminales/MostrarGeneral3?SerieTerminal=DIGA000".$registro['fabrica']."' target='_BLANK'>DIGA000".$registro['fabrica']."</a></p>";}  
   else { echo "<p><b>N° Fab: </b>".$registro['fabrica']."</p>"; }



echo "<p><b>Marca: </b>".$registro['marca']."</p>";
echo "<p><b>Modelo: </b>".$registro['modelo']."</p>";
echo "<p><b>Tension: </b>".$registro['tension']."</p>";
echo "<p><b>Corriente: </b>".$registro['corriente']."</p>";
echo "<p><b>Año: </b>".$registro['anio']."</p>";
echo "<p><b>Fecha: </b>".date('d/m/Y',strtotime($registro['fecha']))."</p>";
echo "<p><b>Situación actual: </b>".$registro['situacion']."</p>";

if (   substr($registro['situacion'],0,7) == "Cliente" ) { 
$cliente = substr($registro['situacion'],8,30); 
//echo $cliente;
$resultadx=mysqli_query($con,"SELECT * from seguimiento_titular WHERE seguimiento_titular.cuenta LIKE '%$cliente%'   ");
$registrx=mysqli_fetch_array($resultadx);
?>



<table>
<tr><td><?php echo $registrx['cuenta'];?></td></tr>
<tr><td><?php echo $registrx['titular'];?></td></tr>
<tr><td><?php echo $registrx['calle'].' '.$registrx['altura'].' ('.$registrx['tarifa'];?></td></tr>
<!-----ROMPER LA CUENTA COMPLETA EN SUCURSAL Y CUENTA Y SE LLAMARÁ CUEN1 y CUEN2, CUEN2 tiene 7 caracteres-
si   strlen=10  ----  cuen1 los 2 primeros caracteres y cuen2 los ultimos 7
si   strlen=9   ----  cuen1 el primer caracter y cuen2 los ultimos 7
------------------------------->
<?php
if ( strlen($registrx['cuenta']) == 10 ) { $cuen1 = substr($registrx['cuenta'],0, -8); $cuen2 = substr($registrx['cuenta'],-7);}
else { $cuen1 = substr($registrx['cuenta'],0, -8); $cuen2 = substr($registrx['cuenta'],-7);}
echo '<tr><td><a href="http://app.edeaweb.com.ar/intranet/m_pantalla_universal/main.php?suc='.$cuen1.'&cta='.$cuen2.'" target="_blank">Intranet</a></td></tr>';
?>
</table>
<br>
<?php
}




/////8888888888888888888888888888888888888     ULTIMO ENSAYO     88888888888888888888888888888888888888888888888888888888888888888888888
$resultad=mysqli_query($con,"SELECT * from ensayo_trifasicos WHERE prod_code = '$registro[laboratorio]'  ORDER BY fecha  DESC ");
$registr=mysqli_fetch_array($resultad);

if ( $registr[id != ""] )  {echo "<a href='../medidoresyequipos/imprimir.php?id=".$registr[id]."' target='_BLANK'>ULTIMO ENSAYO (".date('d/m/Y',strtotime($registr['fecha'])).")</a>";}
//////8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888




echo "</div>";
echo "<div class='hijo'>";

echo "</fieldset>";
echo "<table class='left'>";


$resultado=mysqli_query($con,"SELECT * from seguimiento_med join seguimiento_situacion 
on (seguimiento_situacion.id_medidores = seguimiento_med.id and $id = seguimiento_med.id)  ORDER by fecha_ DESC");

echo "<legend>Historial</legend>";
while($registro=mysqli_fetch_array($resultado)){
						echo "</fieldset>";
						echo "</form>";
						echo "<tr>";
//						echo "<th><b>".date('d/m/Y',strtotime($registro['fecha_']))."</th><th>".$registro['situacion_']."</b></th>";

if (   substr($registro['situacion_'],0,7) == "Cliente" ) { 
                                                            $cliente = substr($registro['situacion_'],8,30); 
                                                            if ( strlen($cliente) == 10 ) { $cuen1 = substr($cliente,0, -8); $cuen2 = substr($cliente,-7);}
                                                            else { $cuen1 = substr($cliente,0, -8); $cuen2 = substr($cliente,-7);}
                                                            echo '<th><b>'.date('d/m/Y',strtotime($registro['fecha_'])).'</th><th><a href="http://app.edeaweb.com.ar/intranet/m_pantalla_universal/main.php?suc='.$cuen1.'&cta='.$cuen2.'" target="_blank">'.$registro['situacion_'].'</a></b></th>';
                                                           }       
else  { echo "<th><b>".date('d/m/Y',strtotime($registro['fecha_']))."</th><th>".$registro['situacion_']."</b></th>";}   




						echo "</tr>";
						}
echo "</table>";
}
mysql_close($con);
?>



      </div>
    </div>
</body>
</html>
