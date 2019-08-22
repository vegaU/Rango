<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Proveedores_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'proveedores' => $this->Proveedores_model->getProveedores(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/proveedores/list", $data);
		$this->load->view("layouts/footer");

	}
	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/proveedores/add");
		$this->load->view("layouts/footer");

	}

	public function store(){

		$ruc = $this->input->post("ruc");
		$razonSocial = $this->input->post("razonSocial");
		$direccion = $this->input->post("direccion");
		$contacto = $this->input->post("contacto");
		$telefono = $this->input->post("telefono");
		$celular = $this->input->post("celular");
		
		$this->form_validation->set_rules("ruc", "RUC del proveedor", "required");
		$this->form_validation->set_rules("razonSocial", "Razon social", "required");
		$this->form_validation->set_rules("contacto", "Contacto", "required");
		$this->form_validation->set_rules("telefono", "Telefono", "required");
		$this->form_validation->set_rules("celular", "Celular", "required");
			
		if($this->form_validation->run()){
		    
		    $data  = array(
		        'ruc' => $ruc,
		        'razon_social' => $razonSocial,
		        'direccion' => $direccion,
		        'contacto' => $direccion,
		        'telefono' => $contacto,
		        'celular' => $celular
		    );
		    
		    if ($this->Proveedores_model->save($data)) {
		        redirect(base_url()."mantenimiento/proveedores");
		    }
		    else{
		        $this->session->set_flashdata("error","No se pudo guardar la informacion");
		        redirect(base_url()."mantenimiento/proveedores/add");
		    }
		    
		}else{
		    $this->add();
		}

		
	}

	public function edit($id){

		$data  = array(
			'cliente' => $this->Clientes_model->getCliente($id), 
			"tipoclientes" => $this->Clientes_model->getTipoClientes(),
			"tipodocumentos" => $this->Clientes_model->getTipoDocumentos()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/clientes/edit",$data);
		$this->load->view("layouts/footer");
		
	}


	public function update(){
	    
		$idcliente = $this->input->post("idcliente");
		$nombre = $this->input->post("nombre");
		$tipodocumento = $this->input->post("tipodocumento");
		$tipocliente = $this->input->post("tipocliente");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$num_documento = $this->input->post("numero");

		$clienteActual = $this->Clientes_model->getCliente($idcliente);
		
		if($num_documento == $clienteActual->num_documento){
		    $is_unique = " ";    
		}else{
		    $is_unique = "|is_unique[clientes.num_documento]";
		}
		
		$this->form_validation->set_rules("nombre", "Nombre del cliente", "required");
		$this->form_validation->set_rules("tipocliente", "Tipo de cliente", "required");
		$this->form_validation->set_rules("tipodocumento", "Tipo de documento", "required");
		$this->form_validation->set_rules("num_documento", "Numero del documento", "required".$is_unique);

		if($this->form_validation->run()){
		    
		    $data = array(
		        'nombre' => $nombre,
		        'tipo_documento_id' => $tipodocumento,
		        'tipo_cliente_id' => $tipocliente,
		        'direccion' => $direccion,
		        'telefono' => $telefono,
		        'num_documento' => $num_documento,
		    );
		    
		    if ($this->Clientes_model->update($idcliente,$data)) {
		        redirect(base_url()."mantenimiento/clientes");
		    }
		    else{
		        $this->session->set_flashdata("error","No se pudo actualizar la informacion");
		        redirect(base_url()."mantenimiento/clientes/edit/".$idcliente);
		    }
		    
		}else{
		    $this->edit($idcliente);
		}
		
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Clientes_model->update($id,$data);
		echo "mantenimiento/clientes";
	}
}