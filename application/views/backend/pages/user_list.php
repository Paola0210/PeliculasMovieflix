<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title">
				
				<h4>LISTA DE USUARIOS</h4>
				<?php 
				$date_actual=intval(mktime(0, 0, 0, date("m"),   date("d"),   date("Y")));
				?>
			</div>
			<a style="margin: 10px;" href="<?php echo base_url();?>index.php?admin/sacar_pdfs" target="_blank" class="btn btn-info btn-xs btn-mini">
									 Generar PDF</a>
									 
			<div class="grid-body ">
				<table class="table table-hover table-condensed" id="example">
					<thead>
						<tr>
							<th>#</th>
							<th title="Seleccionar">SLC</th>
							<th>Correo </th>
							<th>Paquete </th>
							<th>Plan </th>
						</tr>
					</thead>
					
					<tbody>
						<?php
							$users = $this->db->get_where('user', array('user_id'))->result_array();
							$counter = 1;
							foreach ($users as $row):
							  ?>
						<tr>
							<td><?php echo $counter++;?></td>
							<td><input type="checkbox" class="form-check-input ckeliminacion_multiple" value="<?= $row['user_id']?>" id="eliminarid<?= $row['user_id'] ?>"></td>
							<td style="text-transform: uppercase;"><?php echo $row['email'];?></td>
							<td>
								<?php
								$suscripcion_actual = $this->db->get_where('subscription',array('user_id'=>$row['user_id'] ))->row(); 
									?>
							 <form>
					    			
								  
									 
								 
								
							 <?php /*?> activacion y desactivacion  de usuarios validando suscripcion<?php */?>
									<?php if(isset($suscripcion_actual)&& ( $date_actual<=intval($suscripcion_actual->timestamp_to) && $suscripcion_actual->status==1)){ ?> <a href="<?php echo base_url();?>index.php?admin/desactivar/<?php echo $row['user_id'];?>" class="btn btn-blue btn-xs btn-mini">
									Desactivar</a><?php }else{ ?>
										<a href="<?php echo base_url();?>index.php?admin/activar/<?php echo $row['user_id'];?>" class="btn btn-info btn-xs btn-mini">
									 Activar</a>
									<?php }?>
								      
								    <?php /*?> eliminacion de usuarios<?php */?>
								    <a  class="btn btn-danger btn-xs btn-mini" onclick='eliminarAction("<?php echo base_url();?>index.php?admin/user_delete/<?php echo $row["user_id"];?>");'>
								    Eliminar</a> 
					         </form>
								
							</td>
							<td><?php if($date_actual<=intval($suscripcion_actual->timestamp_to) && $suscripcion_actual->status==1){
										$plan_v =$this->db->get_where("plan",array('plan_id' => $suscripcion_actual->plan_id))->row();
										echo $plan_v->name;
									}?></td>
							</tr>
						
						<?php endforeach;?>
					</tbody>
				</table>

				<a style="margin: 10px;" href="<?php echo base_url();?>index.php?admin/exportar_activos_en_csv" target="_blank" class="btn btn-primary btn-xs btn-mini">
									 Generar CSV</a>
									 <!-- Este es el form para el cargue de el archivo csv con la lista a desactivar-->
									 <form method="post" action="<?php echo $base_url;?>index.php?admin/importar_csv_para_desactivar" enctype="multipart/form-data">
									 <label>Cargar Archivo</label>
									 <input type="file" id="cargar_csv" name="cargar_csv" accept=".csv" required="true">
									 <input type="submit" class="btn btn-warning btn-xs btn-mini" value="Desactivar Usuarios">
									 
									
									 </form>
			</div>
		</div>
	</div>
</div>
<script>
	<?php if(isset($_SESSION['importacion'])){ if($_SESSION['importacion']==true){ ?>
		alert("Los usuarios se han desactivado con Exito");
		<?php  }else {?>
			alert("Ocurrió algún error al subir el fichero. No pudo guardarse.")
		<?php } $_SESSION['importacion']=null;}?>
	function eliminarAction( ruta){
		//script para la eliminacion multiple
		var para_eliminar="";
		$(".ckeliminacion_multiple:checked").each(function(){
			if(para_eliminar ==""){
				para_eliminar+=""+$(this).val();
			}else{
				para_eliminar+="-"+$(this).val();
			}
			
		});
		if($(".ckeliminacion_multiple:checked").length==0){
			var accionar= confirm('Deseas eliminarlo? ');
		}else{
			var accionar= confirm('Deseas eliminar los '+ $(".ckeliminacion_multiple:checked").length +" registros seleccionados?");
		}
		if(accionar){
			$(location).attr('href',ruta+"/"+para_eliminar);
		}

	}
</script>
<?php /* include 'APPPATH."models\Crud_model.php")'; 
$crudxa =new Crud_model(); 
$crudxa->validar_suscripciones(); */ ?>	