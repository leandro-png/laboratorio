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
                          <h4>Seguimiento de Medidores - Alta</h4>
                    </div>
                </div>
           </div>
     </div>


<hr>

<style>
table, th, td {
  border: 1px solid black;
  padding:5px;}

table.center {
  margin-left: auto;
  margin-right: auto;}
</style>


<form id="miForm" action="alta.php" method="post">
<div style="text-align:right; width:220px">
<p>N° Laboratorio:	<input type="text" name="laboratorio" size="16"/></p>
<p>N° Fábrica:		<input type="text" name="fabrica" size="16"/></p>
<!----------------------------------------------------------->
<p>Marca:
<?php
require_once("../conexion.php");
$result = mysqli_query($con, "SELECT * FROM seguimiento_marcas");
?>
<select name="marca">
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?=$row["marca"];?>"><?=$row["marca"];?></option>
<?php
$i++;
}
?>
</select>
<?php
mysqli_close($conn);
?>
</p>
<!----------------------------------------------------------->
<p>Modelo:
<?php
$result = mysqli_query($con, "SELECT * FROM seguimiento_modelos");

?>
<select name="modelo">
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?=$row["modelo"];?>"><?=$row["modelo"];?></option>
<?php
$i++;
}
?>
</select>
<?php
mysqli_close($conn);
?>
</p>
<!----------------------------------------------------------->
<p>Tensión:
<?php
$result = mysqli_query($con, "SELECT * FROM seguimiento_tension");
?>
<select name="tension">
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?=$row["tensiones"];?>"><?=$row["tensiones"];?></option>
<?php
$i++;
}
?>
</select>
<?php
mysqli_close($conn);
?>
</p>
<!----------------------------------------------------------->
<p>Modelo:
<?php
$result = mysqli_query($con, "SELECT * FROM seguimiento_corriente");
?>
<select name="corriente">
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?=$row["corriente"];?>"><?=$row["corriente"];?></option>
<?php
$i++;
}
?>
</select>
<?php
mysqli_close($conn);
?>
</p>
<!----------------------------------------------------------->
<p>Año:			<input type="text" name="anio" size="6"/></p>
<p>Fecha:		<input type="date" name="fecha" /></p>
<!----------------------------------------------------------->
<p>Situación:
<?php
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
</p>
<!----------------------------------------------------------->
<p>Observación:			<input type="text" name="observacion" size="20"/></p>
<input type="submit" form="miForm" value="DAR DE ALTA"/>
</form>


<?php
$laboratorio = $_POST['laboratorio'];
$fabrica     = $_POST['fabrica'];
$marca       = $_POST['marca'];
$modelo      = $_POST['modelo'];
$tension     = $_POST['tension'];
$corriente   = $_POST['corriente'];
$anio        = $_POST['anio'];
$fecha       = $_POST['fecha'];
$situacion   = $_POST['situacion'];
$observacion = $_POST['observacion'];
$situacion   = $situacion.' '.$observacion;
?>

<?php
$result = mysqli_query($con, "INSERT INTO seguimiento_med (laboratorio,fabrica,marca,modelo,tension,corriente, anio,fecha,situacion) 
     VALUES('$laboratorio','$fabrica','$marca','$modelo','$tension','$corriente','$anio','$fecha','$situacion')");

//  EL ULTIMO ID
$ultimoid = mysqli_insert_id($con);


$result2 = mysqli_query($con, "INSERT INTO seguimiento_situacion (id_medidores,fecha_,situacion_) 
            VALUES('$ultimoid','$fecha','$situacion')");

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['laboratorio']))
{  if ($result) {
        $messages[] = "El medidor se ha guardado con éxito.";
    } else {
        $errors[] = "Por favor, regrese y vuelva a intentarlo.";
    }}
if (isset($errors))    {
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
mysqli_close($conn);
?>			

      </div>
    </div>
</body>
</html>
