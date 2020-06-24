<?php include 'header_browse.php';?>
<style>
	table{
	background-color: rgb(243, 243, 243);
	}
</style>
<div class="container" style="margin-top: 90px;">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="black_text">Compra de membresía</h3>
			<hr>
		</div>
		<div class="col-lg-8">
			<h4 class="black_text">Compre cualquiera de los paquetes de membresía de abajo.</h4>
			<ul class="black_text">
				<li>
					Seleccione cualquiera de su paquete de membresía preferido y haga el pago.
				</li>
				<li>
					
Puedes cancelar tu suscripción en cualquier momento más tarde.
				</li>
			</ul>
			<form method="post" action="<?php echo base_url();?>index.php?payment/paypal_payment/paypal_post">
				<table class="table table-striped table-hover" style="color: #000;">
					<tbody>
						<tr>
							<td>
								<h6>Planes</h6>
							</td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center">
								<h5 style="text-transform: uppercase;"><?php echo $row['name'];?></h5>
							</td>
							<?php endforeach;?>
						</tr>
						<tr>
							<td>Costo mensual</td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center">$ <?php echo $row['price'];?></td>
							<?php endforeach;?>
						</tr>
						<tr style="background-color: #fff;">
							<td>Pantallas simultaneas</td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center"><?php echo $row['screens'];?></td>
							<?php endforeach;?>
						</tr>
						<tr>
							<td>Ver en tu laptop, TV, Telefono y tableta</td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center"><i class="fa fa-check" aria-hidden="true"></i></td>
							<?php endforeach;?>
						</tr>
						<tr style="background-color: #fff;">
							<td>HD Disponible</td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center"><i class="fa fa-check" aria-hidden="true"></i></td>
							<?php endforeach;?>
						</tr>
						<tr>
							<td>Videos Ilimitados</td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center"><i class="fa fa-check" aria-hidden="true"></i></td>
							<?php endforeach;?>
						</tr>
						<tr style="background-color: #fff;">
							<td>Cancele en cualquier momento</td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center"><i class="fa fa-check" aria-hidden="true"></i></td>
							<?php endforeach;?>
						</tr>
						<tr>
							<td></td>
							<?php
								$plans = $this->crud_model->get_active_plans();
								foreach ($plans as $row):
								?>
							<td align="center">
								<input type="radio" name="plan_id" value="<?php echo $row['plan_id'];?>" onChange="enable_payment()" />
							</td>
							<?php endforeach;?>
						</tr>
					</tbody>
				</table>
				<div class="pull-right">
					<a href="<?php echo base_url();?>index.php?browse/youraccount" class="btn btn-default">Regresar</a>
					<button id="payment" class="btn btn-primary" type="submit" disabled> Continue con paypal </button>
				</div>
			</form>
		</div>
		<script>
			function enable_payment()
			{
				$('#payment').removeAttr('disabled');
			}
		</script>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>