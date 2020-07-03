<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title no-border">
			</div>
			<div class="grid-body no-border">
				<form method="post" action="<?php echo base_url();?>index.php?admin/movie_create" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="form-label">Titulo de Canal</label>
								<span class="help"></span>
								<div class="controls">
									<input type="text" class="form-control" name="title">
									<br>
									<label> seleccionar color:<input type="color" name="color"  list="">
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Video Url</label>
						<span class="help">- youtube o cualquier video alojado</span>
								<div class="controls">
									<input type="text" class="form-control" name="url" id="url" onBlur="load_player()">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Caratula</label>
							<span class="help">- imagen de icono del Canal</span>
								<div class="controls">
									<input type="file" class="form-control" name="thumb">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Portada</label>
					<span class="help">-imagen de portada grande del canal</span>
								<div class="controls">
									<input type="file" class="form-control" name="poster">
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Breve descripción </label>
								<span class="help"></span>
								<div class="controls">
									<textarea class="form-control" name="description_short"></textarea>
									<br>
									<label> seleccionar color:<input type="color" name="colord"  list="">
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Descripción larga </label>
								<span class="help"></span>
								<div class="controls">
									<textarea class="form-control" name="description_long"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Actores </label>
								<span class="help">-</span>
								<div class="controls">
									<select class="select2"  multiple name="actors[]" style="width:100%;">
										<?php 
											$actors	=	$this->db->get('actor')->result_array();
											foreach ($actors as $row2):?>
										<option value="<?php echo $row2['actor_id'];?>">
											<?php echo $row2['name'];?>
										</option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Género</label>
								<span class="help">-Seleccione el Género</span>
								<div class="controls">
									<select class="select2" name="genre_id" style="width:150px;">
										<?php 
											$genres	=	$this->crud_model->get_genres();
											foreach ($genres as $row2):?>
										<option value="<?php echo $row2['genre_id'];?>">
											<?php echo $row2['name'];?>
										</option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="form-label">Formato </label>
								<span class="help">-</span>
								<div class="controls">
									<select class="select2" name="formato" style="width:150px;">
										<option value="video/mp4">MP4</option>
										<option value="application/x-mpegURL">M3U8</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="form-label">Año de publicación </label>
								<span class="help">-</span>
								<div class="controls">
									<select class="select2" name="year" style="width:150px;">
										<?php for ($i = date("Y"); $i > 2000 ; $i--):?>
										<option value="<?php echo $i;?>">
											<?php echo $i;?>
										</option>
										<?php endfor;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Clasificación</label>
								<span class="help">-</span>
								<div class="controls">
									<select class="select2" name="rating" style="width:150px;">
										<?php for ($i = 0; $i <= 5 ; $i++):?>
										<option value="<?php echo $i;?>">
											<?php echo $i;?>
										</option>
										<?php endfor;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label">Destacadas</label>
								<span class="help">-</span>
								<div class="controls">
									<select class="select2" name="featured" style="width:150px;">
										<option value="0">No</option>
										<option value="1">Si</option>
									</select>
								</div>
							</div>
						</div>
						<!-- PREVIEW OF THE VIDEO FILE -->
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="form-label">Avance:</label>
								<div id="video_player_div"></div>
							</div>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<input type="submit" class="btn btn-success col-md-3 col-sm-12 col-xs-12" value="Crear Canal" style="margin:0px 5px 5px 0px;">
						<a href="<?php echo base_url();?>index.php?admin/movie_list" class="btn btn-default col-md-3 col-sm-12 col-xs-12">Regresar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- LOAD THE PREVIEW OF THE VIDEO USING GIVEN URL -->
<script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>  
<script>
	function load_player()
	{
		url	=	document.getElementById("url").value;
		
		jwplayer("video_player_div").setup({
			"file": url,
	
			"width": "100%",
			aspectratio: "16:9",
			listbar: {
				position: 'right',
				size: 260
			},
		});
	}
</script>