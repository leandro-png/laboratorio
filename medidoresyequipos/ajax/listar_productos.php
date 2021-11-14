<?php
	
	/* Connect To Database*/
	require_once ("../../conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="ensayo_trifasicos";
	$campos="*";
	$sWhere=" ensayo_trifasicos.prod_code LIKE '%".$query."%' OR  ensayo_trifasicos.prod_name LIKE '%".$query."%'  OR  ensayo_trifasicos.price LIKE '%".$query."%'                ";
	$sWhere.=" order by ensayo_trifasicos.fecha DESC";
	
	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
	$total_pages = ceil($numrows/$per_page);
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
	


		
	
	if ($numrows>0){
		
	?>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class='text-center'>N° Lab</th>
						<th>N° Fáb</th>
						<th>Modelo</th>
						<th class='text-center'>Año</th>
						<th class='text-center'>Fecha</th>
						<th class='text-center'>N° Equipo</th>
						<th class='text-center'>RST 100% cos1</th>
						<th class='text-center'>RST 100% cos.5</th>
						<th class='text-center'>RST 20% cos.5</th>
						<th class='text-center'>RST 5% cos1</th>


						<th class='text-center'>RST 100% sen1</th>
						<th class='text-center'>RST 100% sen.5</th>
						<th class='text-center'>RST 20% sen.5</th>
						<th class='text-center'>RST 5% sen1</th>

						<th class='text-center'>R 100% cos1</th>
						<th class='text-center'>S 100% cos1</th>
						<th class='text-center'>T 100% cos1</th>






						<th></th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$product_id=$row['id'];
							$prod_code=$row['prod_code'];
							$prod_name=$row['prod_name'];
							$prod_ctry=$row['prod_ctry'];
							$prod_qty=$row['prod_qty'];
							$fecha=$row['fecha'];
							$price=$row['price'];						
							$RST100cos1=$row['RST100cos1'];
							$RST100cos05=$row['RST100cos05'];
							$RST20cos05=$row['RST20cos05'];
							$RST5cos1=$row['RST5cos1'];

							$RST100sen1=$row['RST100sen1'];
							$RST100sen05=$row['RST100sen05'];
							$RST20sen05=$row['RST20sen05'];
							$RST5sen1=$row['RST5sen1'];

							$R100cos1=$row['R100cos1'];
							$S100cos1=$row['S100cos1'];
							$T100cos1=$row['T100cos1'];


							$finales++;
						?>	
						<tr class="<?php echo $text_class; ?>">
<!--							<td class='text-center'><?php echo $prod_code;?></td>
--->

							<td class='text-center'><?php 
//echo $prod_code;
echo "<a href='../seguimiento/consultar.php?labfab=lab&medidor=".$prod_code."' target='_BLANK'>".$prod_code."</a>";
?></td>


							<td ><?php 
							//	$DXGA = substr($prod_name,0,4);
							//	$NUME = substr($prod_name,-5);
								if ($prod_ctry == 'DIMET3-G') { echo '<a href="https://edea.mrdims.com/admin/Terminales/MostrarGeneral3?SerieTerminal=DTGA000',$prod_name,'" target="_BLANK">',$prod_name,'</a>'; }
								elseif ($prod_ctry == 'Dimet3GCT') { echo '<a href="https://edea.mrdims.com/admin/Terminales/MostrarGeneral3?SerieTerminal=DIGA000',$prod_name,'" target="_BLANK">',$prod_name,'</a>'; }
								else {echo $prod_name;}?></td>
							<td ><?php echo $prod_ctry;?></td>
							<td class='text-center' ><?php echo $prod_qty;?></td>
							<td class='text-center'><?php $fecha2 = date("d/m/Y", strtotime($fecha));echo $fecha2;?></td>
							<td class='text-center'><?php echo number_format($price,0,'','');?></td>
							<td class='text-center'><?php echo number_format($RST100cos1,2);?></td>
							<td class='text-center'><?php echo number_format($RST100cos05,2);?></td>
							<td class='text-center'><?php echo number_format($RST20cos05,2);?></td>
							<td class='text-center'><?php echo number_format($RST5cos1,2);?></td>
							<td class='text-center'><?php echo number_format($RST100sen1,2);?></td>
							<td class='text-center'><?php echo number_format($RST100sen05,2);?></td>
							<td class='text-center'><?php echo number_format($RST20sen05,2);?></td>
							<td class='text-center'><?php echo number_format($RST5sen1,2);?></td>
							<td class='text-center'><?php echo number_format($R100cos1,2);?></td>
							<td class='text-center'><?php echo number_format($S100cos1,2);?></td>
							<td class='text-center'><?php echo number_format($T100cos1,2);?></td>



					<td>

<!--
<a href="#"  
data-target="#editProductModal" class="edit" 
data-toggle="modal" 
data-code="<?php echo $prod_code;?>" 
data-name="<?php echo $prod_name?>" 
data-category="<?php echo $prod_ctry?>" 
data-stock="<?php echo $prod_qty?>" 
data-price="<?php echo $price;?>"
data-id="<?php echo $product_id;?>"><i class="material-icons" 
data-toggle="tooltip" 
title="Editar" >&#xE254;</i></a>
-->


<?php echo "<a href="."imprimir.php?id=".$product_id." target='_BLANK'><i class='material-icons' title='Generar informe'>&#xE258</i></a>"; ?>



					</td>




						<?php }?>
						<tr>
							<td colspan='18'> 
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros";
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
				</tbody>			
			</table>
		</div>	

	
	
	<?php	
	}	
}
?>          
		  
