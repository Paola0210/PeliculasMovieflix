<?php include 'header_browse.php';?>
<?php
	$movie_details	=	$this->db->get_where('movie' , array('movie_id' => $movie_id))->result_array();
$movie_details2	=	$this->db->get_where('movie' , array('movie_id' => $movie_id))->row();
	foreach ($movie_details as $row):
	?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
<style>
	.movie_thumb{}
	.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 10px;background-color: rgba(0, 0, 0, 0.74); color: #fff;}
	.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#fff;}
	.video_cover {
	position: relative;padding-bottom: 30px;
	}
	.video_cover:after {
	content : "";
	display: block;
	position: absolute;
	top: 0;
	left: 0;
	background-image: url(<?php echo $this->crud_model->get_poster_url('movie' , $row['movie_id']);?>); 
	width: 100%;
	height: 100%;
	opacity : 0.2;
	z-index: -1;
	background-size:cover;
	}
	.select_black{background-color: #000;height: 45px;padding: 12px;font-weight: bold;color: #fff;}
	.profile_manage{font-size: 25px;border: 1px solid #ccc;padding: 5px 30px;text-decoration: none;}
	.profile_manage:hover{font-size: 25px;border: 1px solid #fff;padding: 5px 30px;text-decoration: none;color:#fff;}
.main-preview-player {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}	
.player-container {
  background: #1a1a1a;
  overflow: auto;
  width: 100%;
  margin: 0 0 20px;
}

.video-js,
.playlist-container {
  position: relative;
  min-width: 300px;
  min-height: 150px;
  height: 0; 
}

.video-js {
  width: 70%;
  float: left;
}
.vjs-playlist {
  width: 30%;
  float: right;
}

.vjs-playlist {
  margin: 0;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}
</style>
<!-- VIDEO PLAYER -->
<div class="video_cover">
	<div class="container" style="padding-top:100px; text-align: center;">
		<div class="row">
			<div class="col-lg-12">
<?php /*?>				<script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>
				<div id="video_player_div"><?php echo $row['title'];?></div>
				<script> 
				jwplayer("video_player_div").setup({
						"file": "<?php echo $row['url'];?>",
						"image": "<?php echo $this->crud_model->get_poster_url('movie' , $row['movie_id']);?>",
						"width": "100%",
						aspectratio: "16:9",
						DefaultFullscreenHandler: true,
						
						autostart: true,
						listbar: {
						  position: 'right', 
						  size: 260
						},
					  });
					  jwplayer().on('fullscreen')
					  jwplayer().onDisplayClick(function() { jwplayer().setFullscreen(true); });
					  jwplayer().setVolume(100);
					
					
					
				</script><?php */?>
            	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/video.js/dist/video-js.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/videojs-playlist-ui/examples.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/videojs-resolution-switcher/lib/videojs-resolution-switcher.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/videojs-font/css/videojs-icons.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.vertical.css" />
                <section class="main-preview-player">
                  <video id="preview-player" class="video-js vjs-fluid vjs-big-play-centered " preload="auto" crossorigin="anonymous" data-setup='{}'>
                    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 hola</a></p>
                  </video>             
                
                  <div class="playlist-container  preview-player-dimensions vjs-fluid" data-for="preview-player">
                    <ol class="vjs-playlist"></ol>
                  </div>
                </section>
                <button class="previous vjs-icon-previous-item"></button>
  				<button class="next vjs-icon-next-item"></button>
			</div>
            
            <script type="text/javascript" src="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/video.js/dist/video.js"></script>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/videojs-playlist/dist/videojs-playlist.js"></script>
            <script type="text/javascript" src="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.js"></script>
            <script type="text/javascript" src="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/videojs-resolution-switcher/lib/videojs-resolution-switcher.js"></script>
            <script type="text/javascript" src="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/node_modules/videojs-chapter-nav/dist/videojs.chapter-nav.js"></script>
                       
           <script>
			  
		   </script>           
            <script>
			 // botonnes de control reproductor
			   var myCustomSrcPicker = function(player,src,label){
						  // select any source you want
						  return _p.src(selectedSource);
						}
		   		var player = videojs('preview-player',{
					controls: true,
					nextButton: true,
					autoplay: true,					
					playbackRates: [0.5, 1, 1.5],
					 plugins: {	
						 videoJsResolutionSwitcher: {
							  default: 'low',
							  customSourcePicker: myCustomSrcPicker
							}
				  }
					});
				// lista de reproduccion se creo variable idpelicula 
            var player = videojs('preview-player');	
			var videoList = [<?php
						$counter	=	0;
						$movie_details	=	$this->crud_model->get_movies($row['genre_id'] , 20, 0);
						foreach ($movie_details as $row):
						?>{
					idPelicula: <?php echo $row['movie_id']?>,
				  name: '<?php echo $row['title'];?>',
				
				  sources: [
					{ 	src: '<?php echo $row['url'];?>', 
						type: 'video/mp4',
						label: '720' },							
				  ],
				

				  // you can use <picture> syntax to display responsive images
				  thumbnail: [
					{
					  srcset: '<?php echo $this->crud_model->get_movies('movie' , $row['movie_id']);?>',
					  type: 'image/jpeg',
					  media: '(min-width: 400px;)'
					},
					{
					  src: '<?php echo $this->crud_model->get_poster_url('movie' , $row['movie_id']);?>',
					}
				  ]
				},<?php endforeach;?>];
				var player = videojs(document.querySelector('video'), {
					  inactivityTimeout: 0
					});

					try {
					  // try on ios
					  player.volume(0);
					} catch (e) {}

					player.on([
					  'duringplaylistchange',
					  'playlistchange',
					  'beforeplaylistitem',
					  'playlistitem',
					  'playlistsorted'
					], function(e) {
					  videojs.log('player saw "' + e.type + '"');
					});
				//Lista lateral
					player.playlistUi();					
				//auto reproduccion siguiente video
					player.playlist.autoadvance(0);
				
				//declaramos variable indexActual;
				//se recorre array videoList y se compara el idPelicula con el id de la pelicula que viene por get y se guarda en indexActual;
				var indexActual=0;
				$(videoList).each(function(index){
					if($(videoList[index]).attr("idPelicula")==<?php echo $movie_id ?>){
						indexActual=index;	   
					   }
					
				});
					player.playlist(videoList);
				//se cambia el curren item por variable indexActual
					player.playlist.currentItem(indexActual);
					//Botones de navegacion
					document.querySelector('.previous').addEventListener('click', function() {
					  player.playlist.previous();
					});

					document.querySelector('.next').addEventListener('click', function() {
					  player.playlist.next();
					});
				// Initialize the playlist-ui plugin with no option (i.e. the defaults).			
				
			</script> 
			</div>
		</div>
	</div>
</div>
<!-- VIDEO DETAILS HERE -->
<div class="container" style="margin-top: 30px;">
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-2">
					<img src="<?php echo $this->crud_model->get_thumb_url('movie' , $movie_id);?>" style="height: 60px; margin:20px;" />
				</div>
				<div class="col-lg-10">
					<!-- VIDEO TITLE -->
					<h3>
						<?php echo $movie_details2->title;?>
					</h3>
					<!-- RATING CALCULATION -->
					<div>
						<?php
							for($i = 1 ; $i <= $movie_details2->rating ; $i++):
							?>
						<i class="fa fa-star" aria-hidden="true"></i>
						<?php endfor;?>
						<?php
							for($i = 5 ; $i > $movie_details2->rating ; $i--):
							?>
						<i class="fa fa-star-o" aria-hidden="true"></i>
						<?php endfor;?>
					</div>
				</div>
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
			    mylist_exist_status = "<?php echo $this->crud_model->get_mylist_exist_status('movie' , $row['movie_id']);?>";
			
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
		<div class="col-lg-4">
			<!-- ADD OR DELETE FROM PLAYLIST -->
			<span id="mylist_button_holder">
			</span>
			<span id="mylist_add_button" style="display:none;">
			<a href="#" class="btn btn-danger btn-md" style="font-size: 16px; margin-top: 20px;" 
				onclick="process_list('movie' , 'add', <?php echo $row['movie_id'];?>)"> 
			<i class="fa fa-plus"></i> Agregar a mi lista
			</a>
			</span>
			<span id="mylist_delete_button" style="display:none;">
			<a href="#" class="btn btn-default btn-md" style="font-size: 16px; margin-top: 20px;" 
				onclick="process_list('movie' , 'delete', <?php echo $row['movie_id'];?>)"> 
			<i class="fa fa-check"></i> Agregado a la lista
			</a>
			</span>
			<!-- MOVIE GENRE -->
			<div style="margin-top: 10px;">
				<strong>Genero</strong> : 
				<a href="<?php echo base_url();?>index.php?browse/movie/<?php echo $row['genre_id'];?>">
				<?php echo $this->db->get_where('genre',array('genre_id'=>$row['genre_id']))->row()->name;?>
				</a>
			</div>
			<!-- MOVIE YEAR -->
			<div>
				<strong>Año</strong> : <?php echo $row['year'];?>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:20px;">
		<div class="col-lg-12">
			<div class="bs-component">
				<ul class="nav nav-tabs">
					<li class="active" style="width:33%;">
						<a href="#about" data-toggle="tab">
						Acerca
						</a>
					</li>
					<li style="width:33%;">
						<a href="#cast" data-toggle="tab">
						Emitir
						</a>
					</li>
					<li style="width:34%;">
						<a href="#more" data-toggle="tab">
						Mas
						</a>
					</li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<!-- TAB FOR TITLE -->
					<div class="tab-pane active in" id="about">
						<p>
							<?php echo $row['description_long'];?>
						</p>
					</div>
					<!-- TAB FOR ACTORS -->
					<div class="tab-pane " id="cast">
						<p>
							<?php
								$actors	=	json_decode($row['actors']);
								for($i = 0; $i< sizeof($actors) ; $i++)
								{
									?>
						<div style="float: left; text-align:center; color: #fff; font-weight: bold;">
							<img src="<?php echo $this->crud_model->get_actor_image_url($actors[$i]);?>" 
								style="height: 160px; margin:5px;" />
							<br>
							<?php echo $this->db->get_where('actor', array('actor_id'=>$actors[$i]))->row()->name;?>
						</div>
						<?php
							}
							?>
						</p>
					</div>
					<!-- TAB FOR SAME CATEGORY MOVIES -->
					<div class="tab-pane  " id="more">
						<p>
						<div class="content">
							<div class="grid">
								<?php 
									$movies = $this->crud_model->get_movies($row['genre_id'] , 10, 0);
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
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr style="border-top:1px solid #333;">
	<?php include 'footer.php';?>
</div>
<?php endforeach;?>