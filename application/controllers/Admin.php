<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	// constructor
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('crud_model');
		$this->load->library('session');
		$this->admin_login_check();
	}
	
	public function index()
	{
		$this->dashboard();
	}
	
	function dashboard()
	{
		$page_data['page_name']		=	'dashboard';
		$page_data['page_title']	=	'Resumen de inicio';
		$this->load->view('backend/index', $page_data);
	}

	// WATCH LIST OF GENRE, MANAGE THEM
	function genre_list()
	{
		$page_data['page_name']		=	'genre_list';
		$page_data['page_title']	=	'Administrar género';
		$this->load->view('backend/index', $page_data);
	}

	// CREATE A NEW GENRE
	function genre_create()
	{
		if (isset($_POST) && !empty($_POST))
		{
			$data['name']			=	$this->input->post('name');
			$this->db->insert('genre', $data);
			redirect(base_url().'index.php?admin/genre_list' , 'refresh');
		}
		$page_data['page_name']		=	'genre_create';
		$page_data['page_title']	=	'Crear Genero';
		$this->load->view('backend/index', $page_data);
	}
	
	

	// EDIT A GENRE
	function genre_edit($genre_id = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$data['name']			=	$this->input->post('name');
			$this->db->update('genre', $data,  array('genre_id' => $genre_id));
			redirect(base_url().'index.php?admin/genre_list' , 'refresh');
		}
		$page_data['genre_id']		=	$genre_id;
		$page_data['page_name']		=	'genre_edit';
		$page_data['page_title']	=	'editar genero';
		$this->load->view('backend/index', $page_data);
	}
	
	//crear subscripcion
	
	function crear_subscription()					
{					
									
	$data['plan_id']	        =$this->input->post('plan_id');
	$data['user_id']	        =10;		
	$data['price_amount']	    =0;		
	$data['paid_amount']	    =0;		
	$data['timestamp_from']	    =1;		
	$data['timestamp_to']	    =1621001020;		
	$data['payment_method']	    ="paypal";		
	$data['payment_details']    ='';			
	$data['payment_timestamp']  =1;			
	$data['status']	            =1;		
					
	$this->db->insert('subscription', $data);				
	$movie_id = $this->db->insert_id();	
	redirect(base_url().'index.php?admin/user_list' , 'refresh');
					
}				
	// WATCH LIST OF USERS, MANAGE THEM
	//sacar pdf
	function sacar_pdfs()
	{
		$page_data['page_name']		=	'user_list';
		$page_data['page_title']	=	'Administrar Usuarios';
		$this->load->view('backend/pages/sacar_pdf');
	}
	function exportar_activos_en_csv(){
		//generando cabezales para la descarga 
		header('Content-Type: text/csv; charset=utf-8');
 		header('Content-Disposition: attachment; filename=miembros_activos_'.date('Y-m-d').'.csv');
		//abriendo archivo temporal para escritura
		$f = fopen('php://output', 'w');
		//escribiendo titulos				
		fwrite($f,'ID s;EMAIL '.PHP_EOL);
		//obteniendo y escribiendo usuarios
		$usuarios = $this->db->get_where('user',array("type"=>"0"))->result_array();
		foreach ($usuarios as $key => $value) {			
			$suscripcion_actual = $this->db->get_where('subscription',array('user_id'=>$value['user_id'] ))->row(); 
			if($this->crud_model->validar_suscripcion_duber($suscripcion_actual)){
			fwrite($f,$value['user_id'].";".$value['email'].PHP_EOL);
			}
		}
		//cerrando archivo
		fclose($f);		
		
	}
	function importar_csv_para_desactivar(){
		
		//datos del arhivo enviado por post
		$nombre_archivo = "temporal.csv";
		$tipo_archivo = $_FILES['cargar_csv']['type'];
		$tamano_archivo = $_FILES['cargar_csv']['size'];
		//comprobacion de extencion
		if(strcasecmp($tipo_archivo,"csv")){
			//copiando el archivo a la ruta application/cache/temporal.csv
			if (move_uploaded_file($_FILES['cargar_csv']['tmp_name'],  'application/cache/'.$nombre_archivo)){
				//abriendo el archivo para lectura
				$fp = fopen('application/cache/'.$nombre_archivo, "r");
				//indice para saber la linea del archivo
				$i=0;
				while (!feof($fp)){
					//lectura de cada linea 
					$linea = fgets($fp);
					//separacion de la linea por ; en un array
					$array = explode(";",$linea);
					//comprovacion de que no sea la primera linea porque la destine para el encabezado en la generacion y que el primer dato del array tiene que ser diferente a nada y tambien un entero
					if($i!=0 && strcasecmp($array[0],"")!=false){
						if(is_integer(intval($array[0]))){
						//obtengo la suscribcion de este usuario y cambio es estado
						$suscripcion_actual=$this->db->get_where('subscription',array("user_id"=>$array[0]))->row();
						if(isset($suscripcion_actual)){
							//valido si existe y realizo el update 
							$data['status']=0;
							$this->db->update("subscription",$data,array("subscription_id"=>$suscripcion_actual->subscription_id));	
						}
					}
					}
					//aumento indice en cada iteracion
					$i++;
				}
				fclose($fp);
				$_SESSION['importacion']=true;
				redirect(base_url().'index.php?admin/user_list' , 'refresh');
		 }else{
		 	$_SESSION['importacion']=false;
				echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
		 }
		}

	}
	//metodo para administrar canales del usuario
	function select_canales($user_id2=''){
		//cargo la vista que deseo que es seleccionar_canales
		$page_data['page_name']		=	'seleccionar_canales';
		$user_var =$this->db->get_where("user", array('user_id' => $user_id2))->row();
		//dinamiso el titulo con el email de el usuario consultado;
		$page_data['page_title']	=	'Administrar Canales del Usuario '.$user_var->email;
		//paso la variable $user_id2 a la siguiente pagina para consultarlo
		$page_data['user_id2']=$user_id2;
		$this->load->view('backend/index', $page_data);
	}
	//activa y desactiva automaticamente segun como esten los registros
	function activar_desactivar_canales_al_usuario($canal_id1='',$user_id4=''){
		//verifica si tiene registros en tabla de canales_asignados_usuario
		$verificar = $this->crud_model->obtener_canal_usuario($canal_id1,$user_id4);
		if(isset($verificar)){
			//y si el estatus es activo actualiza el registro a inactivo y si es inactivo a activo
			if($verificar->status==="0"){
				$data['status']="1";
			}else{
				$data['status']="0";
			}
				$this->db->update("canales_asignados_usuario",$data,array("id_canales_asignados_usuario"=>$verificar->id_canales_asignados_usuario));
		}else{
			//de lo contrario crea un registro en canales_asignados_usuario
			$data['id_canal']=$canal_id1;
			$data['id_usuario']=$user_id4;
			//verifica si esta activo este canal si lo es crea el registo desactivado y si esta desactivado lo crea activo
			if($this->crud_model->validar_canal_usuario($canal_id1,$user_id4)){
			$data['status']='0';	
			}else{
			$data['status']='1';
			}			
			$this->db->insert('canales_asignados_usuario',$data);	
		}
		redirect(base_url()."index.php?admin/select_canales/".$user_id4);		
	}
	// activar usuarios o suscribirlos 
	function activar($user_id1 = '')

		//tuve que cambiar el nombre de la variable por $user_id1 por temas de conflictos de nombres
	{
		if (isset($_POST) && !empty($_POST))
		{
			// busca y pregunta si el usuario seleccionado tiene una suscripcion ya creada
			$suscripcion_actual = $this->db->get_where('subscription',array('user_id'=>$this->input->post('id_usuario_suscrib') ))->row();
			
			if(isset($suscripcion_actual)){
				//si la tiene activa el registro agregandole la cantidad de meses seleccionados a la fecha actual, cambia el plan y el estado
				$data['plan_id'] = $this->input->post('plan_id');
				$data['status'] = 1;
				$data['timestamp_to']	    = mktime(0, 0, 0, date("m")+intval($this->input->post('featured')),   date("d"),   date("Y"));
			 	$this->db->update('subscription', $data, array('user_id' => $this->input->post('id_usuario_suscrib')));
			}else{
				//de lo contrario crea una nueva suscripcion
				$data['plan_id']	        =$this->input->post('plan_id');
				$data['user_id']	        =$this->input->post('id_usuario_suscrib');		
				$data['price_amount']	    =0;		
				$data['paid_amount']	    =0;		
				$data['timestamp_from']	    =1;		
				$data['timestamp_to']	    = mktime(0, 0, 0, date("m")+intval($this->input->post('featured')),   date("d"),   date("Y"));
				$data['payment_method']	    ="paypal";		
				$data['payment_details']    ='';			
				$data['payment_timestamp']  =1;			
				$data['status']	            =1;		
	
			$this->db->insert('subscription', $data);				
			$suscription_id = $this->db->insert_id();
			}
			
			//por ultimo redirecciona
			redirect(base_url().'index.php?admin/user_list' , 'refresh');
		}
		$page_data['user_id1']		=	$user_id1;
		$page_data['page_name']		=	'activar';
		$page_data['page_title']	=	'Activar Usuarios';
		$this->load->view('backend/index', $page_data);
	}

	//desactivar usuarios o dessuscribirlos
	function desactivar($user_id2=''){
			$suscripcion_actual=$this->db->get_where('subscription',array("user_id"=>$user_id2))->row();
			$data['status']=0;
			
			$this->db->update("subscription",$data,array("subscription_id"=>$suscripcion_actual->subscription_id));
			$this->db->delete("canales_asignados_usuario",array("id_usuario"=>$user_id2));
	
		redirect(base_url().'index.php?admin/user_list' , 'refresh');

	}
	
	// DELETE A GENRE
	function genre_delete($genre_id = '')
	{
		$this->db->delete('genre',  array('genre_id' => $genre_id));
		redirect(base_url().'index.php?admin/genre_list' , 'refresh');
	}

	// WATCH LIST OF MOVIES, MANAGE THEM
	function movie_list()
	{
		$page_data['page_name']		=	'movie_list';
		$page_data['page_title']	=	'Administrar Canales';
		if(isset($_SESSION['var_planes'])){
			$_SESSION['var_planes']=null;
		}
		$this->load->view('backend/index', $page_data);
	}
	function movie_list2($filtro='')
	{
		$page_data['page_name']		=	'movie_list';
		$page_data['page_title']	=	'Administrar Canales';
		$page_data['filtrox']=$filtro;
		$_SESSION['var_planes']=$filtro;
		$this->load->view('backend/index', $page_data);
	}

	// CREATE A NEW MOVIE
	function movie_create()
	{
		if (isset($_POST) && !empty($_POST))
		{
			$this->crud_model->create_movie();
			redirect(base_url().'index.php?admin/movie_list' , 'refresh');	
		}
		$page_data['page_name']		=	'movie_create';
		$page_data['page_title']	=	'Crear Canales';
		$this->load->view('backend/index', $page_data);
	}

	// EDIT A MOVIE
	function movie_edit($movie_id = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$this->crud_model->update_movie($movie_id);
			if(isset($_SESSION['var_planes'])){
				redirect(base_url().'index.php?admin/movie_list2/'.$_SESSION['var_planes'] , 'refresh');	
			}else{
				redirect(base_url().'index.php?admin/movie_list' , 'refresh');	
			}
			
		}
		$page_data['movie_id']		=	$movie_id;
		$page_data['page_name']		=	'movie_edit';
		$page_data['page_title']	=	'Editar Canales';
		$this->load->view('backend/index', $page_data);
	}

	// DELETE A MOVIE
	function movie_delete($movie_id = '')
	{
		$this->db->delete('movie',  array('movie_id' => $movie_id));
		redirect(base_url().'index.php?admin/movie_list' , 'refresh');
	}
	
	// WATCH LIST OF SERIESS, MANAGE THEM
	function series_list()
	{
		$page_data['page_name']		=	'series_list';
		$page_data['page_title']	=	'Lista de Canales';
		$this->load->view('backend/index', $page_data);
	}

	// CREATE A NEW SERIES
	function series_create()
	{
		if (isset($_POST) && !empty($_POST))
		{
			$this->crud_model->create_series();
			redirect(base_url().'index.php?admin/series_list' , 'refresh');
		}
		$page_data['page_name']		=	'series_create';
		$page_data['page_title']	=	'Create Tv Series';
		$this->load->view('backend/index', $page_data);
	}

	// EDIT A SERIES
	function series_edit($series_id = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$this->crud_model->update_series($series_id);
			redirect(base_url().'index.php?admin/series_edit/'.$series_id , 'refresh');
		}
		$page_data['series_id']		=	$series_id;
		$page_data['page_name']		=	'series_edit';
		$page_data['page_title']	=	'Edit Tv Series. Manage Seasons & Episodes';
		$this->load->view('backend/index', $page_data);
	}

	// DELETE A SERIES
	function series_delete($series_id = '')
	{
		$this->db->delete('series',  array('series_id' => $series_id));
		redirect(base_url().'index.php?admin/series_list' , 'refresh');
	}

	// CREATE A NEW SEASON
	function season_create($series_id = '')
	{
		$this->db->where('series_id' , $series_id);
		$this->db->from('season');
        $number_of_season 	=	$this->db->count_all_results();
		
		$data['series_id']	=	$series_id;
		$data['name']		=	'Season ' . ($number_of_season + 1);
		$this->db->insert('season', $data);
		redirect(base_url().'index.php?admin/series_edit/'.$series_id , 'refresh');
		
	}

	// EDIT A SEASON
	function season_edit($series_id = '', $season_id = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$data['title']			=	$this->input->post('title');
			$this->db->update('series', $data,  array('series_id' => $series_id));
			redirect(base_url().'index.php?admin/series_edit/'.$series_id , 'refresh');
		}
		$series_name				=	$this->db->get_where('series', array('series_id'=>$series_id))->row()->title;
		$season_name				=	$this->db->get_where('season', array('season_id'=>$season_id))->row()->name;
		$page_data['page_title']	=	'Manage episodes of ' . $season_name . ' : ' . $series_name;
		$page_data['season_name']	=	$this->db->get_where('season', array('season_id'=>$season_id))->row()->name;
		$page_data['series_id']		=	$series_id;
		$page_data['season_id']		=	$season_id;
		$page_data['page_name']		=	'season_edit';
		$this->load->view('backend/index', $page_data);
	}

	// DELETE A SEASON
	function season_delete($series_id = '', $season_id = '')
	{
		$this->db->delete('season',  array('season_id' => $season_id));
		redirect(base_url().'index.php?admin/series_edit/'.$series_id , 'refresh');
	}

	// CREATE A NEW EPISODE
	function episode_create($series_id = '', $season_id = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$data['title']			=	$this->input->post('title');
			$data['url']			=	$this->input->post('url');
			$data['season_id']		=	$season_id;
			$this->db->insert('episode', $data);
			$episode_id = $this->db->insert_id();
			move_uploaded_file($_FILES['thumb']['tmp_name'], 'assets/global/episode_thumb/' . $episode_id . '.jpg');
			redirect(base_url().'index.php?admin/season_edit/'.$series_id.'/'.$season_id , 'refresh');
		}
	}

	// CREATE A NEW EPISODE
	function episode_edit($series_id = '', $season_id = '', $episode_id = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$data['title']			=	$this->input->post('title');
			$data['url']			=	$this->input->post('url');
			$data['season_id']		=	$season_id;
			$this->db->update('episode', $data, array('episode_id'=>$episode_id));
			move_uploaded_file($_FILES['thumb']['tmp_name'], 'assets/global/episode_thumb/' . $episode_id . '.jpg');
			redirect(base_url().'index.php?admin/season_edit/'.$series_id.'/'.$season_id , 'refresh');
		}
	}

	// DELETE AN EPISODE
	function episode_delete($series_id = '', $season_id = '', $episode_id = '')
	{
		$this->db->delete('episode',  array('episode_id' => $episode_id));
		redirect(base_url().'index.php?admin/season_edit/'.$series_id.'/'.$season_id , 'refresh');
	}
	
	// WATCH LIST OF ACTORS, MANAGE THEM
	function actor_list()
	{
		$page_data['page_name']		=	'actor_list';
		$page_data['page_title']	=	'Manage actor';
		$this->load->view('backend/index', $page_data);
	}

	// CREATE A NEW ACTOR
	function actor_create()
	{
		if (isset($_POST) && !empty($_POST))
		{
			$this->crud_model->create_actor();
			redirect(base_url().'index.php?admin/actor_list' , 'refresh');
		}
		$page_data['page_name']		=	'actor_create';
		$page_data['page_title']	=	'Create actor';
		$this->load->view('backend/index', $page_data);
	}

	// EDIT A ACTOR
	function actor_edit($actor_id = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$this->crud_model->update_actor($actor_id);
			redirect(base_url().'index.php?admin/actor_list' , 'refresh');
		}
		$page_data['actor_id']		=	$actor_id;
		$page_data['page_name']		=	'actor_edit';
		$page_data['page_title']	=	'Edit actor';
		$this->load->view('backend/index', $page_data);
	}

	// DELETE A ACTOR
	function actor_delete($actor_id = '')
	{
		$this->db->delete('actor',  array('actor_id' => $actor_id));
		redirect(base_url().'index.php?admin/actor_list' , 'refresh');
	}
	
	// WATCH LIST OF PRICING PACKAGES, MANAGE THEM
	function plan_list()
	{
		$page_data['page_name']		=	'plan_list';
		$page_data['page_title']	=	'Administrar plan';
		$this->load->view('backend/index', $page_data);
	}

	// EDIT A ACTOR
	function plan_edit($plan_id = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$data['name']			=	$this->input->post('name');
			$data['price']			=	$this->input->post('price');
			$data['status']			=	$this->input->post('status');
			$this->db->update('plan', $data,  array('plan_id' => $plan_id));
			redirect(base_url().'index.php?admin/plan_list' , 'refresh');
		}
		$page_data['plan_id']		=	$plan_id;
		$page_data['page_name']		=	'plan_edit';
		$page_data['page_title']	=	'Edit plan';
		$this->load->view('backend/index', $page_data);
	}
	
	// WATCH LIST OF USERS, MANAGE THEM
	function user_list()
	{
		$page_data['page_name']		=	'user_list';
		$page_data['page_title']	=	'Administrar Usuarios';
		$this->load->view('backend/index', $page_data);
	}
	
	// eliminar usuario 
	function user_delete($user_id = '',$usuarios_seleccionados='')
	{
		//esto se creo para la eliminacion multiple
		$a_eliminar =explode('-',$usuarios_seleccionados);
		foreach ($a_eliminar as $key => $value) {
			$this->db->delete('user',  array('user_id' =>$value));
			$this->db->delete("canales_asignados_usuario",array("id_usuario"=>$user_id));
		}
		
		$this->db->delete('user',  array('user_id' =>$user_id));
		$this->db->delete("canales_asignados_usuario",array("id_usuario"=>$user_id));
		redirect(base_url().'index.php?admin/user_list' , 'refresh');
	}
	// WATCH SUBSCRIPTION, PAYMENT REPORT
	function report($month = '', $year = '')
	{
		if ($month == '')
			$month	=	date("F");
		if ($year == '')
			$year = date("Y");
		
		$page_data['month']			=	$month;
		$page_data['year']			=	$year;
		$page_data['page_name']		=	'report';
		$page_data['page_title']	=	'Suscripción del cliente e informe de pago';
		$this->load->view('backend/index', $page_data);
	}
	
	// WATCH LIST OF FAQS, MANAGE THEM
	function faq_list()
	{
		$page_data['page_name']		=	'faq_list';
		$page_data['page_title']	=	'Administrar preguntas frecuentes';
		$this->load->view('backend/index', $page_data);
	}

	// CREATE A NEW FAQ
	function faq_create()
	{
		if (isset($_POST) && !empty($_POST))
		{
			$data['question']		=	$this->input->post('question');
			$data['answer']			=	$this->input->post('answer');
			$this->db->insert('faq', $data);
			redirect(base_url().'index.php?admin/faq_list' , 'refresh');
		}
		$page_data['page_name']		=	'faq_create';
		$page_data['page_title']	=	'Create faq';
		$this->load->view('backend/index', $page_data);
	}

	// EDIT A FAQ
	function faq_edit($faq_id = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$data['question']		=	$this->input->post('question');
			$data['answer']			=	$this->input->post('answer');
			$this->db->update('faq', $data,  array('faq_id' => $faq_id));
			redirect(base_url().'index.php?admin/faq_list' , 'refresh');
		}
		$page_data['faq_id']		=	$faq_id;
		$page_data['page_name']		=	'faq_edit';
		$page_data['page_title']	=	'Edit faq';
		$this->load->view('backend/index', $page_data);
	}

	// DELETE A FAQ
	function faq_delete($faq_id = '')
	{
		$this->db->delete('faq',  array('faq_id' => $faq_id));
		redirect(base_url().'index.php?admin/faq_list' , 'refresh');
	}

	// EDIT SETTINGS
	function settings()
	{
		if (isset($_POST) && !empty($_POST))
		{
			// Updating website name
			$data['description']		=	$this->input->post('site_name');
			$this->db->update('settings', $data,  array('type' => 'site_name'));
			
			// Updating website email
			$data['description']		=	$this->input->post('site_email');
			$this->db->update('settings', $data,  array('type' => 'site_email'));
			
			// Updating website paypal merchant email
			$data['description']		=	$this->input->post('paypal_merchant_email');
			$this->db->update('settings', $data,  array('type' => 'paypal_merchant_email'));
			
			// Updating invoice address
			$data['description']		=	$this->input->post('invoice_address');
			$this->db->update('settings', $data,  array('type' => 'invoice_address'));
			
			// Updating envato purchase code
			$data['description']		=	$this->input->post('purchase_code');
			$this->db->update('settings', $data,  array('type' => 'purchase_code'));
			
			// Updating privacy policy
			$data['description']		=	$this->input->post('privacy_policy');
			$this->db->update('settings', $data,  array('type' => 'privacy_policy'));
			
			// Updating refund policy
			$data['description']		=	$this->input->post('refund_policy');
			$this->db->update('settings', $data,  array('type' => 'refund_policy'));
			
			move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/global/logo.png');
						
			redirect(base_url().'index.php?admin/settings' , 'refresh');
		}
		
		$page_data['site_name']				=	$this->db->get_where('settings',array('type'=>'site_name'))->row()->description;
		$page_data['site_email']			=	$this->db->get_where('settings',array('type'=>'site_email'))->row()->description;
		$page_data['paypal_merchant_email']	=	$this->db->get_where('settings',array('type'=>'paypal_merchant_email'))->row()->description;
		$page_data['invoice_address']		=	$this->db->get_where('settings',array('type'=>'invoice_address'))->row()->description;
		$page_data['purchase_code']			=	$this->db->get_where('settings',array('type'=>'purchase_code'))->row()->description;
		$page_data['privacy_policy']		=	$this->db->get_where('settings',array('type'=>'privacy_policy'))->row()->description;
		$page_data['refund_policy']			=	$this->db->get_where('settings',array('type'=>'refund_policy'))->row()->description;
		
		$page_data['page_name']				=	'settings';
		$page_data['page_title']			=	'Configuraciones del sitio web';
		$this->load->view('backend/index', $page_data);
	}
	
	function account()
	{
		$user_id	=	$this->session->userdata('user_id');
		
		if (isset($_POST) && !empty($_POST))
		{
			$task	=	$this->input->post('task');
			if ($task == 'update_profile')
			{
				$data['name']				=	$this->input->post('name');
				$data['email']				=	$this->input->post('email');
				$this->db->update('user', $data, array('user_id'=>$user_id));
				redirect(base_url().'index.php?admin/account' , 'refresh');
			}
			else if ($task == 'update_password')
			{
				$old_password_encrypted				=	$this->crud_model->get_current_user_detail()->password;
				$old_password_submitted_encrypted	=	sha1($this->input->post('old_password'));
				$new_password						=	$this->input->post('new_password');
				$new_password_encrypted				=	sha1($this->input->post('new_password'));
				
				// CORRECT OLD PASSWORD NEEDED TO CHANGE PASSWORD
				if ($old_password_encrypted 		==	$old_password_submitted_encrypted)
				{
					$this->db->update('user', array('password'=>$new_password_encrypted), array('user_id'=>$user_id));
					$this->session->set_flashdata('status', 'password_changed');
				}
				redirect(base_url().'index.php?admin/account' , 'refresh');
			}
		}
		$page_data['page_name']				=	'account';
		$page_data['page_title']			=	'Administrar cuenta';
		$this->load->view('backend/index', $page_data);
	}
	

	function admin_login_check()
	{
		$logged_in_user_type			=	$this->session->userdata('login_type');
		if ($logged_in_user_type == 0)
		{
			redirect(base_url().'index.php?home/signin' , 'refresh');
		}
	}
	
	


}
