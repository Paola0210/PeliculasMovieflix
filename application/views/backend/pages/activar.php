<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title no-border">
			</div>
			<div class="grid-body no-border">
				<?php
					$activar_detail = $this->db->get_where('user',array('user_id'=>$user_id1 ))->row();
					?>
				<form method="post" action="<?php echo base_url();?>index.php?admin/activar/<?php echo $user_id;?>">
					
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-8">
							<div class="form-group">
							
					   <span style="font-size: 16px" name="email" value=><?php echo $activar_detail->email;?></span>
								
						       <div class="controls">
						<input type="text" style="font-size: 16px" name="email" value="<?php echo $activar_detail->email;?>">
						<input type="text" style="font-size: 16px;visibility:hidden" name="id_usuario_suscrib"  value="<?php echo $activar_detail->user_id;?>">
								</div>
							
								
							</div>
							
							
							<div class="form-group">
								<label class="form-label">Pantalla</label>
								<span class="help">-</span>
								<div class="controls">
									<select class="select2" name="plan_id" style="width:150px;">
										<option value="1">1 Pantalla</option>
										<option value="2">2 Pantallas</option>
										<option value="3">4 Pantallas</option>
									</select> 
								
							</div>
							<div class="form-group">
								<label class="form-label">Tiempo</label>
								<span class="help">-</span>
								<div class="controls">
									<select class="select2" name="featured" style="width:150px;">
										<option value="1">1  Meses</option>
										<option value="3">3  Meses</option>
										<option value="6">6  Meses</option>
										<option value="12">12 Meses</option>
									</select> 
								
							</div>
							
							<div class="form-group">
								<input type="submit" class="btn btn-success" value="Create">
								
								<a href="<?php echo base_url();?>index.php?admin/user_list" class="btn btn-default">volver</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>