<?php include 'header_browse.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
<style>
	.movie_thumb{}
	.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 10px;background-color: rgba(0, 0, 0, 0.74); color: #fff;}
	.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#fff;}
</style>
<!-- TOP FEATURED SECTION -->
<?php
	$featured_movie		=	$this->db->get_where('movie', array('featured'=>1))->row();
	
	?>
<div style="height:50%;width:100%;background-image: url(<?php echo $this->crud_model->get_poster_url('movie' , $featured_movie->movie_id);?>); background-size:cover;">
	<div style="font-size: 400%;font-weight: bold;clear: both;padding: 140px 0px 0px 30px;color: <?php echo $featured_movie->color;?>;">
		<?php echo $featured_movie->title;?>
		<br>
		<div>
		 <h5
		 style="font-size: 28px; weight: bold;clear: both;letter-spacing: .2px; color: <?php echo $featured_movie->colord;?>; font-weight: 400;">
		 <?php echo $featured_movie->description_short;?>
	     </h5>
		</div>
		
		<a href="<?php echo base_url();?>index.php?browse/playmovie/<?php echo $featured_movie->movie_id;?>" 
			class="btn btn-danger btn-lg" style="font-size: 20px;"> 
		<b><i class="fa fa-play"></i> PLAY</b>
		</a>
		<!-- ADD OR DELETE FROM PLAYLIST -->
		<span id="mylist_button_holder">
		</span>
		<span id="mylist_add_button" style="display:none;">
		<a href="#" class="btn  btn-lg btn_opaque"
			onclick="process_list('movie' , 'add', <?php echo $featured_movie->movie_id;?>)"> 
		<b><i class="fa fa-plus"></i> MI LISTA</b>
		</a>
		</span>
		<span id="mylist_delete_button" style="display:none;">
		<a href="#" class="btn  btn-lg btn_opaque"
			onclick="process_list('movie' , 'delete', <?php echo $featured_movie->movie_id;?>)"> 
		<b><i class="fa fa-check"></i>QUITAR </b>
		</a>
		</span>
	</div>
</div>
<script>
	// submit the add/delete request for mylist
	// type = movie/series, task = add/delete, id = movie_id/series_id
	function process_list(type, task, id)
	{
		$.ajax({
			url: "<?php echo base_url();?>index.php?browse/process_list/" + type + "/" + task + "/" + id, 
			success: function(result){
			//alert(result);
			if (task == 'add')
			{
				$("#mylist_button_holder").html( $("#mylist_delete_button").html() );
			}
			else if (task == 'delete')
			{
				$("#mylist_button_holder").html( $("#mylist_add_button").html() );
			}
		}});
	}
	
	// Show the add/delete wishlist button on page load
	$( document ).ready(function() {
	
		// Checking if this movie_id exist in the active user's wishlist
		mylist_exist_status = "<?php echo $this->crud_model->get_mylist_exist_status('movie' , $featured_movie->movie_id);?>";
	
		if (mylist_exist_status == 'true')
		{
			$("#mylist_button_holder").html( $("#mylist_delete_button").html() );
		}
		else if (mylist_exist_status == 'false')
		{
			$("#mylist_button_holder").html( $("#mylist_add_button").html() );
		}
	});
</script>
<!-- MY LIST, GENRE WISE LISTING & SLIDER                   lista para canales -->
<?php 
	$genres		=	$this->crud_model->get_genres();
		foreach ($genres as $row):
	?>
<div class="row" style="margin:80px 60px;">
	<h4><?php echo $row['name'];?></h4>
	<div class="content">
		<div class="grid">
			<?php 				
				$movies	= $this->crud_model->get_movies($row['genre_id'] , 100, 0);
				#print_r($movies);
				$movierand	=	shuffle($movies);
				#print_r($movierand);
				
				foreach ($movies as $row)
				{							
					$title	=	$row['title'];
					$link	=	base_url().'index.php?browse/playmovie/'.$row['movie_id'];
					$thumb	=	$this->crud_model->get_thumb_url('movie' , $row['movie_id']);
					include 'thumb.php';					
				}
				?>
		</div>
	</div>
</div>
<?php endforeach;?>
<div class="container" style="margin-top: 90px;">
	<hr style="border-top:1px solid #333;">
	<?php include 'footer.php';?>
</div>