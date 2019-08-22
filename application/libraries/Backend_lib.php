<?php 

class Backend_lib{

	private $CI;

	public function __construct(){
		$this->CI = & get_instance();
	}

	public function control(){

		if(!$this->CI->session->userdata("login")){
		//	echo "login vacio";
			redirect(base_url());
		}
		$url = $this->CI->uri->segment(1);
		if($this->CI->uri->segment(2)){
			$url = $this->CI->uri->segment(1)."/".$this->CI->uri->segment(2);
		//	echo "url es ".$url;
		}
	
		 $infomenu = $this->CI->Backend_model->getID($url); 
		 $permisos = $this->CI->Backend_model->getPermisos($infomenu->id, $this->CI->session->userdata("rol"));

		 //si permisos, lectura da cero, o sea no tiene permisos
		if($permisos->read == 0){
			redirect(base_url()."Dashboard"); //redirecciona al Dashboard
		}else{
			return $permisos;
		}
	}

}