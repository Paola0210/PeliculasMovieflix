<div class="row">
	<!-- TOTAL VIDEO NUMBER -->
	<div class="col-md-4 col-sm-12 ">
		<div class="tiles blue weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Total Canales </div>
					<div class="pull-right">
						<?php echo $this->db->from('movie')->count_all_results();?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">video_library</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
	
	
</div>
<div style="margin: 20px;"></div>
<div class="row">
	<!-- TOTAL DE USUARIOS -->
	<div class="col-md-4 col-sm-12 ">
		<div class="tiles black  weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Total de usuarios registrados </div>
					<div class="pull-right">
						<?php echo $this->db->from('user')->count_all_results();?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">people</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
	<!-- Suscripción activa total -->
	<div class="col-md-4 col-sm-12 ">
		<div class="tiles dark-blue weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Suscripción activa total </div>
					<div class="pull-right">
						<?php
							$total_active_subscription	=	0;
							$users	=	$this->db->get('user')->result_array();
							foreach ($users as $row)
							{
								$plan_id	=	$this->crud_model->get_active_plan_of_user($row['user_id']);
								if ($plan_id != false)
									$total_active_subscription++;
							}
							echo $total_active_subscription;
							?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">loyalty</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
	<!-- Ventas de este mes -->
	<div class="col-md-4 col-sm-12 ">
		<div class="tiles red weather-widget ">
			<div class="tiles-body">
				<div class="heading">
					<div class="pull-left"> Ventas de este mes </div>
					<div class="pull-right">
						<?php
							$total_sale	=	0;
							$month			=	date("F");
							$year 			=	date("Y");
							$subscriptions	=	$this->crud_model->get_subscription_report($month, $year);
							foreach ($subscriptions as $row)
								$total_sale	+=	$row['paid_amount'];
							echo '$'.$total_sale;
							?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="big-icon">
					<i class="material-icons" style="font-size: 90px;">payment</i>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tile-footer">
			</div>
		</div>
	</div>
</div>