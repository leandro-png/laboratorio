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
						<h4>Seguimiento de Medidores - Editar</h4>
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

<form action="editar.php" method="post" name="form1">

<div class="padre">
<div class="hijo">

<input type="radio" name="labfab" value="lab" checked="checked">
<label for="labora">Laboratorio:</label>
<input type="radio" name="labfab" value="fab">
<label for="fabric">Fábrica:</label>
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
$resultado=mysqli_query($con,"SELECT * from seguimiento_med inner join seguimiento_situacion on 
((seguimiento_situacion.id_medidores = seguimiento_med.id) and ($medidor = seguimiento_med.laboratorio))");
} 
else
{
$resultado=mysqli_query($con,"SELECT * from seguimiento_med inner join seguimiento_situacion on 
((seguimiento_situacion.id_medidores = seguimiento_med.id) and ($medidor = seguimiento_med.fabrica))");
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
    $id = $registro[id];
//    echo "<p><b>Id: </b>".$registro['id'];
    echo "<p><b>N° Lab: </b>".$registro['laboratorio']."</p>";
    echo "<p><b>N° Fab: </b>".$registro['fabrica']."</p>";
    echo "<p><b>Marca: </b>".$registro['marca']."</p>";
    echo "<p><b>Modelo: </b>".$registro['modelo']."</p>";
    echo "<p><b>Tension: </b>".$registro['tension']."</p>";
    echo "<p><b>Corriente: </b>".$registro['corriente']."</p>";
    echo "<p><b>Año: </b>".$registro['anio']."</p>";
    echo "<p><b>Fecha: </b>".date('d/m/Y',strtotime($registro['fecha']))."</p>";
    echo "<p><b>Situación actual: </b>".$registro['situacion']."</p>";
    echo "</div>";


    echo "<div class='hijo'>";
    ///////////////////////////////////////////////////////////////////

    echo "</fieldset>";
    echo "<table class='left'>";


$resultado=mysqli_query($con,"SELECT * from seguimiento_med join seguimiento_situacion 
on (seguimiento_situacion.id_medidores = seguimiento_med.id and $id = seguimiento_med.id)  ORDER by fecha_ DESC");





    echo "<legend>Historial</legend>";
    while($registro=mysqli_fetch_array($resultado)){
    echo "</fieldset>";
    echo "</form>";
    echo "<tr>";
    echo "<th><b>".date('d/m/Y',strtotime($registro['fecha_']))."</th><th>".$registro['situacion_']."</b></th>";
    echo "</tr>";
                                                    }

    echo "</table>";
?>

</div>
</div>

<!--------------PARTE II--------------------------------------->
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
   
<!-------------------------------------------------------->
    </div>
</body>
</html>
