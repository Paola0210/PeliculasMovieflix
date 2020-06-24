<?php include 'header_browse.php';?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Suscripcion Vencida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		Tu Suscripcion esta vencida <br>
		Te invitamos a suscribirte para seguir disfrutando de MOVIEFLIX ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>



<div class="container" style="margin-top: 90px;">
	<div class="row">
		<!-- NOTIFICATION MESSAGES HERE -->
		<?php
			if ($this->session->flashdata('payment_status') == 'cancelled'):
			?>
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Pago cancelado.
		</div>
		<?php endif;?>
		<?php
			if ($this->session->flashdata('payment_status') == 'success'):
			?>
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Pago completado exitosamente.
		</div>
		<?php endif;?>
		<?php
			if ($this->session->flashdata('status') == 'email_changed'):
			?>
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Correo electrónico cambiado con éxito.
		</div>
		<?php endif;?>
		<?php
			if ($this->session->flashdata('status') == 'password_changed'):
			?>
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Password cambiado con exito.
		</div>
		<?php endif;?>
		<?php
			if ($this->session->flashdata('status') == 'subscription_cancelled'):
			?>
		<!-- ERROR MESSAGE --> 
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Membresía cancelada con éxito. Puedes comprarla o renovarla en cualquier momento.
		</div>
		<?php endif;?>
		<!-- NOTIFICATION MESSAGES ENDS -->
		<div class="col-lg-12">
			<h3 class="black_text">Cuenta</h3>
			<hr>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-5">
					<span style="font-size: 20px;">MEMBRESÍA Y FACTURACIÓN</span>
					<br>
					<?php
						if ( $this->crud_model->validate_subscription() == false):
						?>
					<a href="<?php echo base_url();?>index.php?browse/purchaseplan" 
						class="btn btn-primary" style="margin:10px 0px;"> Compra de membresía </a>
					<?php endif;?>
					<?php
						if ( $this->crud_model->validate_subscription() != false):
						?>
					<a href="<?php echo base_url();?>index.php?browse/cancelplan" 
						class="btn btn-default" style="margin:10px 0px;"> Cancelar membresia </a>
					<?php endif;?>
				</div>
				<div class="col-lg-7">
					<div class="row" style="margin: 5px;">
						<div class="pull-left black_text">
							<b><?php echo $this->crud_model->get_current_user_detail()->email;?></b>
						</div>
						<div class="pull-right">
							<a href="<?php echo base_url();?>index.php?browse/emailchange" class="blue_text">Cambiar Email</a>
						</div>
					</div>
					<div class="row" style="margin: 5px;">
						<div class="pull-left">Contraseña : ******</div>
						<div class="pull-right">
							<a href="<?php echo base_url();?>index.php?browse/passwordchange" class="blue_text">Cambiar Contraseña</a>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-5">
					<span style="font-size: 20px;">DETALLES DEL PLAN</span>
					<br>
				</div>
				<div class="col-lg-7">
					<div class="row" style="margin: 5px;">
						<div class="pull-left">
							<!-- IF ANY ACTIVE SUBSCRIPTION IS FOUND -->
							<?php
								if ( $this->crud_model->validate_subscription() != false):
									$current_plan_id			=	$this->crud_model->get_current_plan_id();
									$current_plan_name			=	$this->db->get_where('plan', array('plan_id'=> $current_plan_id))->row()->name;
									$current_plan_screens		=	$this->db->get_where('plan', array('plan_id'=> $current_plan_id))->row()->screens;
									$current_subscription_upto_timestamp =	$this->db->get_where('subscription', array('user_id'=> $this->crud_model->get_current_user_detail()->user_id))->row()->timestamp_to;
									
								?>
								
							<b class="black_text" style="text-transform: capitalize;">
							<?php echo $current_plan_name . " (" . $current_plan_screens . " screens)"; ?>
							</b>
							<br>
							Efectivo hasta : <b><?php echo date('d M, Y', $current_subscription_upto_timestamp);?></b>
							<br>
							<i style="font-size: 12px;">para cambiar de plan, cancele primero el plan actualmente en ejecución</i>
							<?php endif;?>
							<!-- IF ANY ACTIVE SUBSCRIPTION IS NOT FOUND -->
							<?php
								if ( $this->crud_model->validate_subscription() == false):
								?>
								<!-- aqui muesto el modal para cuando esta inactivo -->
								<script> $('#exampleModal').modal('toggle') </script>
							<i style="font-size: 12px;">Membresia Inactiva</i>
							<?php endif;?>
						</div>
						<div class="pull-right" style="text-align: right;">
							<?php
								if ( $this->crud_model->validate_subscription() == false):
								?>
							<a href="<?php echo base_url();?>index.php?browse/purchaseplan" class="blue_text">Comprar</a>
							<?php endif;?>
							<?php
								if ( $this->crud_model->validate_subscription() != false):
								?>
							<a href="<?php echo base_url();?>index.php?browse/cancelplan" class="blue_text">Cancelar</a>
							<?php endif;?>
							<br>
							<a href="<?php echo base_url();?>index.php?browse/billinghistory" class="blue_text">Historial de facturación</a>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-5">
					<span style="font-size: 20px;">MI PERFIL</span>
					<br>
				</div>
				<div class="col-lg-7">
					<div class="row" style="margin: 5px;">
						<div class="pull-left black_text">
							<img src="<?php echo base_url();?>assets/global/thumb1.png" style="margin:10px 10px 10px 0px; height: 30px;" />
							usuario
							<br>
							<!--<a href="" class="blue_text">Language</a>-->
						</div>
						<div class="pull-right">
							<a href="<?php echo base_url();?>index.php?browse/manageprofile" class="blue_text">Administrar perfiles</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

