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
						<h4>Equipos - Consular</h4>
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
 // background-color: yellow;
}
</style>

<script type="text/javascript">
function cartelito()
{ alert("Se guardó con éxito la nueva situación");}
</script>

<form action="consultar.php" method="post" name="form1">

<div class="padre">
<div class="hijo">

<input type="radio" name="labfab" value="lab" checked="checked">
<label for="labora">Laboratorio:</label>
<input type="radio" name="labfab" value="fab">
<label for="fabric">Fábrica:</label>

<input type="radio" name="labfab" value="cuenta">
<label for="fabric">Cuenta:</label>
</div>
<div class="hijo">
<input type="text" name="medidor"/>
<input type="submit" name="buscar" value="Buscar"/>
</div>

<?php

global $id;
$labfab  = $_POST['labfab'];
$medidor = $_POST['medidor'];
require_once("../conexion.php");

if ($labfab == "lab")
{
$resultado=mysqli_query($con,"SELECT * from equipos_equipos inner join equipos_trabajos on 
((equipos_equipos.id_equipo = equipos_trabajos.idequipos) and ($medidor = equipos_equipos.numlabo1))");
} 
elseif ($labfab == "fab")
{
$resultado=mysqli_query($con,"SELECT * from equipos_equipos inner join equipos_trabajos on 
((equipos_equipos.id_equipo = equipos_trabajos.idequipos) and ($medidor = equipos_equipos.numfab1))");
} elseif ($labfab == "cuenta")
{
$resultado=mysqli_query($con,"SELECT * from equipos_equipos inner join equipos_trabajos on 
((equipos_equipos.id_equipo = equipos_trabajos.idequipos) and ($medidor = equipos_equipos.numcuenta))");
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

//    $id = $registro[id];

 $id =  "6491";
?>






<table style="float:left; margin-right:50px;">
<tr>
<td><?php echo $registro['tipo_de_equipo'];?></td> 
<td><?php echo 'N° '.$registro['equipocoloc'];?></td>
<td><?php echo 'Estado: '.$registro['situacion'];?></td>
<td><?php echo 'Fecha: '.date('d/m/Y',strtotime($registro['fechacoloc']));?></td>

<td><?php echo 'OT colocación: '.$registro['otcolocacion'];?></td>
<td><?php echo 'Cuenta: '.$registro['numcuenta'];?></td>
</tr>
<tr>
<td colspan="4"><?php echo 'Usuario: '.$registro['usuario'];?></td>
<td colspan="2"><?php echo 'Establecimiento: '.$registro['establecimiento'];?></td>
</tr>
<tr>
<td colspan="3"><?php echo 'Dirección: '.$registro['direccion'];?></td>
<td><?php echo 'Zona: '.$registro['zona'];?></td>
<td><?php echo 'Ciudad: '.$registro['ciudad'];?></td>
<td><?php echo 'Sucursal:dd ';?></td>
</tr>
<tr>
<td><?php echo 'Tarifa: '.$registro['tarifa'];?></td>
<td><?php echo 'Tensión: '.$registro['tension'];?></td>
<td><?php echo 'Potencia: '.$registro['potconvenid'];?></td>
<td><?php echo 'Entrada: '.$registro['entrada'];?></td>
<td><?php echo 'Medidor principal: '.$registro['tipo'];?></td>
<td><?php echo 'Factor Multiplicación: '.$registro['factormultiplicacion'];?></td>
</tr>
</table>






<table style="position:relative;float:right;top:0px;margin-left:50px;">
<tr><td>X</td><td>R</td><td>S</td><td>T</td></tr>
<tr><td>Número</td><td><?php echo $registro['fabrica4']; ?></td><td><?php echo $registro['fabrica5']; ?></td><td><?php echo $registro['fabrica6']; ?></td></tr>
<tr><td>Marca</td><td><?php echo $registro['marcat4']; ?></td><td><?php echo $registro['marcat5']; ?></td><td><?php echo $registro['marcat6']; ?></td></tr>
<tr><td>Tipo</td><td><?php echo $registro['tipot4']; ?></td><td><?php echo $registro['tipot5']; ?></td><td><?php echo $registro['tipot6']; ?></td></tr>
<tr><td>Clase</td><td><?php echo $registro['claset4']; ?></td><td><?php echo $registro['claset5']; ?></td><td><?php echo $registro['claset6']; ?></td></tr>
<tr><td>Prestacion</td><td><?php echo $registro['volamperir']; ?></td><td><?php echo $registro['volamperis']; ?></td><td><?php echo $registro['volamperit']; ?></td></tr>
</table>

<?php echo '<p style="position:relative;float:right;">Relación: '.$registro['relaciontraf'].'</p>'; ?>











<div>

<table style="float:left;margin-top:30px;">
<tr><td>N° Laboratorio</td><td><?php echo '<a href="../seguimiento/consultar.php?labfab=lab&medidor='.$registro[numlabo1].'" target="_blank">'.$registro[numlabo1].'</a></td></tr>';?>
<tr><td>N° Fábrica</td><td><?php echo $registro['numfab1']; ?></td></tr>
<tr><td>Marca</td><td><?php echo $registro['marca1']; ?></td></tr>
<tr><td>Tipo</td><td><?php echo $registro['tipomed1']; ?></td></tr>
<tr><td>Corriente</td><td><?php echo $registro['amper1']; ?></td></tr>
<tr><td>Año</td><td><?php echo $registro['anio1']; ?></td></tr>
<tr><td>Constante</td><td><?php echo $registro['cte1']; ?></td></tr>
<tr><td>(04)</td><td><?php echo $registro['eat']; ?></td></tr>
<tr><td>(05)</td><td><?php echo $registro['pap']; ?></td></tr>
<tr><td>(06)</td><td><?php echo $registro['er']; ?></td></tr>
<tr><td>(07)</td><td><?php echo $registro['pir']; ?></td></tr>
<tr><td>(09)</td><td><?php echo $registro['par']; ?></td></tr>
<tr><td>(10)</td><td><?php echo $registro['evefp']; ?></td></tr>
<tr><td>(11)</td><td><?php echo $registro['pivpifp']; ?></td></tr>
<tr><td>(13)</td><td><?php echo $registro['pavpafp']; ?></td></tr>
<tr><td>(14)</td><td><?php echo $registro['par']; ?></td></tr>
<tr><td>(15)</td><td><?php echo $registro['par']; ?></td></tr>
</table>




<table  style="float:left; margin-top:30px; margin-left:30px;">
<tr><td>N° Laboratorio</td><td><?php echo $registro[numlabo2]; ?></td></tr>
<tr><td>N° Fábrica</td><td><?php echo $registro['numfab2']; ?></td></tr>
<tr><td>Marca</td><td><?php echo $registro['marca2']; ?></td></tr>
<tr><td>Tipo</td><td><?php echo $registro['tipomed2']; ?></td></tr>
<tr><td>Corriente</td><td><?php echo $registro['amper2']; ?></td></tr>
<tr><td>Año</td><td><?php echo $registro['anio2']; ?></td></tr>
<tr><td>Constante</td><td><?php echo $registro['cte2']; ?></td></tr>
<tr><td>Estado (17)</td><td><?php echo $registro['eat']; ?></td></tr>
<tr><td colspan="2">REACTIVO</td></tr>
<tr><td>N° Laboratorio</td><td><?php echo $registro['er']; ?></td></tr>
<tr><td>N° Fábrica</td><td><?php echo $registro['pir']; ?></td></tr>
<tr><td>Marca</td><td><?php echo $registro['par']; ?></td></tr>
<tr><td>Tipo</td><td><?php echo $registro['evefp']; ?></td></tr>
<tr><td>Corriente</td><td><?php echo $registro['pivpifp']; ?></td></tr>
<tr><td>Año</td><td><?php echo $registro['pavpafp']; ?></td></tr>
<tr><td>Constante</td><td><?php echo $registro['par']; ?></td></tr>
<tr><td>no se q mierda</td><td><?php echo $registro['par']; ?></td></tr>
</table>

</div>












<?php

$id = $registro[id_equipo];


$resultado2=mysqli_query($con,"SELECT * from equipos_equipos join equipos_trabajos 
on (equipos_trabajos.idequipos = equipos_equipos.id_equipo and $id = equipos_equipos.id_equipo ) ORDER BY fecha ASC");




echo "<table style='position:relative;float:left;top:0px;margin-top:50px;'>";
    while($registro3=mysqli_fetch_array($resultado2))
   {
    echo "<tr>";
//    echo "<th>".$registro3['usuario']."</th>";
//    echo "<th>".$registro3['direccion']."</th>";
//    echo "<th>".$registro3['numero']."</th>";
    echo "<th>OT: ".$registro3['ot']."</th>";
    echo "<th>".$registro3['trabajo']."</th>";
    echo "<th>".$registro3['mantenimiento']."</th>";
    echo "<th>".date('d/m/Y',strtotime($registro3['fecha']))."</th>";
    echo "<th>".$registro3['observaciones']."</th>";
//    echo "<th>".$registro3['idequipos']."</th>";
    echo "<th>".$registro3['operario']."</th>";
    echo "</tr>";
    }


    echo "</table>";
?>

<!--</div>
</div>
-->
<!--------------PARTE II---------------------------------------
<?php
echo "<div class='hijo'>";
echo "<fieldset>";
echo "<legend>Modificar situación</legend>";
echo "<form action='editar.php?ID=".$id."' method='post' name='form3'>";



    echo "Fecha:<input type='date' name='nuevafecha'>";
    echo "Situación nueva:";

    $result = mysqli_query($con, "SELECT * FROM seguimiento_tiposituac");
    ?>
    <select name="situacion">
    <?php
    $i=0;
	while($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?=$row["situac"];?>"><?=$row["situac"];?></option>
    <?php
    $i++;
    }
    ?>
    </select>
    <?php
    mysqli_close($conn);
    ?>
    Observacion:<input type='text' name='observacionnueva' size='16'>
    <input type="submit"  name="agregar" value="Agregar" onclick="cartelito()"/>
<?php }
$observacionnueva = $_POST['observacionnueva'];
$nuevafecha = $_POST['nuevafecha'];
$situac = $_POST['situacion'];
$aei = $_GET["ID"];

$resultado=mysqli_query($con,"INSERT INTO seguimiento_situacion ( id_medidores , fecha_ , situacion_) VALUE ('$aei','$nuevafecha','$situac  $observacionnueva' )");
$resultado=mysqli_query($con,"UPDATE seguimiento_med SET situacion='$situac $observacionnueva' WHERE id=$aei ");

  mysql_close($con);
?>
</form>
   
<!-------------------------------------------------------
    </div>-->
</body>
</html>
