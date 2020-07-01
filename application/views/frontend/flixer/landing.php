<!-- TOP LANDING SECTION -->
<div style="height:50%;width:100%;background-image: url(<?php echo base_url().'assets/frontend/flixer/images/home_top_banner.jpg';?>)">
	<!-- logo -->
	<div style="float: none;">
		<a href="<?php echo base_url();?>index.php?home">
		<img src="<?php echo base_url();?>/assets/global/logo.png" style="margin: 18px 40px; height: 50px;" />
		</a>
		<a href="<?php echo base_url();?>index.php?home/signin" class="btn btn-danger" style="margin-left: 0;padding-top: 07px;margin-top: -20px;" >INICIAR</a>
		<a target="_blank" href="<?php echo base_url();?>assets/global/_Bienvenido_MOVIEFLIX_11163072.apk" class="btn2 btn-danger2 btn-sm2" style="color: fff; "> <img style="height:25px; margin-right:10px; padding-left:4px; padding-bottom:3px;" src="<?php echo base_url();?>/assets/global/icono1.png"><strong>Descarga App</strong></a>
		
	<!-- nombre de la app -->		
	<div style="border-color: #4000FF;">	</div>
	</div>

	<div style="font-size: 75px;font-weight: bold;clear: both;padding: 100px 0px 0px 20px;color: #fff;">
		Quieres ver mas?
		<div style="font-size: 25px; letter-spacing: .2px; color: #fff; font-weight: 100;">
			Compatible con todos los dispositivos Smart.
		</div>
		<a href="<?php echo base_url();?>index.php?home/signup" class="btn btn-danger btn-lg" >UNIRME AHORA</a>
	</div>
	
</div><br><br>
<!-- MIDDLE TAB SECTION -->
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="bs-component">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#cancel" data-toggle="tab">
						<i class="fa fa-sign-out" style="font-size: 64px; font-weight: lighter; padding: 20px 0px 5px;"></i>
						<br>
						Cancelar Suscripción
						</a>
					</li>
					<li>
						<a href="#anywhere" data-toggle="tab">
						<i class="fa fa-laptop" style="font-size: 64px; font-weight: lighter; padding: 20px 0px 5px;"></i>
						<br>
						
						Pantallas 
						
						</a>
					</li>
					<li>
						<a href="#price" data-toggle="tab">
						<i class="fa fa-tags fa-flip-horizontal" style="font-size: 64px; font-weight: lighter; padding: 20px 0px 5px;"></i>
						<br>
						Precio del Plan
						</a>
					</li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane active in" id="cancel">
						<p>
						<div class="row">
							<div class="col-md-7" style="padding-top: 50px;">
								<h4>
									
Si decides que TvDIGITAL no es para ti, no hay problema. <br>
								</h4>
								
							</div>
							<div class="col-md-5">
								<img src="<?php echo base_url();?>assets/frontend/flixer/images/asset_cancelanytime_withdevice.png" style="width: 100%;" />
							</div>
						</div>
						</p>
					</div>
					<div class="tab-pane" id="anywhere">
						<p>
						<div class="row">
							<div class="col-md-9">
								<h4>
									Mira tus canales en cualquier momento y en cualquier lugar. Desde cualquier dispositivo.
								</h4>
							</div>
							<div class="col-md-3">
								<a href="<?php echo base_url();?>index.php?home/signup" class="btn btn-danger btn-lg" >UNIRME AHORA</a>
							</div>
						</div>
						<div class="row" style="margin-top:50px;text-align: center;">
							<div class="col-md-4">
								<img src="<?php echo base_url();?>assets/frontend/flixer/images/asset_TV_UI.png" style="width: 100%;" />
								<h5>Ver en tu tv</h5>
							</div>
							<div class="col-md-4">
								<img src="<?php echo base_url();?>assets/frontend/flixer/images/asset_mobile_tablet_UI_2.png" style="width: 100%;" />
								<h5>Ver en tu telefono, tableta</h5>
							</div>
							<div class="col-md-4">
								<img src="<?php echo base_url();?>assets/frontend/flixer/images/asset_website_UI.png" style="width: 100%;" />
								<h5>Ver en tu pc</h5>
							</div>
						</div>
						</p>
					</div>
					<div class="tab-pane" id="price">
						<p>
						<div class="row" style="margin: 35px;">
							<div class="col-md-8" style="text-align: right;">
								<h4>
									Elige un plan.
								</h4>
							</div>
							<div class="col-md-4" style="text-align: left;">
								<a href="<?php echo base_url();?>index.php?home/signup" class="btn btn-danger btn-lg" >UNIRME AHORA</a>
							</div>
						</div>
						<!-- price table -->
						<table class="table table-striped table-hover" style="color: #999;">
							<tbody>
								<tr>
									<td></td>
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
									<td>Costo Mensual</td>
									<?php
										$plans = $this->crud_model->get_active_plans();
										foreach ($plans as $row):
										?>
									<td align="center">$ <?php echo $row['price'];?></td>
									<?php endforeach;?>
								</tr>
								<tr>
									<td>Pantallas que puedes ver al mismo tiempo</td>
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
								<tr>
									<td>HD Disponible</td>
									<?php
										$plans = $this->crud_model->get_active_plans();
										foreach ($plans as $row):
										?>
									<td align="center"><i class="fa fa-check" aria-hidden="true"></i></td>
									<?php endforeach;?>
								</tr>
								<tr>
									<td>Videos Ilimitados...</td>
									<?php
										$plans = $this->crud_model->get_active_plans();
										foreach ($plans as $row):
										?>
									<td align="center"><i class="fa fa-check" aria-hidden="true"></i></td>
									<?php endforeach;?>
								</tr>
								<tr>
									<td>Cancelar en cualquier momento</td>
									<?php
										$plans = $this->crud_model->get_active_plans();
										foreach ($plans as $row):
										?>
									<td align="center"><i class="fa fa-check" aria-hidden="true"></i></td>
									<?php endforeach;?>
								</tr>
							</tbody>
						</table>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php';?>
</div>