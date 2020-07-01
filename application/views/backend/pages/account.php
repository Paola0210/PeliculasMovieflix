<div class="row">
	<!-- ADMIN PROFILE INFORMATION UPDATE -->
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="grid simple ">
			<div class="grid-title ">
				<h4>Actualización del perfil</h4>
			</div>
			<div class="grid-body ">
				<?php
					$user_id	=	$this->session->userdata('user_id');
					$user_detail = $this->db->get_where('user',array('user_id'=>$user_id))->row();
					?>
				<form method="post" action="<?php echo base_url();?>index.php?admin/account" enctype="multipart/form-data">
					<input type="hidden" name="task" value="update_profile" />
					<div class="form-group">
						<label class="form-label">Tu nombre</label>
						<span class="help"></span>
						<div class="controls">
							<input type="text" class="form-control" name="name" value="<?php echo $user_detail->name;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="form-label">Tu correo electrónico</label>
						<span class="help"></span>
						<div class="controls">
							<input type="text" class="form-control" name="email" value="<?php echo $user_detail->email;?>">
						</div>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Actualizar perfil">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- ADMIN PASSWORD UPDATE -->
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="grid simple ">
			<div class="grid-title ">
				<h4>Cambia la contraseña</h4>
			</div>
			<div class="grid-body ">
				<?php
					$user_id	=	$this->session->userdata('user_id');
					$user_detail = $this->db->get_where('user',array('user_id'=>$user_id))->row();
					?>
				<form method="post" action="<?php echo base_url();?>index.php?admin/account" enctype="multipart/form-data">
					<input type="hidden" name="task" value="update_password" />
					<div class="form-group">
						<label class="form-label">Nueva contraseña</label>
						<span class="help"></span>
						<div class="controls">
							<input type="password" class="form-control" name="new_password" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="form-label">Contraseña actual</label>
						<span class="help"></span>
						<div class="controls">
							<input type="password" class="form-control" name="old_password" value="">
						</div>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Actualizar Contraseña">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>