<?php //vista que lista los canales del usuario consultado y muestra activar si el usuario no tiene registros en canales_asignados_usuario
	//o si tiene pero no esta activo
	//o desactivar si el usuario tiene registros en canales_asignados_usuario y esta activo o si el plan que tiene corresponde con este canal ?>
<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title">
				<h4>Lista de Canales</h4>
			</div>
			<div class="grid-body ">
				<table class="table table-hover table-condensed" id="example">
					<thead>
						<tr>
							<th>
								#
							</th>
							<th></th>
							<th>Título de Canales</th>
							<th>Género</th>
							<th>Operación</th>
						</tr>
					</thead>
					<tbody>
					
									
						<?php
							$movies = $this->db->get('movie')->result_array();
							$counter = 1;
							
							foreach ($movies as $row):
								$esta_activo_el_canal=$this->crud_model->validar_canal_usuario($row['movie_id'],$user_id2);
							  ?>
						<tr>
							<td  style="vertical-align: middle;background-color:<?= ($esta_activo_el_canal)? '#64FE2E;' :'#FA5858;'?>"><?php echo $counter++;?></td>
							<td><img src="<?php echo $this->crud_model->get_thumb_url('movie' , $row['movie_id']);?>" style="height: 60px;" /></td>
							<td style="vertical-align: middle;"><?php echo $row['title'];?></td>
							<td style="vertical-align: middle;">
								<?php echo $this->db->get_where('genre',array('genre_id'=>$row['genre_id']))->row()->name;?>
							</td>
							<td style="vertical-align: middle;">
								<?php 
								
								if($esta_activo_el_canal==false){
								?>
								<a href="<?php echo base_url();?>index.php?admin/activar_desactivar_canales_al_usuario/<?php echo $row['movie_id'].'/'.$user_id2;?>" class="btn btn-default btn-xs btn-mini">
								<i class="fa fa-external-link"></i>Activar </a>
								<?php }else{?>
									<a href="<?php echo base_url();?>index.php?admin/activar_desactivar_canales_al_usuario/<?php echo $row['movie_id'].'/'.$user_id2;?>" class="btn btn-danger btn-xs btn-mini">Desactivar</a>
								<?php }?>
								
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				<a class="btn btn-info" href="<?= base_url()?>index.php?admin/user_list">Regresar</a>
			</div>

		</div>
	</div>
</div>