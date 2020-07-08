<a href="<?php echo base_url();?>index.php?admin/movie_create/" class="btn btn-primary" style="margin-bottom: 20px;">

<i class="fa fa-plus"></i>
Crear Canales
</a>
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
							  ?>
							  <?php 
							  $var_is_valid=false;
							  if(isset($filtrox)){
							  		if($filtrox==="1" && $row['planBasic']==="on"){
							  			$var_is_valid=true;
							  		}else if($filtrox ==="2" && $row['planStandard']==="on"){
							  			$var_is_valid=true;
							  		}else if($filtrox ==="3" && $row['planPremium']==="on"){
							  			$var_is_valid=true;
							  		}else if($filtrox===""){
							  			$var_is_valid=true;
							  		}

							  }else{
							  	$var_is_valid=true;
							  } 
							  if($var_is_valid){
							  ?>
						<tr>
							<td style="vertical-align: middle;"><?php echo $counter++;?></td>
							<td><img src="<?php echo $this->crud_model->get_thumb_url('movie' , $row['movie_id']);?>" style="height: 60px;" /></td>
							<td style="vertical-align: middle;"><?php echo $row['title'];?></td>
							<td style="vertical-align: middle;">
								<?php echo $this->db->get_where('genre',array('genre_id'=>$row['genre_id']))->row()->name;?>
							</td>
							<td style="vertical-align: middle;">
								<a href="<?php echo base_url();?>index.php?browse/playmovie/<?php echo $row['movie_id'];?>" 
									target="_blank" class="btn btn-default btn-xs btn-mini">
								<i class="fa fa-external-link"></i>Visitar</a>
								
								<a href="<?php echo base_url();?>index.php?admin/movie_edit/<?php echo $row['movie_id'];?>" class="btn btn-info btn-xs btn-mini">
								Editar</a>
								
								<a href="<?php echo base_url();?>index.php?admin/movie_delete/<?php echo $row['movie_id'];?>" class="btn btn-danger btn-xs btn-mini" onclick="return confirm('Want to delete?')">
								Borrar</a>
							</td>
						</tr>
						<?php }?>
						<?php endforeach;?>
					</tbody>
				</table>
				<div class="form-group">
   				 <label for="slc_filtro">Filtro de Planes</label>
				    <select class="form-control"  id="slc_filtro" onchange="filtrarPlanes();">

				      <option value="" <?= (isset($_SESSION['var_planes']) && $_SESSION['var_planes'] ==="" )? 'selected' :''?> >Todo</option>
				      <option value="1" <?= (isset($_SESSION['var_planes']) && $_SESSION['var_planes'] ==="1" )? 'selected' :''?> >Plan Basic</option>
				      <option value="2" <?= (isset($_SESSION['var_planes']) && $_SESSION['var_planes'] ==="2" )? 'selected' :''?> >Plan Stardard</option>
				      <option value="3" <?= (isset($_SESSION['var_planes']) && $_SESSION['var_planes'] ==="3" )? 'selected' :''?> >Plan Premium</option>	
				    </select>
				</div>
				<?=$_SESSION['var_planes']?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function filtrarPlanes(){
		console.log($("#slc_filtro option:selected").val());
		window.location.replace("<?php echo base_url().'index.php?admin/movie_list2/';?>"+($("#slc_filtro option:selected").val()));
	}
</script>