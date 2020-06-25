<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Te Queda Poco Tiempo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	
		Tu Suscripcion esta proxima a ser vencida <br>
		Te invitamos a suscribirte para seguir disfrutando de MOVIEFLIX ...<br>
		<a id="dias_restantes" style="color:red">3 Dias de suscripcion</a><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<!-- TOP HEADING SECTION -->
<style>
	.nav_transparent {
	padding: 10px 0px 10px; border: 1px;
	background: rgba(0,0,0,0.8); 
	}
	.nav_dark {
	background-color: #000;
	padding: 10px;
	}
</style>
<?php 
	if ($page_name == 'home' || $page_name == 'playmovie') 
		$nav_type = 'nav_transparent';
	else 
		$nav_type = 'nav_dark';
	?>
<div class="navbar navbar-default navbar-fixed-top <?php echo $nav_type;?>" >
	<div class="container" style=" width: 100%;">
		<div class="navbar-header">
			<a href="<?php echo base_url();?>index.php?browse/home" class="navbar-brand">
				<img src="<?php echo base_url();?>/assets/global/logo.png" style=" height: 32px;margin-right: 50px;" />
			</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<!-- MOVIES GENRE WISE-->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="" style="color: #e50914; font-weight: bold;">
						Peliculas <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<?php
							$genres		=	$this->crud_model->get_genres();
							foreach ($genres as $row):
							?>
						<li><a href="<?php echo base_url();?>index.php?browse/movie/<?php echo $row['genre_id'];?>">
							<?php echo $row['name'];?>
							</a>
						</li>
						<?php endforeach;?>
					</ul>
				</li>
				
			</ul>
			<!-- PROFILE, ACCOUNT SECTION -->
			<?php
				// by deault, email & general thumb shown at top
				$bar_text	=	$this->db->get_where('user', array('user_id'=>$this->session->userdata('user_id')))->row()->email;
				$bar_thumb	=	'thumb1.png';
				
				// check if there is active subscription
				$subscription_validation	=	$this->crud_model->validate_subscription();
				if ($subscription_validation != false)
				{
					// if there is active subscription, check the selected/active user of current user account
				
					$active_user	=	$this->session->userdata('active_user');
					if ($active_user == 'user1')
					{
						$bar_text 	=	$this->crud_model->get_username_of_user('user1');
						$bar_thumb	=	'thumb1.png';
					}
					else if ($active_user == 'user2')
					{
						$bar_text 	=	$this->crud_model->get_username_of_user('user2');
						$bar_thumb	=	'thumb2.png';
					}
					else if ($active_user == 'user3')
					{
						$bar_text 	=	$this->crud_model->get_username_of_user('user3');
						$bar_thumb	=	'thumb3.png';
					}
					else if ($active_user == 'user4')
					{
						$bar_text 	=	$this->crud_model->get_username_of_user('user4');
						$bar_thumb	=	'thumb4.png';
					}
				}
				?>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding:10px;">
					<img src="<?php echo base_url();?>assets/global/<?php echo $bar_thumb;?>" style="height:30px;" />
					<?php echo $bar_text;?>
					<span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<?php 
							// user list shown only if there is active subscription 
							if ($subscription_validation != false):
							  $current_plan_id	=	$this->crud_model->get_current_plan_id();
							  ?>
						<li>
							<a href="<?php echo base_url();?>index.php?browse/doswitch/user1">
							<img src="<?php echo base_url();?>assets/global/thumb1.png" 
								style="height:30px; margin: 5px;" /><?php echo $this->crud_model->get_username_of_user('user1');?>
							</a>
						</li>
						<?php
							if ($current_plan_id == 2 || $current_plan_id == 3):
							?>
						<li>
							<a href="<?php echo base_url();?>index.php?browse/doswitch/user2">
							<img src="<?php echo base_url();?>assets/global/thumb2.png" 
								style="height:30px; margin: 5px;" /><?php echo $this->crud_model->get_username_of_user('user2');?>
							</a>
						</li>
						<?php endif;?>
						<?php
							if ($current_plan_id == 3):
							?>
						<li>
							<a href="<?php echo base_url();?>index.php?browse/doswitch/user3">
							<img src="<?php echo base_url();?>assets/global/thumb3.png" 
								style="height:30px; margin: 5px;" /><?php echo $this->crud_model->get_username_of_user('user3');?>
							</a>
						</li>
						<?php endif;?>
						<?php
							if ($current_plan_id == 3):
							?>
						<li>
							<a href="<?php echo base_url();?>index.php?browse/doswitch/user4">
							<img src="<?php echo base_url();?>assets/global/thumb4.png" 
								style="height:30px; margin: 5px;" /><?php echo $this->crud_model->get_username_of_user('user4');?>
							</a>
						</li>
						<?php endif;?>
						<?php endif;?>
						<li class="divider"></li>
						<li><a href="<?php echo base_url();?>index.php?browse/manageprofile">Perfiles</a></li>
						<li class="divider"></li>
						<!-- SHOW ADMIN LINK IF ADMIN LOGGED IN -->
						<?php 
							if($this->session->userdata('login_type') == 1):
								?>
						<li><a href="<?php echo base_url();?>index.php?admin/dashboard">Admin</a></li>
						<?php endif;?>
						<li><a href="<?php echo base_url();?>index.php?browse/youraccount">Cuenta</a></li>
						<li><a href="<?php echo base_url();?>index.php?home/signout">Salir</a></li>
					</ul>
				</li>
			</ul>
			<!-- SEARCH FORM -->
			<form class="navbar-form navbar-right" method="post" action="<?php echo base_url();?>index.php?browse/search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Titulo, actores, Genero" 
						style="background-color: #000; border: 1px solid #808080;" name="search_key">
				</div>
				<button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
		</div>
	</div>
</div>
<?php 
	if ($page_name == 'home' || $page_name == 'playmovie' || $page_name == 'playseries')
		$padding_amount = '0px';
	else
		$padding_amount = '50px';
	?>
<div style="padding: <?php echo $padding_amount;?>;"></div>
<?php
//declaro una variable de session en 0
if(empty($_SESSION['var1x'])){
	$_SESSION['var1x']=0;
}

//obtengo los dias restantes
$dias_restantesx=$this->crud_model->validate_subs_3_dias_antes(); 
if($dias_restantesx!=0 && intval($_SESSION['var1x'])<3){
	//aumento la variable en 1 para saber cuando ya lleva 3 intentos
	$_SESSION['var1x']=intval($_SESSION['var1x'])+1;
	//muestro el modal si es !=0 y cambio el texto de los dias
	echo"<script> $('#dias_restantes').text('".$dias_restantesx." Dias de suscripcion') </script>";	
	echo "<script> $('#exampleModal2').modal('toggle') </script>";
}

?>