<?php
	
	/* Connect To Database*/
	require_once ("../../conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="calidad";
	$campos="*";
	$sWhere=" calidad.prod_code LIKE '%".$query."%'                 ";
	$sWhere.=" order by calidad.fecha DESC";
	
	
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
						<th class='text-center'>N°Equipo</th>

						<th class='text-center'>Fecha</th>
				
						<th class='text-center'>R 154</th>
						<th class='text-center'>S 154</th>
						<th class='text-center'>T 154</th>

						<th class='text-center'>R 187</th>
						<th class='text-center'>S 187</th>
						<th class='text-center'>T 187</th>


						<th class='text-center'>R 220</th>
						<th class='text-center'>S 220</th>
						<th class='text-center'>T 220</th>

						<th class='text-center'>R 242</th>
						<th class='text-center'>S 242</th>
						<th class='text-center'>T 242</th>

						<th class='text-center'>R 264</th>
						<th class='text-center'>S 264</th>
						<th class='text-center'>T 264</th>




						<th></th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$product_id=$row['id'];
							$prod_code=$row['prod_code'];

							$fecha=$row['fecha'];


							$R154=$row['R154'];
							$S154=$row['S154'];
							$T154=$row['T154'];

							$R187=$row['R187'];
							$S187=$row['S187'];
							$T187=$row['T187'];

							$R220=$row['R220'];
							$S220=$row['S220'];
							$T220=$row['T220'];

							$R242=$row['R242'];
							$S242=$row['S242'];
							$T242=$row['T242'];

							$R264=$row['R264'];
							$S264=$row['S264'];
							$T264=$row['T264'];





							$finales++;
						?>	
						<tr class="<?php echo $text_class; ?>">
							<td class='text-center'><?php echo $prod_code;?></td>

							<td class='text-center'><?php $fecha2 = date("d/m/Y", strtotime($fecha));echo $fecha2;?></td>
							<!--td class='text-center'><?php echo number_format($price,0,'','');?></td>
-->
							<td class='text-center'><?php echo number_format($R154,3);?></td>
							<td class='text-center'><?php echo number_format($S154,3);?></td>
							<td class='text-center'><?php echo number_format($T154,3);?></td>

							<td class='text-center'><?php echo number_format($R187,3);?></td>
							<td class='text-center'><?php echo number_format($S187,3);?></td>
							<td class='text-center'><?php echo number_format($T187,3);?></td>

							<td class='text-center'><?php echo number_format($R220,3);?></td>
							<td class='text-center'><?php echo number_format($S220,3);?></td>
							<td class='text-center'><?php echo number_format($T220,3);?></td>

							<td class='text-center'><?php echo number_format($R242,3);?></td>
							<td class='text-center'><?php echo number_format($S242,3);?></td>
							<td class='text-center'><?php echo number_format($T242,3);?></td>


							<td class='text-center'><?php echo number_format($R264,3);?></td>
							<td class='text-center'><?php echo number_format($S264,3);?></td>
							<td class='text-center'><?php echo number_format($T264,3);?></td>

					<td>





<?php 
echo "<a href="."imprimir.php?id=".$product_id." target='__BLANK'><i class='material-icons' title='Generar informe'>&#xE258</i></a>"; 

?>



                    		</td>



						<!--</tr>-->
						<?php }?>
						<tr>
							<td colspan='17'> 
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
		  
