<?php
	if (empty($_POST['prod_code'])){
		$errors[] = "Ingresa el Num de medidor.";
	} elseif (!empty($_POST['prod_code'])){
	require_once ("../../conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
        $prod_code = mysqli_real_escape_string($con,(strip_tags($_POST["prod_code"],ENT_QUOTES)));
	$prod_name = mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
	$prod_ctry = mysqli_real_escape_string($con,(strip_tags($_POST["category"],ENT_QUOTES)));



//OJO       VER SI ESTAN TODOS LOS CAMPOS BIEN, ARREGLAR LO DE ABAJO


	$R154A = floatval($_POST["R154A"]);
	$S154A = floatval($_POST["S154A"]);
	$T154A = floatval($_POST["T154A"]);

	$R187A = floatval($_POST["R187A"]);
	$S187A = floatval($_POST["S187A"]);
	$T187A = floatval($_POST["T187A"]);

	$R220A = floatval($_POST["R220A"]);
	$S220A = floatval($_POST["S220A"]);
	$T220A = floatval($_POST["T220A"]);


	$R242A = floatval($_POST["R242A"]);
	$S242A = floatval($_POST["S242A"]);
	$T242A = floatval($_POST["T242A"]);

	$R264A = floatval($_POST["R264A"]);
	$S264A = floatval($_POST["S264A"]);
	$T264A = floatval($_POST["T264A"]);




	$R154 = floatval($_POST["R154"]);
	$S154 = floatval($_POST["S154"]);
	$T154 = floatval($_POST["T154"]);

	$R187 = floatval($_POST["R187"]);
	$S187 = floatval($_POST["S187"]);
	$T187 = floatval($_POST["T187"]);

	$R220 = floatval($_POST["R220"]);
	$S220 = floatval($_POST["S220"]);
	$T220 = floatval($_POST["T220"]);


	$R242 = floatval($_POST["R242"]);
	$S242 = floatval($_POST["S242"]);
	$T242 = floatval($_POST["T242"]);

	$R264 = floatval($_POST["R264"]);
	$S264 = floatval($_POST["S264"]);
	$T264 = floatval($_POST["T264"]);


	$fecha = date($_POST["fecha"]);

	$temperatura = floatval($_POST["temperatura"]);


	// REGISTER data into database



$sql = "INSERT INTO calidad(id, prod_code, fecha, R154, S154, T154, R187, S187, T187, R220, S220, T220, R242, S242, T242, R264, S264, T264, R154A, S154A, T154A, R187A, S187A, T187A, R220A, S220A, T220A, R242A, S242A, T242A, R264A, S264A, T264A, temperatura

) VALUES (NULL,'$prod_code','$fecha','$R154', '$S154', '$T154', '$R187', '$S187', '$T187', '$R220', '$S220', '$T220', '$R242', '$S242', '$T242', '$R264', '$S264', '$T264','$R154A', '$S154A', '$T154A', '$R187A', '$S187A', '$T187A', '$R220A', '$S220A', '$T220A', '$R242A', '$S242A', '$T242A', '$R264A', '$S264A', '$T264A', '$temperatura')";






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