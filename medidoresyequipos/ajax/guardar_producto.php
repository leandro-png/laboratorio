<?php
	if (empty($_POST['name'])){
		$errors[] = "Ingresa el Num de medidor.";
	} elseif (!empty($_POST['name'])){
	require_once ("../../conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
    $prod_code = mysqli_real_escape_string($con,(strip_tags($_POST["code"],ENT_QUOTES)));
	$prod_name = mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
	$prod_ctry = mysqli_real_escape_string($con,(strip_tags($_POST["category"],ENT_QUOTES)));
	$stock = intval($_POST["stock"]);
	$price = floatval($_POST["price"]);
	$RST100cos1 = floatval($_POST["RST100cos1"]);
	$RST100cos05 = floatval($_POST["RST100cos05"]);
	$RST20cos05 = floatval($_POST["RST20cos05"]);
	$RST5cos1 = floatval($_POST["RST5cos1"]);
	$RST100sen1 = floatval($_POST["RST100sen1"]);
	$RST100sen05 = floatval($_POST["RST100sen05"]);
	$RST20sen05 = floatval($_POST["RST20sen05"]);
	$RST5sen1 = floatval($_POST["RST5sen1"]);
	$R100cos1 = floatval($_POST["R100cos1"]);
	$S100cos1 = floatval($_POST["S100cos1"]);
	$T100cos1 = floatval($_POST["T100cos1"]);
	$fecha = date($_POST["fecha"]);

	// REGISTER data into database
    $sql = "INSERT INTO ensayo_trifasicos(id, prod_code, prod_name, prod_ctry, prod_qty, price, RST100cos1, RST100cos05, RST20cos05, RST5cos1, RST100sen1, RST100sen05, RST20sen05, RST5sen1, R100cos1, S100cos1, T100cos1, fecha


) VALUES (NULL,'$prod_code','$prod_name','$prod_ctry','$stock','$price','$RST100cos1','$RST100cos05','$RST20cos05','$RST5cos1','$RST100sen1','$RST100sen05','$RST20sen05','$RST5sen1','$R100cos1','$S100cos1','$T100cos1','$fecha'


)";
    $query = mysqli_query($con,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El medidor ha sido guardado con éxito.";
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} else 
	{
		$errors[] = "desconocido.";
	}
if (isset($errors)){
			
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
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>			