<div class="page-sidebar " id="main-menu">
<!-- BEGIN MINI-PROFILE -->
<div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
  <div class="user-info-wrapper sm">
	<div class="profile-wrapper sm">
	  <i class="material-icons" style="font-size: 50px;">account_circle</i>
	  
	</div>
	<div class="user-info sm">
	  <div class="username">
	  	<?php 
		  $user_id	=	$this->session->userdata('user_id');
		  $name		=	$this->db->get_where('user', array('user_id'=>$user_id))->row()->name;
		  echo $name;
		?>
	  </div>
	  <div class="status">Administrador</div>
	</div>
  </div>
  <hr style="border-top: 1px solid  rgba(229, 233, 236, 0.14); border-bottom: 0px;" />
  <!-- END MINI-PROFILE -->
  <!-- BEGIN SIDEBAR MENU -->
  <ul>
	<!-- DASHBOARD -->
	<li class="<?php if ($page_name == 'dashboard')echo 'active';?>"> 
		<a href="<?php echo base_url();?>index.php?admin/dashboard">
		<i class="material-icons">home</i> 
		<span class="title">Inicio</span> <span class=""></span> </a>
	</li>
	
	<!-- MOVIES -->
	<li class="<?php if ($page_name == 'movie_list' || $page_name == 'movie_edit' || $page_name == 'movie_create')echo 'active';?>"> 
		<a href="<?php echo base_url();?>index.php?admin/movie_list">
		<i class="material-icons">video_library</i> 
		<span class="title">Canales</span> <span class=""></span> </a>
	</li>
	
	
	
	<!--genero  -->
	<li class="<?php if ($page_name == 'genre_list' || $page_name == 'genre_edit' || $page_name == 'genre_create')echo 'active';?>"> 
		<a href="<?php echo base_url();?>index.php?admin/genre_list">
		<i class="material-icons">filter_list</i> 
		<span class="title">Genero</span> <span class=""></span> </a>
	</li>
	

	
	<!--  -->
	<li class="<?php if ($page_name == 'user_list')echo 'active';?>"> 
		<a href="<?php echo base_url();?>index.php?admin/user_list"><i class="material-icons">people</i> 
		<span class="title">usuarios</span> <span class=""></span> </a>
	</li>
	
	<!--  membresia-->
	<li class="<?php if ($page_name == 'plan_list' || $page_name == 'plan_edit')echo 'active';?>"> 
		<a href="<?php echo base_url();?>index.php?admin/plan_list"><i class="material-icons">view_carousel</i> 
		<span class="title">Paquetes de membresía</span> <span class=""></span> </a>
	</li>
	
	<!-- reporte -->
	<li class="<?php if ($page_name == 'report')echo 'active';?>"> 
		<a href="<?php echo base_url();?>index.php?admin/report"><i class="material-icons">timeline</i> 
		<span class="title">Reporte</span> <span class=""></span> </a>
	</li>
	
	<!-- configuraciones -->
	<?php 
	  $open_settings = false;
	  if ($page_name == 'faq_list' 		|| 
		$page_name == 'faq_edit' 		|| 
		$page_name == 'faq_create' 		||
		$page_name == 'settings' )$open_settings = true;
	  ?>
						 	
	<li class="<?php if($open_settings == true)echo 'active';?>"> <a href="#"><i class="material-icons">build</i> 
		<span class="title">Configurationes</span> <span class="<?php if($open_settings == true)echo 'open';?> arrow"></span> </a>
		<ul class="sub-menu">
			
			<li class=""><a href="<?php echo base_url();?>index.php?admin/settings">
                 Configuraciones del sitio web</a></li>
			<li class=""><a href="<?php echo base_url();?>index.php?admin/faq_list">Preguntas frecuentes</a></li>
		</ul>
	</li>
	
	<!--  -->
	<li class="<?php if($page_name == 'account')echo 'active';?>"> 
		<a href="<?php echo base_url();?>index.php?admin/account"><i class="material-icons">account_circle</i> 
		<span class="title">Cuenta</span> <span class=""></span> </a>
	</li>
	
	
	
	<!-- ACCOUNT SETTINGS 
	<li class="">
	  <a href="#"> <i class="material-icons">account_circle</i> 
	  	<span class="title">Main</span> <span class=" arrow"></span> 
	  		</a>
	  <ul class="sub-menu">
		<li> <a href=""> sub 1 </a> </li>
		<li> <a href=""> sib 2 </a> </li>
	  </ul>
	</li>-->
	
	
  </ul>
  
  
  <div class="clearfix"></div>
  <!-- END SIDEBAR MENU -->
</div>
</div>
<a href="#" class="scrollup">Scroll</a>
